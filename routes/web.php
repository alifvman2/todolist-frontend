<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('auth.login');
});

Route::Post('/login', [LoginController::class, 'login'])->name('login');
Route::Post('/registration', [LoginController::class, 'registration'])->name('registration');