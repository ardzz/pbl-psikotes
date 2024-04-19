<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exam extends Model
{
    protected $fillable = ["user_id", "start_time", "end_time", "doctor_id", "purpose", "expired_time"];

    use HasFactory;

    function answer()
    {
        return $this->hasMany(Answer::class);
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
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
        $expired_time = Carbon::parse($this->expired_time);
        $start_time = Carbon::parse($this->start_time);

        return now()->greaterThanOrEqualTo($expired_time) ||
            now()->greaterThanOrEqualTo($start_time->addMinutes(90)) ||
            $this->end_time !== null;
    }
}
