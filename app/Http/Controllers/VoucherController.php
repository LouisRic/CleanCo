<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Voucher;
use App\Models\CustomerVoucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    // Tampilkan semua voucher (admin)
    public function index()
    {
        $vouchers = Voucher::all();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    // Form tambah voucher
    public function create()
    {
        return view('admin.vouchers.create');
    }

    // Simpan voucher baru
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:vouchers,code|max:20',
            'name' => 'required|max:255',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'minimum_spend' => 'nullable|numeric|min:0',
            'points_required' => 'nullable|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'is_active' => 'required|boolean',
        ]);

        Voucher::create($request->all());

        return redirect()->route('vouchers.index')->with('success', 'Voucher berhasil ditambahkan!');
    }

    // Form edit voucher
    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.vouchers.edit', compact('voucher'));
    }

    // Update voucher
    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);

        $request->validate([
            'code' => 'required|max:20|unique:vouchers,code,' . $voucher->id,
            'name' => 'required|max:255',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'minimum_spend' => 'nullable|numeric|min:0',
            'points_required' => 'nullable|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'is_active' => 'required|boolean',
        ]);

        $voucher->update($request->all());

        return redirect()->route('vouchers.index')->with('success', 'Voucher berhasil diupdate!');
    }

    // Delete voucher
    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        return redirect()->route('vouchers.index')->with('success', 'Voucher berhasil dihapus!');
    }
}
