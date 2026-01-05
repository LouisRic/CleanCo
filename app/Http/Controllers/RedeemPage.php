<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedeemPage extends Controller
{
    public function redeemPage()
    {
        $account = Auth::user()->account;

        return view('voucher.redeemVoucher', [
            'pointsBalance' => $account->points_balance,
            'rewardVouchers' => \App\Models\Voucher::all()
        ]);
    }
}
