<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipeController;

// Redirect root to login
Route::get('/', fn () => redirect('/login'));

// Login & logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/register/admin', [AuthController::class, 'showAdminRegister'])->name('register.admin');
Route::post('/register/admin', [AuthController::class, 'registerAdmin']);

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard berdasarkan role
    Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('user.dashboard');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // Jika ingin tetap menyimpan route lama, bisa redirect berdasarkan role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    })->name('dashboard');
});
