<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class RegisterController extends Controller
{

    public function showRegisterForm(){
        return view('pages.register');
    }

    public function register(Request $request){

        $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:accounts',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'telephone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed'
        ];

        $validateData = $request->validate($rules);

        Account::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'gender' => $validateData['gender'],
            'address' => $validateData['address'],
            'telephone' => $validateData['telephone'],
            'password'=> Hash::make($validateData['password'])
        ]);

        return redirect('/login')->with('success', 'Registration is successfull!');
    }
}
