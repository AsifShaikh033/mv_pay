<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
require __DIR__.'/admin.php';
use App\Http\Controllers\User\WebController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
   


        Route::get('/run-storage-link', function () {
            try {
                Artisan::call('storage:link');

                return response()->json([
                    'success' => true,
                    'message' => 'The storage link has been created successfully.',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create the storage link: ' . $e->getMessage(),
                ], 500);
            }
        });

        

        Route::get('/run-migrations-and-seeder', function () {
            $key = request()->query('key'); // Correct way to get query parameters
        
            if ($key !== env('MIGRATION_KEY')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access!',
                ], 403);
            }
        
            try {
                // Run migrations
                Artisan::call('migrate', ['--force' => true]);
        
                // Run seeders (uncomment if needed)
                // Artisan::call('db:seed', ['--force' => true]);
        
                return response()->json([
                    'success' => true,
                    'message' => 'Migrations and seeders executed successfully!',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage(),
                ], 500);
            }
        });

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login-user', [AuthController::class, 'loginuser_auth'])->name('loginuser');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register-user', [AuthController::class, 'register'])->name('registeruser');
    //APIS
    Route::get('/api/update-token', [MvSpinUserController::class, 'updateToken']);
    Route::get('/api/mv_pay_winning', [MvSpinUserController::class, 'mv_pay_winning_amount']);
    //Homepage 
    Route::get('/', [WebController::class, 'index'])->name('index');
    // Route::get('/', [WebController::class, 'index'])->name('index');
    //USER START
   
    Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
        // Logout route
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
        //user routes
        Route::get('/profile', [UserController::class, 'profiles'])->name('profile');
        Route::get('/about', [UserController::class, 'about'])->name('about');
        Route::get('/services', [UserController::class, 'services'])->name('services');
        Route::get('/payment_history', [UserController::class, 'payment_history'])->name('payment_history');
        Route::get('/privacyAndPolicy', [UserController::class, 'privacyAndPolicy'])->name('privacyAndPolicy');
        Route::get('/termsAndConditions', [UserController::class, 'termsAndConditions'])->name('termsAndConditions');
        Route::get('/refundAndpolicy', [UserController::class, 'refundAndpolicy'])->name('refundAndpolicy');
        Route::get('/contactUs', [UserController::class, 'contactUs'])->name('contactUs');
        Route::post('/update-profile-user', [UserController::class, 'updateprofile'])->name('updateprofile');
        //Reffrel
        Route::get('/reffrel-list', [UserController::class, 'reffrel_list'])->name('reffrellist');

    });
    




