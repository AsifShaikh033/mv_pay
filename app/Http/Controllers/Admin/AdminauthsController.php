<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminauthsController extends Controller
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


public function update(Request $request, $id)
{
    
   // Validate the input data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:6',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = Admin::findOrFail($id);
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    if ($request->filled('password')) {
        $user->password =  Hash::make($request->input('password'));
    }

    if ($request->hasFile('image')) {
        if (!empty($user->image) && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }
        $path = $request->file('image')->store('uploads/admin', 'public');
        $user->image = $path;
    }

   
    $user->save();

    // return $path;
    // die;

    return redirect()->route('admin.profile')->with('success', 'Details updated successfully!');
}

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
  
}
