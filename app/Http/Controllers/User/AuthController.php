<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('index'); 
        }
    
        return view('Web.Auth.register');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('index'); 
        }
        return view('Web.Auth.login');
    }

    public function loginuser_auth(Request $request)
    {
        $validated = $request->validate([
            'mob_number' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ], [
            'mob_number.required' => 'Mobile Number is required.',
            'password.required' => 'Password is required.',
        ]);
    
        if (Auth::guard('web')->attempt(['mob_number' => $request->mob_number, 'password' => $request->password])) {
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
            'email' => 'required|string|email|max:255|unique:users,email',
            'mob_number' => 'required|string|max:15|unique:users,mob_number',
            'referral_code' => 'required|string|exists:users,referral_code',
            'password' => 'required|string|min:6|max:255',
           // 'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already registered.', 
            'mob_number.required' => 'Mobile number is required.',
            'mob_number.unique' => 'This mobile number is already registered.',
            'referral_code.exists' => 'You have entered an invalid referral code.',
            'password.required' => 'Password is required.',
             'password.min' => 'Password must be at least 6 characters.',
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

        $referrer = null;
        if (!empty($request->referral_code)) {
            $referrer = User::where('referral_code', $request->referral_code)->first();
        }
        $uniqueReferralCode = $this->generateUniqueReferralCode();
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mob_number' => $request->mob_number,
            'identity_image' => $imagePath,
            'password' => Hash::make($request->password),
            'referred_by' => $referrer ? $referrer->id : null,
            'referral_code' => $uniqueReferralCode,   
        ]);
        Auth::login($user);
        SetToken($user);
        return redirect()->route('index')->with('success', 'Registration was successful!');
    }

            /**
         * Generate a unique referral code.
         *
         * @return string
         */
        private function generateUniqueReferralCode()
        {
            do {
                $referralCode = strtoupper(Str::random(8)); 
            } while (User::where('referral_code', $referralCode)->exists()); 

            return $referralCode;
        }

    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('index')->with('success', 'Sign out successful!');
    }
    

}
