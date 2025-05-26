<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasakanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\FavoritesController;

// ✅ Halaman awal langsung ke dashboard user tanpa login
Route::get('/', [DashboardController::class, 'user'])->name('user.dashboard');

// About Us
Route::get('/about', [DashboardController::class, 'aboutUs'])->name('about.us');

// Login & logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/register/admin', [AuthController::class, 'showAdminRegister'])->name('register.admin');
Route::post('/register/admin', [AuthController::class, 'registerAdmin']);

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Public Masakan routes
Route::get('/search', [MasakanController::class, 'search'])->name('masakans.search');
Route::get('/masakans/{masakan}', [MasakanController::class, 'show'])->name('masakans.show');

// Kategori Masakan routes
Route::get('/masakans/kategori/{kategori}', [MasakanController::class, 'kategori'])->name('masakans.kategori');

// Forgot & Reset Password
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// 🔒 Protected routes (butuh login)
Route::middleware(['auth'])->group(function () {

    // Dashboard berdasarkan role (user & admin)
    Route::get('/dashboard/user', [DashboardController::class, 'user']);
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // Redirect dashboard berdasarkan role login
    Route::get('/dashboard', function () {
        $user = auth()->user();
        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect('/dashboard/user');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
    // Protected Masakan routes (CRUD operations except show)
    Route::get ('/tambah/tambah', [MasakanController::class, 'create'])->name('masakans.tambah');
    Route::post('/masakans', [MasakanController::class, 'store'])->name('masakans.store');
    Route::get('/masakans/{masakan}/edit', [MasakanController::class, 'edit'])->name('masakans.edit');
    Route::put('/masakans/{masakan}', [MasakanController::class, 'update'])->name('masakans.update');
    Route::delete('/masakans/{masakan}', [MasakanController::class, 'destroy'])->name('masakans.destroy');

    // Route for adding a review
    Route::post('/masakans/{masakan}/ulasans', [UlasanController::class, 'store'])->name('ulasans.store');

    // Route for deleting a review
    Route::delete('/ulasans/{id}', [UlasanController::class, 'destroy'])->name('ulasans.destroy');

    // Route for favorite Masakans
    Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{masakan}', [FavoritesController::class, 'addToFavorites'])->name('favorites.add');
    Route::delete('/favorites/{masakan}', [FavoritesController::class, 'removeFromFavorites'])->name('favorites.remove');
    Route::get('/favorites/check/{masakan}', [FavoritesController::class, 'checkFavorite'])->name('favorites.check');
});
