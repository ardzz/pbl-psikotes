<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exam extends Model
{
    protected $fillable = ["user_id", "doctor_id", "purpose", "approved", "start_time", "end_time"];

    use HasFactory;

    function answer()
    {
        return $this->hasMany(Answer::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    function getUnansweredQuestions(): Collection
    {
        return $this->getQuestions()->filter(function ($question) {
            return !$question->answers->where('exam_id', $this->id)->first();
        });
    }

    function getNullAnsweredQuestions(): Collection
    {
        return $this->getQuestions()->filter(function ($question) {
            return $question->answers->where('exam_id', $this->id)->whereNull('answer')->first();
        });
    }

    function getQuestions()
    {
        return Question::with(['answers' => function ($query) {
            $query->where('exam_id', $this->id);
        }])->get();
    }

    function getLatestQuestion()
    {
        $last = $this->answer->last();
        if ($last) {
            if ($last->question_id + 1 <= Question::count()) {
                return Question::where('id', $last->question_id + 1)->first();
            }else{
                return $last->question;
            }
        }
        return Question::first();
    }

    function isExpired(): bool
    {
        $start_time = Carbon::parse($this->start_time);

        return now()->greaterThanOrEqualTo($start_time->addMinutes(90)) ||
            $this->end_time !== null;
    }
}
