<?php

namespace App\Models;

use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Midtrans\Config;

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
        'paid_at',
        'bank_name',
        'bank_account',
        'bank_account_name',
        'user_id',
        'snap_code',
    ];

    public static function midtrans(string $pdf_url)
    {
        $midtrans = Http::get(Str::of($pdf_url)->replace('/pdf', '/status'))->json();

        $transaction = $midtrans['transaction_status'];
        $type = $midtrans['payment_type'];
        $fraud = $midtrans['fraud_status'];

        $trx = Payment::create([
            'method' => 'online',
            'status' => 'pending',
            'description' => 'Pembayaran menggunakan midtrans',
            'expired_at' => Carbon::make($midtrans['expiry_time']),
            'provider_payment_method' => $type,
            'user_id' => auth()->id(),
            'snap_code' => $midtrans['token'],
        ]);

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // echo "Transaction order_id: " . $order_id . " is challenged by FDS";
                    $trx->update([
                        'status' => 'pending',
                        'description' => 'Pembayaran ditahan oleh FDS',
                    ]);

                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    // echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                    self::successHandler($trx);
                }
            }
        }
        else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            // echo "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
            self::successHandler($trx);
        }
        else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            // echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
            $trx->update([
                'status' => 'pending',
                'description' => 'Menunggu pembayaran',
            ]);

        }
        else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            // echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
            $trx->update([
                'status' => 'failed',
                'description' => 'Pembayaran ditolak',
            ]);

        }
        else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            // echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
            $trx->update([
                'status' => 'failed',
                'description' => 'Pembayaran kadaluarsa',
            ]);
        }
        else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            // echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
            $trx->update([
                'status' => 'canceled',
                'description' => 'Pembayaran dibatalkan',
            ]);
        }

        return $transaction;
    }

    private static function successHandler($trx): void
    {
        $trx->update([
            'status' => 'paid',
            'description' => 'Pembayaran berhasil',
            'paid_at' => now(),
        ]);
    }

    function isPaid(): bool {
        return $this->status == "paid";
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

    static function latestMidtrans()
    {
        return self::where('user_id', auth()->id())
            ->where('method', 'online')
            ->latest()
            ->get()
            ->first();
    }

    function isManual(): bool
    {
        return $this->method == 'manual';
    }

    function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
