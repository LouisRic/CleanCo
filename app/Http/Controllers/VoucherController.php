<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Voucher;
use App\Models\CustomerVoucher;

class VoucherController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil account
        if ($user instanceof \App\Models\Account) {
            $account = $user;
        } elseif (method_exists($user, 'account')) {
            $account = $user->account;
        } else {
            return redirect()
                ->route('customer.points')
                ->with('error', 'Akun pelanggan tidak ditemukan.');
        }

        // Voucher yang sudah dimiliki customer & belum dipakai
        $assignedVouchers = $account->customerVouchers()
            ->where('is_redeemed', false)
            ->with('voucher')
            ->get();

        // Voucher points-only yang user bisa redeem
        $pointVouchers = Voucher::where('points_required', '>', 0)
            ->where('is_active', 1)
            ->get()
            ->filter(function ($v) use ($account) {
                return $account->points_balance >= $v->points_required;
            })
            ->map(function ($v) {
                // buat object mirip CustomerVoucher untuk display
                return (object)[
                    'id' => null,
                    'voucher' => $v,
                    'expires_at' => $v->valid_until,
                    'is_redeemed' => false,
                    'points_only' => true,
                ];
            });

        // Gabungkan
        $availableVouchers = $assignedVouchers->concat($pointVouchers);

        // Voucher yang sudah dipakai
        $redeemedVouchers = $account->customerVouchers()
            ->where('is_redeemed', true)
            ->with('voucher')
            ->latest('redeemed_at')
            ->get();

        return view('pages.voucher.checkVoucher', compact('availableVouchers', 'redeemedVouchers'));
    }
}
