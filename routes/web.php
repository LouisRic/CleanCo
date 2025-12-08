<?php

use App\Http\Controllers\LaundryTypeController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    // Services
    Route::get('services', [LaundryTypeController::class, 'index'])->name('services.index');
    Route::post('services/store', [LaundryTypeController::class, 'store'])->name('services.store');
    Route::put('services/{id}/update', [LaundryTypeController::class, 'update'])->name('services.update');
    Route::delete('services/{id}/delete', [LaundryTypeController::class, 'destroy'])->name('services.delete');

    // Transactions
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::patch('transactions/{order}/status', [TransactionController::class, 'updateStatus'])->name('transactions.updateStatus');

    Route::get('transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::get('transactions/{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::delete('transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.delete');

});
