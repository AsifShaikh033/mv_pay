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
        $user = User::findOrFail($id);
        if ($request->hasFile('profile')) {
            if ($user->identity_image && Storage::exists('public/' . $user->identity_image)) {
                Storage::delete('public/' . $user->identity_image);
            }
            $folderPath = 'public/uploads/user/profile';
            if (!Storage::exists($folderPath)) {
                Storage::makeDirectory($folderPath);
            }
        
            $user->identity_image = $request->file('profile')->store('uploads/user/profile', 'public');
        }
        

        $user->name = $request  ->name;
        $user->email =  $request->email;
        $user->address = $request->address;
        $user->mob_number = $request->mob_number;
        $user->city = $request->city;
        $user->save();

        return redirect()->route('admin.user.list')->with('success', 'User updated successfully!');
    }


    public function destroy(Request $request)
    {
        $userId = $request->input('user_id'); 
        $user = User::findOrFail($userId); 
        $user->delete();
        return redirect()->route('admin.user.list')->with('success', 'User deleted successfully.');
    }
    

}
