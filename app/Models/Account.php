<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['password'];

    public function laundryOrders()
    {
        return $this->hasMany(LaundryOrder::class);
    }

    public function customerVouchers()
    {
        return $this->hasMany(CustomerVoucher::class);
    }

    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class);
    }

}
