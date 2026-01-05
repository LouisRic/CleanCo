<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jika model login = Account (langsung customer)
        if ($user instanceof \App\Models\Account) {
            $account = $user;
        }

        // Jika model login = User dan punya relasi account()
        elseif (method_exists($user, 'account')) {
            $account = $user->account;
        }

        // Jika tetap tidak ada -> redirect aman
        else {
            return redirect()
                ->route('customer.points')
                ->with('error', 'Akun pelanggan tidak ditemukan.');
        }

        return view('pages.voucher.checkVoucher', [
            'availableVouchers' => $account->customerVouchers()
                ->where('is_redeemed', false)
                ->with('voucher')
                ->get(),

            'redeemedVouchers' => $account->customerVouchers()
                ->where('is_redeemed', true)
                ->with('voucher')
                ->latest('redeemed_at')
                ->get(),
        ]);
    }
}
