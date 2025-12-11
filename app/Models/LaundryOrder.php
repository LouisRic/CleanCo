<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

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
