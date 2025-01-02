<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;


Route::prefix('admin')->group(function () {

    //AUTH
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

});

Route::prefix('admin/')->middleware('auth:admin')->group(function () {

    // Admin dashboard or index route
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
   // Route::get('/profile', [AdminProfileController::class, 'showProfile'])->name('admin.profile');
   // Route::post('/profile', [AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');

});

Route::prefix('admin/')->group(function () {
    Route::get('/', function () {
        // Check if the admin is authenticated
        if (!Auth::guard('admin')->check()) {
            // Redirect to login if not authenticated
            return redirect()->route('admin.login');
        }

        // Return the dashboard or index view if authenticated
        return view('admin.index');  // Adjust the view as needed
    })->name('admin.index');
});




