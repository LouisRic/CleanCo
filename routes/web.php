<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;



Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('admin')->group(function(){
    //Buat page yang restricted cuman untuk admin routes nya masukkin di sini ya
    Route::get('/admin/dashboard', function(){
        return view('pages.admin.adminDashboard');
    })->name('admin.dashboard');
});

Route::middleware('customer')->group(function(){
    //Buat page yang restricted cuman untuk customer routes nya masukkin di sini ya
    Route::get("/customer/dashboard", function(){
        return view('pages.customer.customerDashboard');
    })->name('customer.dashboard');
});