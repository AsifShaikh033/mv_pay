<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminauthsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WebConfigController;




Route::prefix('admin')->group(function () {

    //AUTH
    Route::get('/login', [AdminauthsController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminauthsController::class, 'login'])->name('admin.login.submit');

});


Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    //WEB CONFIF
    Route::get('/edit-web', [WebConfigController::class, 'edit'])->name('webconfig.edit');
    Route::post('/web-update', [WebConfigController::class, 'update'])->name('web_config.update');
     //AUTH
    Route::post('logout', [AdminauthsController::class, 'logout'])->name('logout');
    Route::get('/edit-profile-admin', [AdminauthsController::class, 'profile_edit'])->name('profile');
    Route::put('/profile/{id}', [AdminauthsController::class, 'update'])->name('profile.update');
    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('index');

});







