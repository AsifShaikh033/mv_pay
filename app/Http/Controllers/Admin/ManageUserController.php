<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class ManageUserController extends Controller
{
     public function list(){
         $user = User::all();

         return view('Admin.user.list',compact('user'));
     }

     public function editUser($id)
    {
        $Data = User::find($id);
        return view('Admin.user.edit', compact('Data'));
    }
    public function updateUser(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            //'email' => 'required|email|max:255|unique:users,email,' . $id,
            'address' => 'nullable|string|max:255',
            //'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


       // return $request;
        

        $user = User::findOrFail($id);

        // Handle profile image upload
        if ($request->hasFile('profile')) {
            // Delete the old image if it exists
            if ($user->identity_image && Storage::exists('public/user/profile/' . $user->identity_image)) {
                Storage::delete('public/user/profile/' . $user->identity_image);
            }
        
            // Handle the new profile image upload
            $profileImage = $request->file('profile');
            $profileImageName = time() . '_' . $profileImage->getClientOriginalName();
            
            // Store the image in 'public/user/profile' folder in the public disk
            $profileImage->storeAs('public/user/profile', $profileImageName);
        
            // Save the new image name in the database
            $user->identity_image = $profileImageName;
        }
        

        $user->name = $request->name;
        $user->email =  $request->email;
        $user->address = $request->address;
        $user->mob_number = $request->mob_number;
        $user->city = $request->city;
        $user->save();

        return redirect()->route('admin.user.list')->with('success', 'User updated successfully!');
    }
    


}
