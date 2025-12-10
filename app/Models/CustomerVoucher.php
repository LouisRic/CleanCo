<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerVoucher extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'is_redeemed' => 'boolean',
        'redeemed_at' => 'datetime',
        'expires_at' => 'date',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function laundryOrder()
    {
        return $this->belongsTo(LaundryOrder::class);
    }
}
