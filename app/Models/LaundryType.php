<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function laundryOrders()
    {
        return $this->hasMany(LaundryOrder::class);
    }
}
