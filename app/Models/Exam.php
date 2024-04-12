<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exam extends Model
{
    protected $fillable = ["user_id", "start_time", "end_time", "doctor_id", "purpose"];

    use HasFactory;

    function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
