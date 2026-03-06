<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
