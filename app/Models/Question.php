<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    public function answers(int $exam_id = null): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        $answer = $this->hasOne(Answer::class, 'question_id', 'id');
        if ($exam_id != null) {
            $answer = $answer->where('exam_id', $exam_id);
        }
        return $answer;
    }
}
