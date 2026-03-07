<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Admin login route (hidden - accessible only via direct URL)
Route::get('/admin/login', [\App\Http\Controllers\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [\App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');

// News routes (RSS)
Route::get('/news', [NewsController::class, 'newsPage'])->name('news');
Route::get('/api/news', [NewsController::class, 'api'])->name('news.api');

Route::get('/', [NewsController::class, 'index'])->name('home');

// Steam Auth routes
// Login: connecte un utilisateur existant
Route::get('/auth/steam/login', [\App\Http\Controllers\Auth\SteamController::class, 'redirectToSteamLogin'])
    ->name('steam.login');
    
// Register: cree un nouveau compte utilisateur  
Route::get('/auth/steam/register', [\App\Http\Controllers\Auth\SteamController::class, 'redirectToSteamRegister'])
    ->name('steam.register');

// Callback generique - detecte si login ou register
Route::get('/auth/steam/callback', [\App\Http\Controllers\Auth\SteamController::class, 'handleCallback']);

// Epic Games Auth routes
// Login: connecte un utilisateur existant
Route::get('/auth/epic/login', [\App\Http\Controllers\Auth\EpicController::class, 'redirectToEpicLogin'])
    ->name('epic.login');
    
// Register: cree un nouveau compte utilisateur  
Route::get('/auth/epic/register', [\App\Http\Controllers\Auth\EpicController::class, 'redirectToEpicRegister'])
    ->name('epic.register');

// Callback generique - detecte si login ou register
Route::get('/auth/epic/callback', [\App\Http\Controllers\Auth\EpicController::class, 'handleCallback']);

// Debug route to see callback parameters
Route::get('/debug/callback', function () {
    dd(request()->all());
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'is_admin'])->name('dashboard');

// API Routes - Publique
Route::get('/api/products', [ProductController::class, 'index']);

// Admin Routes - Protégées par auth et is_admin
Route::middleware('is_admin')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Products
    Route::get('/admin/products', [ProductController::class, 'adminIndex'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});

/*
 * Ce fichier charge les routes d'authentification de Laravel Breeze:
 * - login/logout
 * - register
 * - password reset
 * - email verification
 * 
 *situe dans routes/auth.php
 */
require __DIR__.'/auth.php';
