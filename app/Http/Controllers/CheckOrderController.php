<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryOrder;

class CheckOrderController extends Controller
{
    public function index(Request $request)
    {
        // Get order ID from query parameter (numeric ID, e.g., 1, 2, 3)
        $invoiceCode = $request->query('invoice_code');
        $order = null;
        
        if ($invoiceCode) {
            // Search order by numeric ID
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
