<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $latestUsers = User::latest()->take(10)->get();
        $user_count = User::all()->count();

        $latestTransactions = Transaction::latest()->take(10)->with('user')->get();
        return view('Admin.index', compact('latestUsers', 'latestTransactions','user_count'));
    }
}
