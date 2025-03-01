<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
require __DIR__.'/admin.php';
use App\Http\Controllers\User\WebController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\RechargeController;
use App\Http\Controllers\User\BillController;
use App\Http\Controllers\User\MvSpinUserController;
use App\Http\Controllers\RechargeApiController;
use App\Http\Controllers\ApiFetchController;
use App\Http\Controllers\CplanetRechargeController;
use App\Http\Controllers\LeadGenerateController;  
use App\Http\Controllers\User\BharatpeController; 
use App\Http\Controllers\WithdrawalController; 
use App\Http\Controllers\WebhookController;
Route::get('/api/register-user', [UserController::class, 'registeruser']);
Route::get('/api/register-user', [UserController::class, 'registeruser']);

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
            $key = request()->query('key'); 
        
            // if ($key !== env('MIGRATION_KEY')) {
            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Unauthorized access!',
            //     ], 403);
            // }
        
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


    Route::get('/clear-cache', function () {
        try {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            
            return response()->json([
                'success' => true,
                'message' => 'Application cache has been cleared successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to clear application cache: ' . $e->getMessage(),
            ], 500);
        }
    });


    //WEBHOOK START
    Route::get('/recharge_callback', [WebhookController::class, 'recharge_webhook']);

    Route::post('/fetch-operator-circle', [ApiFetchController::class, 'fetchOperatorCircle'])->name('fetch.operator.circle');
    Route::post('/billfetch-operator-circle', [ApiFetchController::class, 'billfetchOperatorCircle'])->name('billfetch.operator.circle');
    Route::post('/dthfetch-operator-circle', [ApiFetchController::class, 'dthfetchOperatorCircle'])->name('dthfetch.operator.circle');


    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login-user', [AuthController::class, 'loginuser_auth'])->name('loginuser');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register-user', [AuthController::class, 'register'])->name('registeruser');
    //APIS
    Route::get('/api/update-token', [MvSpinUserController::class, 'updateToken']);
    Route::get('/api/mv_pay_winning', [MvSpinUserController::class, 'mv_pay_winning_amount']);

    Route::post('/api/chech-subcription', [HomeController::class, 'chechSubcription']);

    //Homepage 
    Route::get('/', [WebController::class, 'index'])->name('index');
   
    // Route::get('/', [WebController::class, 'index'])->name('index');
    //USER START
   
    Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
        // Logout route
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/reports', [WebController::class, 'reports'])->name('reports');
        Route::get('/others', [WebController::class, 'other'])->name('others');
        Route::get('/bank_details', [WebController::class, 'bank_details'])->name('bank_details');
        //user routes
        Route::post('/save-bank-details', [WebController::class, 'saveBankDetails'])->name('save.bank.details');

        
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

        //Member Others
        Route::get('/member-list', [UserController::class, 'member_refer_list'])->name('memberlist');
        Route::get('/payment-list', [UserController::class, 'payment_list'])->name('paymentlist');
        Route::get('/commission-report', [UserController::class, 'commission_report'])->name('commissionreport');
        Route::get('/fund-transaction', [UserController::class, 'fund_transaction'])->name('fundtransaction');

        Route::get('/report/{type}', [ReportController::class, 'showReport'])->name('report.show');
        //MOBILE
        Route::get('/recharge/mobile',[RechargeController::class,'mobile'])->name('recharge.mobile');
        Route::post('/recharge/plan',[RechargeController::class,'plan'])->name('recharge.plan');
        Route::get('/wallet',[RechargeController::class,'wallet'])->name('cash.wallet');
        Route::get('/search/page',[RechargeController::class,'pages'])->name('search.pages');
        
        Route::post('/recharge', [RechargeController::class, 'recharge'])->name('recharge.process');

        Route::get('/recharge-form', [RechargeController::class, 'showRechargeForm'])->name('recharge.form');
        Route::post('/save-recharge-pin', [RechargeController::class, 'saveRechargePin'])->name('save.recharge.pin');
        Route::get('/final-recharge', [RechargeController::class, 'finalRecharge'])->name('recharge.final_recharge');


        //Add Fund
        Route::post('/bharatpe',[BharatpeController::class,'bharatpe'])->name('cash.bharatpe');
        Route::get('/utr-payment',[BharatpeController::class,'qr_code'])->name('cash.qr_code');

        //ELECTRICITY
        // Route::get('/recharge/electricity',[RechargeController::class,'electtric_f'])->name('recharge.electricity');
        //Bill ELECTRICITY bill_plan
        Route::get('/recharge/electricity',[BillController::class,'electtric_f'])->name('recharge.electricity');
        Route::post('/recharge/bill_plan',[BillController::class,'bill_plan'])->name('recharge.bill_plan');

        //Common Function
        Route::get('/recharge/bills',[BillController::class,'common'])->name('recharge.bills');

        //RECHAREGE APIS
        Route::post('/plan-fetch', [RechargeApiController::class, 'plan_fetch'])->name('plan.fetch');
        //CPLANET APIS
        Route::get('/c-recharge/mobile',[CplanetRechargeController::class,'mobile'])->name('c_recharge.mobile');
        Route::post('/c-recharge/prepaid',[CplanetRechargeController::class,'recharge_prepaid_m'])->name('c_recharge');
        //CREDIT CARD AND BANK ACCOUNT APiS
        Route::get('/credit-card-apply', [LeadGenerateController::class, 'credit_card_link'])->name('credit_card');
        Route::get('/axis-bank-apply', [LeadGenerateController::class, 'axic_account'])->name('axic_bank');
        //Widhrawal
        Route::get('/withdrawal', [WithdrawalController::class, 'withdrawal'])->name('withdrawal');

        Route::get('/failed_page', [WithdrawalController::class, 'failed_page'])->name('failed_page');

        Route::post('/withdrawalrequest', [WithdrawalController::class, 'requestWithdrawal'])->name('requestWithdrawal');

      
    });


    

    


