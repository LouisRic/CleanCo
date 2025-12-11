<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


//Tolong cek .env.example, ada beberapa tambahan

Route::get('/', function () {
    return view('home.show');
})->name('home');

Route::get('/services', function () {
    return view('service.show');
})->name('service');

Route::get('/contact', function () {
    return view('contact.show');
})->name('contact');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('admin')->group(function () {
    //Buat page yang restricted cuman untuk admin routes nya masukkin di sini ya
    Route::get('/admin/dashboard', action: function () {
        return view('pages.admin.adminDashboard');
    })->name('admin.dashboard');
});

Route::middleware('customer')->group(function () {
    //Buat page yang restricted cuman untuk customer routes nya masukkin di sini ya
    Route::get("/customer/dashboard", function () {
        return view('pages.customer.customerDashboard');
    })->name('customer.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth']);


// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect('/dashboard');
// })->middleware(['auth', 'signed'])->name('verification.verify');


// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
