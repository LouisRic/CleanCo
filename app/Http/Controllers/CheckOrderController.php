<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryOrder;

class CheckOrderController extends Controller
{
    public function index(Request $request)
    {
        $invoiceCode = $request->query('invoice_code');
        $order = null;
        
        if ($invoiceCode) {
            $order = LaundryOrder::with(['account', 'laundryType'])
                ->where('id', $invoiceCode)
                ->first();
        }
        
        return view('pages.customer.checkOrder', [
            'order' => $order,
            'orderId' => $invoiceCode
        ]);
    }
}
