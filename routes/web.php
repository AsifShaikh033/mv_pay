<?php

use Illuminate\Support\Facades\Route;
require __DIR__.'/admin.php';
use App\Http\Controllers\User\WebController;
use App\Http\Controllers\User\AuthController;

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register-user', [AuthController::class, 'register'])->name('registeruser');

    //Homepage 
    Route::get('/', [WebController::class, 'index'])->name('index');
    //USER START
    Route::middleware(['auth'])->group(function () {  
            // Homepage route
            Route::get('/', [WebController::class, 'index'])->name('index');
            // Logout route
            Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        });




