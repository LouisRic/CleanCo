<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryOrder;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = LaundryOrder::with(['account', 'laundryType'])
            ->where('account_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('pages.customer.orderHistory', [
            'orders' => $orders
        ]);
    }
}
