<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
       
        if(Auth::guard('admin')->check()){
            return redirect()->route('admin.index');
        }else{
            return view('Admin.auth.login');    
        }
    }
    public function login(Request $request)
    {
        // Validate the login credentials
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if (Auth::guard('admin')->attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            return redirect()->route('admin.index');
        } else {
            // If the credentials are incorrect, return an error
            return redirect()->back()->withErrors(['email' => 'The provided credentials are incorrect.']);
        }
    }


   public function profile_edit()
    {
        $user = Auth::guard('admin')->user();
        return view('Admin.auth.profile', compact('user'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    
}
