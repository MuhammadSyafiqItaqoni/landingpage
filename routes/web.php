<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

// Route untuk memproses pengiriman pesan dari user
Route::post('/messages/send', [MessageController::class, 'store'])->name('messages.store');

// middleware guest/tamu
Route::middleware(['guest'])->group(function () {
    // route login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // route landingpage
    Route::get('/', [HomeController::class, 'index'])->name('home');

});

// middleware auth/admin
Route::middleware(['auth'])->group(function () {
    // route admin
    Route::get('/admin', [AdminController::class, 'view'])->name('admin');

    // route logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // route user
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

    // route portofolio
    Route::get('/portofolio', [PortofolioController::class, 'view'])->name('portofolio.index');
    Route::get('/portofolio/create', [PortofolioController::class, 'create'])->name('portofolio.create');
    Route::post('/portofolio/create', [PortofolioController::class, 'store'])->name('portofolio.store');
    Route::get('/portofolio/edit/{portofolio}', [PortofolioController::class, 'edit'])->name('portofolio.edit');
    Route::put('/portofolio/edit/{portofolio}', [PortofolioController::class, 'update'])->name('portofolio.update');
    Route::delete('/portofolio/delete/{portofolio}', [PortofolioController::class, 'destroy'])->name('portofolio.destroy');

    // route hero
    Route::get('/hero/edit', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/hero/update', [HeroController::class, 'update'])->name('hero.update');

    // route service
    Route::get('/service', [ServiceController::class, 'index'])->name('service.index'); // SUDAH DIGANTI KE index
    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('/service', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit'); // Gunakan {id} agar cocok dengan controller
    Route::put('/service/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');

    // route team
    Route::get('/team', [TeamController::class, 'index'])->name('team.index'); // SUDAH DIGANTI KE index
    Route::get('/team/create', [TeamController::class, 'create'])->name('team.create');
    Route::post('/team', [TeamController::class, 'store'])->name('team.store');
    Route::get('/team/{id}/edit', [TeamController::class, 'edit'])->name('team.edit'); // Gunakan {id} agar cocok dengan controller
    Route::put('/team/{id}', [TeamController::class, 'update'])->name('team.update');
    Route::delete('/team/{id}', [TeamController::class, 'destroy'])->name('team.destroy');

    // Route untuk halaman admin (index)
    Route::get('/admin/messages', [MessageController::class, 'index'])->name('messages.index');

    // Route untuk menghapus pesan (delete)
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('message.destroy');

    Route::get('/messages/{id}/edit', [MessageController::class, 'edit'])->name('messages.edit');
    Route::put('/messages/{id}', [MessageController::class, 'update'])->name('messages.update');

});
