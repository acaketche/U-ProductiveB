<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


//login
// Route::middleware(['guest'])->group(function(){
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
// });

// Route::middleware(['auth'])->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });

Route::get('/userprofile', [UserController::class, 'showUsers'])->name('user.profile');
