<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\CustomerVoucher;
use App\Models\Account;
use App\Models\Voucher;

class CustomerVoucherController extends Controller
{
    public function use($id)
    {
        $user = Account::findOrFail(Auth::id());

        $customerVoucher = null;
        $voucher = null;

        // 1) coba $id sebagai CustomerVoucher id (assigned)
        $customerVoucher = CustomerVoucher::where('id', $id)
            ->where('account_id', $user->id)
            ->with('voucher')
            ->first();

        if ($customerVoucher) {
            $voucher = $customerVoucher->voucher;

            // assigned: kalau sudah pernah ditukar (redeemed_at ada) -> jangan tukar lagi
            if ($customerVoucher->redeemed_at) {
                return back()->with('error', 'Voucher ini sudah pernah ditukar.');
            }
        } else {
            // 2) points-only: $id adalah voucher_id
            $voucher = Voucher::find($id);

            if (!$voucher || $voucher->points_required <= 0) {
                return back()->with('error', 'Voucher tidak ditemukan.');
            }

            // ✅ BLOK: kalau sudah pernah ditukar (redeemed_at ada), jangan boleh tukar lagi
            $everRedeemed = CustomerVoucher::where('account_id', $user->id)
                ->where('voucher_id', $voucher->id)
                ->whereNotNull('redeemed_at')
                ->exists();

            if ($everRedeemed) {
                return back()->with('error', 'Voucher ini sudah pernah ditukar.');
            }

            if ($user->points_balance < $voucher->points_required) {
                return back()->with('error', 'Points tidak cukup untuk tukar voucher ini.');
            }

            // buat row baru (belum ditukar dulu)
            $customerVoucher = CustomerVoucher::create([
                'account_id' => $user->id,
                'voucher_id' => $voucher->id,
                'expired_at' => $voucher->valid_until,
                'is_redeemed' => 0
            ]);
        }

        // expired?
        if ($customerVoucher->expired_at && $customerVoucher->expired_at->isPast()) {
            return back()->with('error', 'Voucher sudah kadaluarsa.');
        }

        // kalau sudah aktif (is_redeemed=1) berarti sudah ditukar
        if ($customerVoucher->is_redeemed) {
            return back()->with('error', 'Voucher sudah ditukar dan sedang aktif.');
        }

        // deduct points (points-only)
        if ($voucher->points_required > 0) {
            $balanceAfter = $user->points_balance - $voucher->points_required;

            $user->pointTransactions()->create([
                'amount' => -$voucher->points_required,
                'description' => 'Redeem voucher ' . $voucher->code,
                'balance_after_transaction' => $balanceAfter,
                'type' => 'redeem'
            ]);
        }

        // tandai sudah ditukar + aktif untuk admin
        $customerVoucher->update([
            'is_redeemed' => 1,
            'redeemed_at' => now()
        ]);

        return back()->with('success', 'Voucher berhasil ditukar.');
    }
}
