<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', [UserController::class, 'create'])->name('user.create');

// User registration routes
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

// Login route
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/destroy', [UserController::class, 'destroy'])->name('user.destroy');

    // Change Password Route
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('user.changePassword');
});
