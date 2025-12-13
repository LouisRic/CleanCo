<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $accounts = Account::orderBy('name')->get();

        return view('admin.customers.index', compact('accounts'));
    }

    public function show($id)
    {
        $account = Account::findOrFail($id);

        return view('admin.customers.show', compact('account'));
    }

    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
