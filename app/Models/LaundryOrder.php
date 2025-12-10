<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

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
        return $this->hasOne(CustomerVoucher::class);
    }

    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class);
    }
}
