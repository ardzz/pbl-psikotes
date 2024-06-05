<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'occupation',
        'birthdate',
        'phone_number',
        'religion',
        'marital_status',
        'education',
        'sex',
        'province',
        'city',
        'district',
        'sub_district',
        'address',
        'user_id'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parseEducation(): string
    {
        return match ($this->education) {
            'elementary' => 'SD',
            'junior_high' => 'SMP',
            'senior_high' => 'SMA',
            'diploma' => 'Diploma',
            'bachelor' => 'S1',
            'master' => 'S2',
            'doctorate' => 'S3',
            default => 'Unknown',
        };
    }

    public function age(){
        return Carbon::make($this->birthdate)->age;
    }
}
