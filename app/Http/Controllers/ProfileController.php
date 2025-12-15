<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Account;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:accounts,email,' . Auth::id(),
            'telephone' => 'required|unique:accounts,telephone,' . Auth::id(),
            'address'   => 'required|string',
            'gender'    => 'required|in:male,female',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $account = Account::findOrFail(Auth::id());

        if ($request->hasFile('photo')) {
            if ($account->photo) {
                Storage::disk('public')->delete($account->photo);
            }

            $validated['photo'] = $request->file('photo')
                ->store('profile-photos', 'public');
        }

        $account->update($validated);

        Auth::login($account);

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profile updated successfully');
    }

    public function language()
    {
        // anggap disini data buat bahasa, untuk sementara return dulu
        return view('profile.language');
    }
}
