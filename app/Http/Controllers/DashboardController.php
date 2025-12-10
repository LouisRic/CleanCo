<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\LaundryType;
use App\Models\LaundryOrder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'customerCount' => Account::count(),
            'serviceCount' => LaundryType::count(),
            'transactionCount' => LaundryOrder::count(),
        ]);
    }
}
