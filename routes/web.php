<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController; // Import the UserController

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login']);

// User
Route::get('/user', [UserController::class, 'showUser'])->name('user');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [LoginController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
