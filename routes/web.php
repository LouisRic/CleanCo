<?php

use App\Http\Controllers\LaundryTypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;


// ==============================
// PUBLIC ROUTES
// ==============================
Route::get('/', fn() => view('home.show'))->name('home');
Route::get('/services', fn() => view('service.show'))->name('service');
Route::get('/contact', fn() => view('contact.show'))->name('contact');

// AUTH
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//LOCALIZATION
Route::get('/lang/{locale}', function($locale){
    if(!in_array($locale, ['en', 'id'])){
        abort(400);
    }

    session(['locale' => $locale]);
    app()->setlocale($locale);

    return redirect()->back();
})->name('change.lang');

// ==============================
// ADMIN ROUTES (Protected by admin middleware)
// ==============================
Route::prefix('admin')->middleware('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::prefix('services')->group(function () {
        Route::get('', [LaundryTypeController::class, 'index'])->name('services.index');
        Route::get('create', [LaundryTypeController::class, 'create'])->name('services.create');
        Route::post('store', [LaundryTypeController::class, 'store'])->name('services.store');
        Route::put('{id}/update', [LaundryTypeController::class, 'update'])->name('services.update');
        Route::get('{id}/edit', [LaundryTypeController::class, 'edit'])->name('services.edit');
        Route::delete('{id}/delete', [LaundryTypeController::class, 'destroy'])->name('services.delete');
    });

    Route::prefix('transactions')->group(function () {
        Route::get('', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('create', [TransactionController::class, 'create'])->name('transactions.create');
        Route::post('', [TransactionController::class, 'store'])->name('transactions.store');
        Route::patch('{order}/status', [TransactionController::class, 'updateStatus'])->name('transactions.updateStatus');

        Route::get('{id}', [TransactionController::class, 'show'])->name('transactions.show');
        Route::get('{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
        Route::put('{id}', [TransactionController::class, 'update'])->name('transactions.update');
        Route::delete('{id}', [TransactionController::class, 'destroy'])->name('transactions.delete');
    });

    Route::prefix('reports')->group(function () {
        Route::get('', [ReportController::class, 'index'])->name('reports.index');
        Route::get('{id}', [ReportController::class, 'show'])->name('reports.show');
    });

    Route::prefix('customers')->group(function () {
        Route::get('', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('{id}', [CustomerController::class, 'show'])->name('customers.show');
        Route::delete('{id}', [CustomerController::class, 'destroy'])->name('customers.delete');
    });
});


// ==============================
// CUSTOMER ROUTES
// ==============================
Route::prefix('customer')->middleware('customer')->group(function () {
    Route::get('/dashboard', fn() => view('pages.customer.customerDashboard'))
        ->name('customer.dashboard');
});

Route::get('/profile', function () {
    return view('profile.profile');
})->name('profile');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/profile/logout', function () {
    return view('profile.logout');
})->name('profile.logout');

Route::get('/profile/password', [PasswordController::class, 'edit'])->name('profile.edit-password');
Route::put('/profile/password', [PasswordController::class, 'update'])->name('profile.update-password');

Route::get('/profile/language', [ProfileController::class, 'language'])
    ->name('profile.language');
