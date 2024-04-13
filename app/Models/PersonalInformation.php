<?php

namespace App\Models;

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
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
