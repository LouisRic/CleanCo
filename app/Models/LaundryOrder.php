<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PointTransaction;

class LaundryOrder extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected static function booted()
    {
        static::updated(function ($order) {

            // hanya beri poin jika:
            // 1. status laundry completed
            // 2. payment paid
            // 3. poin belum pernah diberikan utk order ini
            $alreadyEarned = $order->pointTransactions()
                ->where('type', 'earn')
                ->exists();

            if (
                $order->payment_status === 'paid' &&
                $order->laundry_status === 'completed' &&
                !$alreadyEarned
            ) {
                $account = $order->account;

                $points = floor($order->total_price / 1000);

                $currentBalance = $account
                    ->pointTransactions()
                    ->sum('amount');

                PointTransaction::create([
                    'account_id' => $account->id,
                    'laundry_order_id' => $order->id,
                    'amount' => $points,
                    'type' => 'earn',
                    'description' => 'Poin dari transaksi #' . $order->id,
                    'balance_after_transaction' => $currentBalance + $points,
                ]);
            }
        });
    }

    public function getOrderCodeAttribute()
    {
        return 'LD' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function laundryType()
    {
        return $this->belongsTo(LaundryType::class);
    }

    public function customerVoucher()
    {
        return $this->belongsTo(CustomerVoucher::class, 'customer_voucher_id');
    }

    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class);
    }
}
