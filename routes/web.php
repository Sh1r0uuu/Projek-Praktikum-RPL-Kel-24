<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ProfileController;

Route::get('/', fn () => redirect('/login'));

// Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/register/admin', [AuthController::class, 'showAdminRegister'])->name('register.admin');
Route::post('/register/admin', [AuthController::class, 'registerAdmin']);

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('user.dashboard');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/dashboard', function () {
        $user = auth()->user();
        return $user->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Recipe Routes
    Route::get('/recipes/{id}', [RecipeController::class, 'show'])->name('recipes.show');
    Route::get('/recipes/category/{category}', [RecipeController::class, 'filterByCategory'])->name('recipes.category');
    Route::get('/recipes/category/{category}/search', [RecipeController::class, 'searchInCategory'])->name('search.category');
    
    // Pencarian resep berdasarkan kata kunci
    Route::get('/search', [RecipeController::class, 'searchRecipes'])->name('search.recipes');  // Menambahkan route pencarian

    Route::get('/recipe/{id}', [RecipeController::class, 'show'])->name('recipe.show');






});
