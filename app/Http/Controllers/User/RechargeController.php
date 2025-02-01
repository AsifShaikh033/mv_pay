<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RechargeController extends Controller
{
    public function mobile(){
        return view('Web.User.recharge.mobile');
    }

    public function plan(){
        return view('Web.User.recharge.plan');
    }

    public function wallet(){
        return view('Web.User.recharge.wallet');
    }
    
    public function pages(){
        return view('Web.User.recharge.searchpages');
    }
}
