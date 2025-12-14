<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{

    public function showRegisterForm()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:accounts',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'telephone' => 'required|string|max:15|unique:accounts',
            'password' => 'required|string|min:6|confirmed'
        ];

        $validateData = $request->validate($rules);

        // 1. Create User
        $user = Account::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'gender' => $validateData['gender'],
            'address' => $validateData['address'],
            'telephone' => $validateData['telephone'],
            'password' => Hash::make($validateData['password'])
        ]);

        // event(new Registered($user));

        // 2. Auto login (tanpa warning Intelephense)
        Auth::login($user);

        // 3. Send verification email
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('customer.dashboard');
    }
}
