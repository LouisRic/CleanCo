<?php

use Illuminate\Support\Facades\Route;
use App\Models\LaundryType;
use App\Http\Controllers\LaundryTypeController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home.show');
})->name('home');

Route::get('/services', function () {
    return view('service.show');
})->name('service');

Route::get('/contact', function () {
    return view('contact.show');
})->name('contact');
