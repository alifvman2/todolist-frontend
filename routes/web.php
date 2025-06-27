<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', function () {
    return view('auth.login');
})->name('loginView');

Route::Post('/login', [LoginController::class, 'login'])->name('login');
Route::Post('/registration', [LoginController::class, 'registration'])->name('registration');
Route::Post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth.token');

Route::middleware('auth.token')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::resource('home', HomeController::class)->except(['index']);
    Route::post('/storeList', [HomeController::class, 'storeList'])->name('home.storeList');
});