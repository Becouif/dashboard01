<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
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
