<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ManageUserController extends Controller
{
     public function list(){
         $user = User::all();

         return view('Admin.user.list',compact('user'));
     }
}
