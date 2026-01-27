<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\TransactionsController;
Route::get('/', function () {
    return view('home');
});

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [LoginController::class, 'index'])->name('login.post');

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::post('register', [RegisterController::class, 'store'])->name('register.post');

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// Route for handling customer related 
Route::get('customers', [CustomerController::class, 'index'])->name('customer');



// Route for handling appointment related 
Route::get('appointments', [AppointmentController::class, 'index'])->name('appointment');


// revunue route 
Route::get('revenue', [TransactionsController::class, 'index'])->name('revenue');
Route::get('analysis', [TransactionsController::class, 'analysis'])->name('analytics');

Route::get('test', function () {
    return view('layouts.main');
});
