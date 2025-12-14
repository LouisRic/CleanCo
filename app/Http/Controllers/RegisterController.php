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
        
        $messages = [
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already registered',
            'password.min' => 'Password must be at least 6 characters',
            'password.confirmed' => 'Password confirmation does not match',
        ];

        $validateData = $request->validate($rules, $messages);

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
