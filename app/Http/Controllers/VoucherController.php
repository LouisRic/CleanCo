<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $vouchers = $user->customerVouchers()
            ->where('is_redeemed', false)
            ->get();

        return view('pages.customer.voucher.index', compact('vouchers'));
    }
}
