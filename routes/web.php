<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\CheckOrderController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\OrderInvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Tidak perlu authentication)
|--------------------------------------------------------------------------
| Route yang bisa diakses oleh siapa saja tanpa perlu login
*/

Route::get('/', function () {
    return view('home.show');
})->name('home');

Route::get('/services', function () {
    return view('service.show');
})->name('service');

Route::get('/contact', function () {
    return view('contact.show');
})->name('contact');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('admin')->group(function () {
    // Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware('customer')->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/customer/check-order', [CheckOrderController::class, 'index'])->name('customer.check-order');
    Route::get('/customer/order-history', [OrderHistoryController::class, 'index'])->name('customer.order-history');
    Route::get('/customer/order-invoice/{id}', [OrderInvoiceController::class, 'index'])->name('customer.order-invoice');
});
