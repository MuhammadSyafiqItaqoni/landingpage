<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\HomeController;

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
    Route::get('/', [HomeController::class, 'view'])->name('home');
    
});

// middleware auth/admin = untuk user yang sudah login sebagai admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'view'])->name('admin');
    // route logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // route users
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    // route edit user
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
    // route update user
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
    // route delete user
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

    // route portofolio
    Route::get('/portofolio', [PortofolioController::class, 'view'])->name('portofolio.index');
    Route::get('/portofolio/create', [PortofolioController::class, 'create'])->name('portofolio.create');
    Route::post('/portofolio/create', [PortofolioController::class, 'store'])->name('portofolio.store');
});
