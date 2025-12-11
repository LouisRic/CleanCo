<?php

use App\Http\Controllers\LaundryTypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::prefix('services')->group(function () {
        // Services
        Route::get('', [LaundryTypeController::class, 'index'])->name('services.index');
        Route::get('create', [LaundryTypeController::class, 'create'])->name('services.create');
        Route::post('store', [LaundryTypeController::class, 'store'])->name('services.store');
        Route::put('{id}/update', [LaundryTypeController::class, 'update'])->name('services.update');
        Route::get('{id}/edit', [LaundryTypeController::class, 'edit'])->name('services.edit');
        Route::delete('{id}/delete', [LaundryTypeController::class, 'destroy'])->name('services.delete');
    });

    Route::prefix('transactions')->group(function () {
        // Transactions
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
        // Reports
        Route::get('', [ReportController::class, 'index'])->name('reports.index');
        Route::get('{id}', [ReportController::class, 'show'])->name('reports.show');
    });

    Route::prefix('customers')->group(function () {
        // Customers
        Route::get('', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('{id}', [CustomerController::class, 'show'])->name('customers.show');
        Route::delete('{id}', [CustomerController::class, 'destroy'])->name('customers.delete');
    });

    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});
