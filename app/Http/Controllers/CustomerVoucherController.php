<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerVoucher;
use App\Models\Account;
use App\Models\Voucher;

class CustomerVoucherController extends Controller
{
    // Redeem voucher
    public function use($id)
    {
        $user = Account::find(Auth::id());

        // Cek voucher id apakah CustomerVoucher atau Voucher langsung (points-only)
        if (is_numeric($id)) {
            $customerVoucher = CustomerVoucher::where('id', $id)
                ->where('account_id', $user->id)
                ->with('voucher')
                ->first();
        }

        if (!$customerVoucher) {
            // Cek voucher points-only
            $voucher = Voucher::find($id);

            if (!$voucher || $voucher->points_required <= 0) {
                return back()->with('error', 'Voucher tidak ditemukan.');
            }

            // Pastikan points cukup
            if ($user->points_balance < $voucher->points_required) {
                return back()->with('error', 'Points tidak cukup untuk redeem voucher ini.');
            }

            // Buat CustomerVoucher sementara
            $customerVoucher = CustomerVoucher::create([
                'account_id' => $user->id,
                'voucher_id' => $voucher->id,
                'expires_at' => $voucher->valid_until,
                'is_redeemed' => false
            ]);
        } else {
            $voucher = $customerVoucher->voucher;
        }

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
            $balanceAfter = $user->points_balance - $voucher->points_required;
            $user->pointTransactions()->create([
                'amount' => -$voucher->points_required,
                'description' => 'Redeem voucher ' . $voucher->code,
                'balance_after_transaction' => $balanceAfter,
                'type' => 'redeem'
            ]);
        }

        // Tandai voucher sudah dipakai
        $customerVoucher->update([
            'is_redeemed' => 1,
            'redeemed_at' => now()
        ]);

        return back()->with('success', 'Voucher berhasil digunakan.');
    }

    // Cancel / revert voucher
    public function cancel($id)
    {
        $user = Account::find(Auth::id());

        $customerVoucher = CustomerVoucher::where('id', $id)
            ->where('account_id', $user->id)
            ->with('voucher')
            ->firstOrFail();

        if (!$customerVoucher->redeemed_at) {
            return back()->with('error', 'Voucher belum digunakan.');
        }

        if ($customerVoucher->redeemed_at->diffInMinutes(now()) > 5) {
            return back()->with('error', 'Voucher tidak bisa dibatalkan lagi.');
        }

        $voucher = $customerVoucher->voucher;

        if ($voucher->points_required > 0) {
            $balanceAfter = $user->points_balance + $voucher->points_required;
            $user->pointTransactions()->create([
                'amount' => $voucher->points_required,
                'description' => 'Cancel redeem voucher ' . $voucher->code,
                'balance_after_transaction' => $balanceAfter,
                'type' => 'earn'
            ]);
        }

        $customerVoucher->update([
            'is_redeemed' => 0,
            'redeemed_at' => null
        ]);

        return back()->with('success', 'Penggunaan voucher dibatalkan.');
    }
}
