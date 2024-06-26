<?php

namespace App\Models;

use App\MMPI2\Scale;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PhpParser\Node\Expr\AssignOp\Mod;

class Exam extends Model
{
    protected $fillable = [
        'user_id',
        'purpose',
        'start_time',
        'end_time',
        'doctor_id',
        'payment_id',
        'approved',
        'validated',
        'note',
        'response_to_test',
        'validity_score',
        'work_performance',
        'adaptability',
        'psychological_issue',
        'destructive_action',
        'moral_integrity',
        'clinical_profile',
        'openness',
        'conscientiousness',
        'extraversion',
        'agreeableness',
        'neuroticism',
    ];

    use HasFactory;

    function exam_result()
    {
        return $this->hasOne(ExamResult::class);
    }

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

    function getUnansweredQuestions(): Collection
    {
        return $this->getQuestions()->filter(function ($question) {
            return !$question->answers;
        });
    }

    function getAnsweredQuestions(): Collection
    {
        return $this->getQuestions()->filter(function ($question) {
            if ($current_question = $question->answers) {
                return $current_question->answer !== null ? $current_question : null;
            }
            return null;
        });
    }

    function getNullAnsweredQuestions(): Collection
    {
        return $this->getQuestions()->filter(function ($question) {
            if ($current_question = $question->answers) {
                return $current_question->answer === null ? $current_question : null;
            }
            return null;
        });
    }

    function getQuestions(): Collection|array
    {
        return Question::with(['answers' => function ($query) {
            $query->where('exam_id', $this->id);
        }])->get();
    }

    function getQuestionList($page = 1, $offset = 50): Collection|array
    {
        $query = Question::with(['answers' => function ($query) {
            $query->where('exam_id', $this->id);
        }]);

        return $query->offset(($page - 1) * $offset)->limit($offset)->get();
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

    function endExam(): bool
    {
        if ($this->end_time === null) {
            $this->end_time = now();
            return $this->save();
        }
        return false;
    }

    public function isFinished(): bool
    {
        return $this->end_time !== null && $this->start_time !== null;
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function isExamBelongToMe(): bool
    {
        return $this->user_id === auth()->id();
    }

    public function startExam(): bool
    {
        if ($this->start_time === null) {
            $this->start_time = now();
            return $this->save();
        }
        return false;
    }

    /**
     * @throws \Exception
     */
    function analyze(): Scale
    {
        return new Scale($this);
    }

    function hasExamResult(): bool
    {
        return (bool) ExamResult::where('exam_id', $this->id)->first();
    }

    function countMentalCapacity(){
        return $this->work_performance
            + $this->adaptability
            + $this->psychological_issue
            + $this->destructive_action
            + $this->moral_integrity;
    }

    function countPersonality(){
        return $this->openness
            + $this->conscientiousness
            + $this->extraversion
            + $this->agreeableness
            + $this->neuroticism;
    }
}
