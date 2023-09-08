<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ChangePasswordController;

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);

// forgot password
Route::get('/password/request', [ForgotPasswordController::class, 'showForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

//new Password
Route::get('/change-password', [ChangePasswordController::class,'showChangePasswordForm'])->name('change.password');
Route::post('/change-password', [ChangePasswordController::class,'changePassword'])->name('change.password.update');


// User
Route::get('/dashboard', [UserController::class, 'showUser'])->name('dashboard');
