<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'method',
        'provider_payment_method',
        'status',
        'description',
        'proof',
        'amount',
        'expired_at',
        'bank_name',
        'bank_account',
        'bank_account_name',
        'user_id'
    ];
    function isPaid(): bool {
        return $this->status == "completed";
    }

    function isPending(): bool {
        return $this->status == "pending";
    }

    function isFailed(): bool {
        return $this->status == "failed";
    }

    function isExpired(): bool {
        return $this->status == "expired" && now() > $this->expired_at;
    }
}
