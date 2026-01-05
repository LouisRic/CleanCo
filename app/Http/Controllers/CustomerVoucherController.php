<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerVoucher;
use App\Models\Account;

class CustomerVoucherController extends Controller
{
    // Redeem voucher
    public function use($id)
    {
        // Ambil voucher customer
        $customerVoucher = CustomerVoucher::where('id', $id)
            ->where('account_id', Auth::id())
            ->with('voucher')
            ->firstOrFail();

        $voucher = $customerVoucher->voucher;

        $user = Account::find(Auth::id());

        // Cek expired
        if ($customerVoucher->expires_at && $customerVoucher->expires_at->isPast()) {
            return back()->with('error', 'Voucher sudah kadaluarsa.');
        }

        // Cek sudah dipakai
        if ($customerVoucher->is_redeemed) {
            return back()->with('error', 'Voucher sudah digunakan.');
        }

        // Deduct points 
        if ($voucher->points_required > 0) {
            if ($user->points_balance < $voucher->points_required) {
                return back()->with('error', 'Points tidak cukup untuk redeem voucher ini.');
            }

            $balanceAfter = $user->points_balance - $voucher->points_required;
            $user->pointTransactions()->create([
                'amount' => -$voucher->points_required,
                'description' => 'Redeem voucher ' . $voucher->code,
                'balance_after_transaction' => $balanceAfter,
                'type' => 'redeem'
            ]);
        }

        // voucher sudah dipakai
        $customerVoucher->update([
            'is_redeemed' => 1,
            'redeemed_at' => now()
        ]);

        return back()->with('success', 'Voucher berhasil digunakan.');
    }

    // Cancel / revert voucher
    public function cancel($id)
    {
        // Ambil voucher customer
        $customerVoucher = CustomerVoucher::where('id', $id)
            ->where('account_id', Auth::id())
            ->with('voucher')
            ->firstOrFail();

        // Belum dipakai
        if (!$customerVoucher->redeemed_at) {
            return back()->with('error', 'Voucher belum digunakan.');
        }

        // Batasi cancel max 5 menit
        if ($customerVoucher->redeemed_at->diffInMinutes(now()) > 5) {
            return back()->with('error', 'Voucher tidak bisa dibatalkan lagi.');
        }

        $user = Account::find(Auth::id());
        $voucher = $customerVoucher->voucher;

        // Revert points kalau voucher pakai points
        if ($voucher->points_required > 0) {
            $balanceAfter = $user->points_balance + $voucher->points_required;

            $user->pointTransactions()->create([
                'amount' => $voucher->points_required,
                'description' => 'Cancel redeem voucher ' . $voucher->code,
                'balance_after_transaction' => $balanceAfter,
                'type' => 'earn'
            ]);
        }

        // Tandai voucher belum dipakai
        $customerVoucher->update([
            'is_redeemed' => 0,
            'redeemed_at' => null
        ]);

        return back()->with('success', 'Penggunaan voucher dibatalkan.');
    }
}
