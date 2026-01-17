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
        $user = Account::findOrFail(Auth::id());

        // Cek apakah ini voucher yang sudah dimiliki customer
        $customerVoucher = CustomerVoucher::where('id', $id)
            ->where('account_id', $user->id)
            ->with('voucher')
            ->first();

        if ($customerVoucher) {
            $voucher = $customerVoucher->voucher;

            // Cek expired
            if ($customerVoucher->expires_at && $customerVoucher->expires_at->isPast()) {
                return back()->with('error', 'Voucher sudah kadaluarsa.');
            }

            // Cek sudah dipakai
            if ($customerVoucher->is_redeemed) {
                return back()->with('error', 'Voucher sudah digunakan.');
            }
        } else {
            // Jika voucher points-only
            $voucher = Voucher::find($id);
            if (!$voucher || $voucher->points_required <= 0) {
                return back()->with('error', 'Voucher tidak ditemukan.');
            }

            // Pastikan points cukup
            if ($user->points_balance < $voucher->points_required) {
                return back()->with('error', 'Points tidak cukup untuk redeem voucher ini.');
            }

            // Buat CustomerVoucher baru
            $customerVoucher = CustomerVoucher::create([
                'account_id' => $user->id,
                'voucher_id' => $voucher->id,
                'expires_at' => $voucher->valid_until,
                'is_redeemed' => false
            ]);
        }

        // Deduct points jika diperlukan
        if ($voucher->points_required > 0) {
            $user->points_balance -= $voucher->points_required;
            $user->save();

            $user->pointTransactions()->create([
                'amount' => -$voucher->points_required,
                'description' => 'Redeem voucher ' . $voucher->code,
                'balance_after_transaction' => $user->points_balance,
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
        $user = Account::findOrFail(Auth::id());

        $customerVoucher = CustomerVoucher::where('id', $id)
            ->where('account_id', $user->id)
            ->with('voucher')
            ->firstOrFail();

        if (!$customerVoucher->is_redeemed) {
            return back()->with('error', 'Voucher belum digunakan.');
        }

        if ($customerVoucher->redeemed_at->diffInMinutes(now()) > 5) {
            return back()->with('error', 'Voucher tidak bisa dibatalkan lagi.');
        }

        $voucher = $customerVoucher->voucher;

        // Refund points jika ada
        if ($voucher->points_required > 0) {
            $user->points_balance += $voucher->points_required;
            $user->save();

            $user->pointTransactions()->create([
                'amount' => $voucher->points_required,
                'description' => 'Cancel redeem voucher ' . $voucher->code,
                'balance_after_transaction' => $user->points_balance,
                'type' => 'earn'
            ]);
        }

        // Reset voucher status
        $customerVoucher->update([
            'is_redeemed' => 0,
            'redeemed_at' => null
        ]);

        return back()->with('success', 'Penggunaan voucher dibatalkan.');
    }

    public function index()
    {
        $user = Auth::user();

        // Ambil semua voucher points aktif
        $activePointVouchers = Voucher::where('is_active', 1)
            ->where('points_required', '>', 0)
            ->whereDate('valid_from', '<=', now())
            ->whereDate('valid_until', '>=', now())
            ->get();

        // Buat record CustomerVoucher jika belum ada
        foreach ($activePointVouchers as $voucher) {
            CustomerVoucher::firstOrCreate([
                'account_id' => $user->id,
                'voucher_id' => $voucher->id
            ]);
        }

        // Ambil semua voucher customer
        $customerVouchers = CustomerVoucher::where('account_id', $user->id)
            ->with('voucher')
            ->get();

        // Filter
        $availableVouchers = $customerVouchers->filter(
            fn($cv) =>
            !$cv->is_redeemed &&
                $cv->voucher->is_active &&
                $cv->voucher->points_required > 0
        );

        $redeemedVouchers = $customerVouchers->filter(fn($cv) => $cv->is_redeemed);

        return view('pages.voucher.checkVoucher', compact('availableVouchers', 'redeemedVouchers'));
    }
}
