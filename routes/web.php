<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HeroController;

//middleware guest/tamu
Route::middleware(['guest'])->group(function () {
    //route login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    //route landingpage
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
});
 
//middleware auth/admin
Route::middleware(['auth'])->group(function () {
    //route admin
    Route::get('/admin', [AdminController::class, 'view'])->name('admin');

    //route logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //route user 
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

    //route portofolio
    Route::get('/portofolio', [PortofolioController::class, 'view'])->name('portofolio.index');
    Route::get('/portofolio/create', [PortofolioController::class, 'create'])->name('portofolio.create');
    Route::post('/portofolio/create', [PortofolioController::class, 'store'])->name('portofolio.store');
    Route::get('/portofolio/edit/{portofolio}', [PortofolioController::class, 'edit'])->name('portofolio.edit');
    Route::put('/portofolio/edit/{portofolio}', [PortofolioController::class, 'update'])->name('portofolio.update');
    Route::delete('/portofolio/delete/{portofolio}', [PortofolioController::class, 'destroy'])->name('portofolio.destroy');

    //route hero
    Route::get('/hero/edit', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/hero/update', [HeroController::class, 'update'])->name('hero.update');
});