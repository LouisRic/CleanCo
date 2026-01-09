<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'telephone',
        'address',
        'gender',
        'photo',
        'password',
    ];
    protected $hidden = ['password', 'remember_token', 'points_balance'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getPointsBalanceAttribute()
    {
        return $this->pointTransactions()->sum('amount');
    }

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
