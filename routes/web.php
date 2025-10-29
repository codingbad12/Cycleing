<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ShipController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TypeController;

// Main routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Ship routes
Route::get('/ships', [ShipController::class, 'index'])->name('ships.index');
Route::get('/ships/{id}', [ShipController::class, 'show'])->name('ships.show');

// Authentication routes
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'index']);

    // Type Management Routes
    Route::get('/admin/type', [TypeController::class, 'index'])->name('types.index');
    Route::get('/admin/type/create', [TypeController::class, 'create'])->name('types.create');
    Route::post('/', [TypeController::class, 'store'])->name('types.store');
    Route::get('/{type}/edit', [TypeController::class, 'edit'])->name('types.edit');
    Route::delete('/{type}', [TypeController::class, 'destroy'])->name('types.destroy');
    Route::put('/{type}', [TypeController::class, 'update'])->name('types.update');

    // Ship Management Routes
    Route::get('/admin/ship', [ShipController::class, 'index'])->name('ships.index');
    Route::get('/admin/ship/create', [ShipController::class, 'create'])->name('ships.create');
    Route::post('/', [ShipController::class, 'store'])->name('ships.store');
    Route::get('/{ship}/edit', [ShipController::class, 'edit'])->name('ships.edit');
    Route::put('/{ship}', [ShipController::class, 'update'])->name('ships.update');
    Route::delete('/{ship}/destroy', [ShipController::class, 'destroy'])->name('ships.destroy');
});

Route::middleware(['auth', 'role:user,admin'])->group(function () {
    route::get('/user/home', [HomeController::class, 'index']);
});
