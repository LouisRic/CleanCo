<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerVoucher;

class AdminVoucherController extends Controller
{
    public function useByCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $raw = strtoupper(trim($request->code));

        // terima format: CV-000123 atau 123
        if (str_starts_with($raw, 'CV-')) {
            $num = substr($raw, 3);
            $num = ltrim($num, '0');
            $id = $num === '' ? 0 : (int)$num;
        } else {
            $id = ctype_digit($raw) ? (int)$raw : 0;
        }

        if ($id <= 0) {
            return back()->with('error', 'Format kode voucher tidak valid.');
        }

        $cv = CustomerVoucher::with('voucher')->where('id', $id)->first();

        if (!$cv) {
            return back()->with('error', 'Kode voucher tidak ditemukan.');
        }

        // harus sudah ditukar user
        if (!$cv->redeemed_at || !$cv->is_redeemed) {
            return back()->with('error', 'Voucher belum ditukar atau sudah dipakai.');
        }

        // expired?
        if ($cv->expired_at && $cv->expired_at->isPast()) {
            return back()->with('error', 'Voucher sudah kadaluarsa.');
        }

        // ✅ "dipakai admin" = diilangin dari redeemed list
        // jangan hapus redeemed_at supaya user gak bisa tukar lagi
        $cv->update([
            'is_redeemed' => 0,
        ]);

        return back()->with('success', 'Voucher berhasil dipakai.');
    }
}
