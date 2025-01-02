<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::get('/admin',[AdminController::class,'index']);
Route::get('/', function () {
    return view('welcome');
});
