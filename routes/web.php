<?php

use Illuminate\Support\Facades\Route;
require __DIR__.'/admin.php';
use App\Http\Controllers\User\WebController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;


    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login-user', [AuthController::class, 'loginuser_auth'])->name('loginuser');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register-user', [AuthController::class, 'register'])->name('registeruser');

    //Homepage 
    Route::get('/', [WebController::class, 'index'])->name('index');
    //USER START
   
    Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
        // Logout route
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
        //user routes
        Route::get('/profile', [UserController::class, 'profiles'])->name('profile');
        Route::post('/update-profile-user', [UserController::class, 'updateprofile'])->name('updateprofile');

    });
    




