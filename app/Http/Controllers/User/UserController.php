<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function profiles()
    {
        $data = Auth::user();
        return view('Web.User.profile', compact('data'));
    }

    public function updateprofile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'mob_number' => 'nullable|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
    
        $user = Auth::user();
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mob_number = $request->mob_number;
    
        if ($request->hasFile('image')) {
            $folderPath = 'uploads/user/profile';
    
            if ($user->identity_image && \Storage::disk('public')->exists($user->identity_image)) {
                \Storage::disk('public')->delete($user->identity_image);
            }
    
            $imagePath = $request->file('image')->store($folderPath, 'public');
            $user->identity_image = $imagePath;
        }
          
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
    
        $user->save();
    
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
    
}
