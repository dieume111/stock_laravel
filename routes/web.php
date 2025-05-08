<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductInController;
use App\Http\Controllers\ProductOutController;
use App\Http\Controllers\ReportsController; 

Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');


Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login')->name('login.submit');
        Route::get('/register', 'showRegisterForm')->name('register');
        Route::post('/register', 'register')->name('register.submit');
    });
Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});
Route::middleware('auth')->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('products', ProductController::class);
Route::resource('productin', ProductInController::class);
Route::resource('productout', ProductOutController::class);
Route::get('/productin-data', [ProductOutController::class, 'getProductInData'])->name('productout.productin');
Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
});