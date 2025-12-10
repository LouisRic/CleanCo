<?php

namespace App\Http\Controllers;

use App\Models\LaundryOrder;
use App\Models\Account;
use App\Models\LaundryType;
use App\Models\Voucher;
use App\Models\CustomerVoucher;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index() {
        $transactions = LaundryOrder::with(['account', 'laundryType'])->get();

        return view('admin.reports.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = LaundryOrder::with(['account', 'laundryType', 'customerVoucher'])->findOrFail($id);
        return view('admin.reports.show', compact('transaction'));
    }
}
