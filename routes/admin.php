<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminauthsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WebConfigController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\BalanceCashbackController;
use App\Http\Controllers\Admin\UtrController;
use App\Http\Controllers\ApiFetchController;





Route::prefix('admin')->group(function () {

    //AUTH
    Route::get('/login', [AdminauthsController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminauthsController::class, 'login'])->name('admin.login.submit');
    Route::get('/insert_operator', [ApiFetchController::class, 'operator_api']);
    Route::get('/insert_circle', [ApiFetchController::class, 'circle_api']);
   
});


Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    //WEB CONFIF
    Route::get('/edit-web', [WebConfigController::class, 'edit'])->name('webconfig.edit');
    Route::post('/web-update', [WebConfigController::class, 'update'])->name('web_config.update');
     //AUTH
    Route::post('logout', [AdminauthsController::class, 'logout'])->name('logout');
    Route::get('/edit-profile-admin', [AdminauthsController::class, 'profile_edit'])->name('profile');
    Route::put('/profile/{id}', [AdminauthsController::class, 'update'])->name('profile.update');
    //User
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/users', [ManageUserController::class, 'list'])->name('user.list');
    Route::get('/edit-user/{id}', [ManageUserController::class, 'editUser'])->name('editUser');
    Route::post('/update-user/{id}', [ManageUserController::class, 'updateUser'])->name('updateUser');
    Route::post('/deleteUser', [ManageUserController::class, 'destroy'])->name('deleteUser');

    //Banner
    Route::get('/banner-list', [BannerController::class, 'list'])->name('banner.list');
    Route::post('/store-Banner', [BannerController::class, 'store'])->name('storeBanner');
    Route::get('/edit-banner/{id}', [BannerController::class, 'banner_edit'])->name('editBanner');
    Route::post('/update-Banner/{id}', [BannerController::class, 'update'])->name('updatbanner');
    Route::delete('/deleteBanner', [BannerController::class, 'destroy'])->name('banner_delete');
    //Transactions
    Route::get('/admin/transactions', [TransactionController::class, 'list'])->name('transaction.list');

    //Balance Cashback
    Route::get('/balance-cashback', [BalanceCashbackController::class, 'list'])->name('balance.cashback.list');
    Route::post('/store-balance-cashback', [BalanceCashbackController::class, 'store'])->name('balance.cashback.store');
    Route::get('/edit-balance-cashback/{id}', [BalanceCashbackController::class, 'edit'])->name('balance.cashback.edit');
    Route::post('/update-balance-cashback/{id}', [BalanceCashbackController::class, 'update'])->name('balance.cashback.update');
    Route::delete('/delete-balance-cashback', [BalanceCashbackController::class, 'destroy'])->name('balance.cashback.delete');

    //Qr Payment
    Route::get('/utr-list', [UtrController::class, 'list'])->name('utr.list');
    Route::post('/store-Utr', [UtrController::class, 'store'])->name('storeUtr');
    Route::get('/edit-utr/{id}', [UtrController::class, 'utr_edit'])->name('editUtr');
    Route::post('/update-Utr/{id}', [UtrController::class, 'update'])->name('updateUtr');
    Route::delete('/deleteUtr', [UtrController::class, 'destroy'])->name('utr_delete');




});







