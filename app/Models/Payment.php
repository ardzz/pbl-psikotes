<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

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
