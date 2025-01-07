<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebConfig;

class WebController extends Controller
{
     public function index(){
              
        return view('Web.layout.main');
     }
}
