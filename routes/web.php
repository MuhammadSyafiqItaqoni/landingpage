<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// middleware guest/tamu = untuk user yang belum login
// middleware auth = untuk user yang sudah login
Route::middleware(['guest'])->group(function () {
    // route login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    // route register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    // route landing page
    Route::get('/', function () {
        return view('index');
    });
});

// middleware auth/admin = untuk user yang sudah login sebagai admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'view']);
    // route logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
