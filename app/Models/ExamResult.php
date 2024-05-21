<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_id',
        'category',
        'sub_category',
        'raw_score',
        't_score',
        'k_score',
    ];

    protected $casts = [
        'exam_id' => 'integer',
        'raw_score' => 'integer',
        't_score' => 'integer',
        'k_score' => 'integer',
    ];
}
