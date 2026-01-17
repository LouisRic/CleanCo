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

        // ✅ Assigned voucher yang sedang aktif (kode bisa dipakai admin)
        $assignedVouchers = CustomerVoucher::with('voucher')
            ->where('account_id', $account->id)
            ->where('is_redeemed', 1)
            ->get();

        // ✅ Points-only voucher
        $pointVouchers = Voucher::where('points_required', '>', 0)
            ->where('is_active', 1)
            ->get()
            ->map(function ($v) use ($account) {

                $existing = CustomerVoucher::where('account_id', $account->id)
                    ->where('voucher_id', $v->id)
                    ->latest('id')
                    ->first();

                // ✅ Patokan "sudah pernah tukar" = redeemed_at pernah ada (bukan is_redeemed)
                $alreadyRedeemedEver = $existing?->redeemed_at !== null;

                return (object)[
                    'id' => $existing?->id,
                    'voucher' => $v,
                    'expired_at' => $v->valid_until,
                    'points_only' => true,

                    // dipakai untuk UI disable tombol
                    'is_redeemed' => $alreadyRedeemedEver,

                    // dipakai untuk UI disable kalau poin kurang
                    'can_redeem' => ($account->points_balance >= $v->points_required) && !$alreadyRedeemedEver,
                ];
            });

        $availableVouchers = $assignedVouchers->concat($pointVouchers);

        // ✅ Redeemed list: voucher yang sudah ditukar dan masih aktif (is_redeemed=1)
        $redeemedVouchers = CustomerVoucher::with('voucher')
            ->where('account_id', $account->id)
            ->where('is_redeemed', 1)
            ->whereNotNull('redeemed_at')
            ->latest('redeemed_at')
            ->get();

        return view('pages.voucher.checkVoucher', compact('availableVouchers', 'redeemedVouchers'));
    }
}
