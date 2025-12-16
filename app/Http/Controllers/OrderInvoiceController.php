<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryOrder;

class OrderInvoiceController extends Controller
{
    public function index($id)
    {
        $order = LaundryOrder::with(['account', 'laundryType'])
            ->where('id', $id)
            ->firstOrFail();
        
        return view('pages.customer.orderInvoice', [
            'order' => $order
        ]);
    }
}
