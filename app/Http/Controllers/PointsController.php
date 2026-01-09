<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\PointTransaction;

class PointsController extends Controller
{
    public function index()
    {
        $account = Auth::user();

        return view('pages.voucher.point', [
            'pointsBalance' => $account->points_balance ?? 0,

            'transactions' => PointTransaction::where('account_id', $account->id)
                ->latest()
                ->get()
        ]);
    }
}
