<?php

use Illuminate\Support\Facades\Route;
require __DIR__.'/admin.php';


Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');

Route::get('/', function () {
    return view('welcome');
});
