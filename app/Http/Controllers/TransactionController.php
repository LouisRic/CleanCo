<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\LaundryOrder;
use App\Models\Account;
use App\Models\LaundryType;
use App\Models\Voucher;
use App\Models\CustomerVoucher;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = LaundryOrder::with(['account', 'laundryType'])
            ->where(function ($q) {
                $q->where('payment_status', '!=', 'paid')
                    ->orWhere('laundry_status', '!=', 'completed')
                    ->orWhere('pickup_status', '!=', 'picked_up');
            })->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = LaundryOrder::with(['account', 'laundryType', 'customerVoucher'])->findOrFail($id);
        return view('admin.transactions.show', compact('transaction'));
    }

    public function edit($id)
    {
        $transaction = LaundryOrder::with(['account', 'laundryType', 'customerVoucher'])->findOrFail($id);
        return view('admin.transactions.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $transaction = LaundryOrder::findOrFail($id);

        $request->validate([
            'payment_status' => 'required|in:paid,unpaid',
            'laundry_status' => 'required|in:process,washed,ready,completed',
            'pickup_status'  => 'required|in:pending,picked_up',
        ]);

        $transaction->payment_status = $request->payment_status;
        $transaction->laundry_status = $request->laundry_status;

        // If picked_up → set pickup_date (kalau belum)
        if ($request->pickup_status === 'picked_up') {
            if (!$transaction->pickup_date) {
                $transaction->pickup_date = Carbon::today()->toDateString();
            }
        } else {
            // kalau balik lagi ke pending, boleh kosongin
            $transaction->pickup_date = null;
        }
        $transaction->pickup_status = $request->pickup_status;

        $transaction->save();

        return redirect()
            ->route('transactions.show', $transaction->id)
            ->with('success', 'Transaction status updated successfully!');
    }

    public function destroy($id)
    {
        $transaction = LaundryOrder::findOrFail($id);
        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }

    public function create()
    {
        $accounts = Account::all();
        $types = LaundryType::all();
        $vouchers = Voucher::all();
        $nextId   = (LaundryOrder::max('id') ?? 0) + 1;
        $nextCode = 'LD' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        return view('admin.transactions.create', compact(
            'accounts',
            'types',
            'vouchers',
            'nextCode'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_id'       => 'required|exists:accounts,id',
            'laundry_type_id'  => 'required|exists:laundry_types,id',
            'voucher_code'     => 'nullable|string',

            'order_date'       => 'required|date',
            'pickup_date'      => 'nullable|date',
            'weight_kg'        => 'required|numeric|min:0.1',

            'notes'            => 'nullable|string',

            'payment_status'   => 'required|in:paid,unpaid',
            'laundry_status'   => 'required|in:process,washed,ready,completed',
            'pickup_status'    => 'required|in:pending,picked_up',
        ]);

        $type = LaundryType::findOrFail($request->laundry_type_id);
        $price_per_kg = $type->price_per_kg;

        $subtotal = $price_per_kg * $request->weight_kg;
        $discount = 0;
        $voucherId = null;
        $customerVoucher = null;

        if ($request->voucher_code) {

            // Cari voucher yg dimiliki customer & belum dipakai
            $customerVoucher = CustomerVoucher::where('account_id', $request->account_id)
                ->whereHas('voucher', function ($q) use ($request) {
                    $q->where('code', strtoupper($request->voucher_code));
                })
                ->where('is_redeemed', false)
                ->first();

            if (!$customerVoucher) {
                return back()->withErrors([
                    'voucher_code' =>
                    'Customer does not have this voucher or it has already been used.'
                ]);
            }

            $voucher = $customerVoucher->voucher;
            $today = now()->toDateString();

            // Cek kondisi valid
            $isValid =
                $voucher->is_active &&
                $today >= $voucher->valid_from &&
                $today <= $voucher->valid_until &&
                $subtotal >= $voucher->minimum_spend;

            if (!$isValid) {
                return back()->withErrors(['voucher_code' => 'Voucher is not valid for this transaction.']);
            }

            // Hitung diskon
            $voucherId = $voucher->id;

            if ($voucher->type === 'percentage') {
                $discount = ($subtotal * $voucher->value) / 100;
            } else {
                $discount = $voucher->value;
            }
        }

        $finalTotal = max(0, $subtotal - $discount);

        $pickupDate = $request->pickup_date;

        if ($request->pickup_status === 'picked_up' && !$pickupDate) {
            $pickupDate = now()->toDateString();
        }

        $order = LaundryOrder::create([
            'account_id'       => $request->account_id,
            'laundry_type_id'  => $request->laundry_type_id,
            'voucher_id'       => $voucherId,

            'order_date'       => $request->order_date,
            'pickup_date'      => $pickupDate,

            'weight_kg'        => $request->weight_kg,
            'price_per_kg'     => $price_per_kg,
            'total_price'      => $finalTotal,

            'notes'            => $request->notes,

            'payment_status'   => $request->payment_status,
            'laundry_status'   => $request->laundry_status,
            'pickup_status'    => $request->pickup_status,
        ]);

        $account = $order->account; // relasi account di LaundryOrder
        $pointsEarned = floor($order->weight_kg); // misal 1 kg = 1 point

        if ($pointsEarned > 0) {
            $balanceAfter = $account->points_balance + $pointsEarned;

            $account->pointTransactions()->create([
                'amount' => $pointsEarned,
                'description' => 'Points dari order #' . $order->id,
                'balance_after_transaction' => $balanceAfter,
                'type' => 'earn',
            ]);
        }

        if ($customerVoucher) {
            $customerVoucher->update([
                'is_redeemed'     => true,
                'redeemed_at'     => now(),
                'laundry_order_id' => $order->id
            ]);
        }

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction created successfully!');
    }
}
