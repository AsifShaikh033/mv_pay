<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('Web.Auth.register');
    }

    public function showLoginForm()
    {
        return view('Web.Auth.login');
    }

    public function loginuser_auth(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.',
        ]);
    
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('web')->user();
             SetToken($user);
            return redirect()->route('index')->with('success', 'Login successful!');
        }
    
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }
     
    public function register(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mob_number' => 'required|string|max:15|unique:users',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'mob_number.required' => 'Mobile number is required.',
            'image.image' => 'The image must be a valid image file.',
            'image.mimes' => 'Allowed image types: jpg, jpeg, png, gif.',
        ]);


        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
        }
        if ($request->hasFile('image')) {
            $folderPath = 'public/uploads/user/profile';
            if (!Storage::exists($folderPath)) {
                Storage::makeDirectory($folderPath);
            }
        
            $imagePath = $request->file('image')->store('uploads/user/profile', 'public');
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'identity_image' => $imagePath,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        SetToken($user);
        return redirect()->route('index')->with('success', 'Registration was successful!');
    }

    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('index')->with('success', 'Sign out successful!');
    }
    

}
