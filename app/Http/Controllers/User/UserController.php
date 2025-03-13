<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Bankdetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'nullable|string|min:6|',
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
            $user->password =Hash::make($request->password);
        }
    
        $user->save();
        $user = Auth::user();
        SetToken($user);
    
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }


    public function registeruser(Request $request)
    {
        $user = User::where('mob_number', $request->mob_number)->first();
        if ($user) {
            $user->remember_token = $request->token;
            $user->save();
        
            return response()->json(['message' => 'Token updated successfully.']);
        }      
        

        if(!$user){ 
            $imagePath = null;
            if ($request->hasFile('identity_image')) {
                $originalPath = $request->identity_image->getClientOriginalName();
                $modifiedPath = str_replace('uploads/user/profile/', '', $originalPath);
                $imagePath = $request->identity_image->storeAs('profile_images', $modifiedPath, 'public');
            }
            
            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'mob_number' => $request->mob_number,
                'remember_token' => $request->token,
                'referral_code' =>  $this->generateUniqueReferralCode(),
            ]);

            return response()->json(['success' => 'User Register Success.'], 200);
            
        }
        return response()->json(['error' => 'User allready added.'], 400);
    
        
    }

    public function about(){
        return view('Web.User.aboutUs');
    }

    public function reffrel_list()
    {
        $user = auth()->user(); 
        $referralCode = $user->referral_code; 
        if($user->referral_code === null){
            $user->referral_code = $this->generateUniqueReferralCode();
            $user->save();
        }
        $subcription = false;
        $subscriptionStatus = checkSubcription($user);
if($subscriptionStatus == true){
    $subcription = true;
}

        $referredUsers = User::where('referred_by', $user->id)->get(); 
        return view('Web.User.reffrel', compact('referralCode', 'referredUsers', 'subcription'));
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

    public function services(){
        return view('Web.User.services');
    }

    public function payment_history()
    {
        return view('Web.User.payment_history');
    }

    public function privacyAndPolicy()
    {
        return view('Web.User.privacyAndPolicy');
    }

    public function termsAndConditions()
    {
        return view('Web.User.terms_And_Conditions');
    }

    public function refundAndpolicy()
    {
        return view('Web.User.RefundAndpolicy');
    }

    public function contactUs()
    {
        return view('Web.User.contactUs');
    }


    

    public function member_refer_list()
    {
        $users = User::where('referred_by', Auth::id())->get();
        
        $user = auth()->user();
        
        $referralCode = $user->referral_code;

        if($user->referral_code === null){
            $user->referral_code = $this->generateUniqueReferralCode();
            $user->save();
        }

        $subcription = false;

        $subscriptionStatus = checkSubcription($user);

        if($subscriptionStatus == true){
            $subcription = true;
        }

        $referredUsers = User::where('referred_by', $user->id)->get(); 

        $users_list = User::whereIn('id', $users->pluck('id'))->get();
        
        return view('Web.User.member_list', compact('users', 'users_list', 'referralCode', 'referredUsers', 'subcription'));
    }


    public function payment_list()
    {
        // $fund = Bankdetail::with('user')
        // ->where('user_id', auth()->id())
        // ->orderBy('created_at', 'desc')
        // ->get();
        $fund = Transaction::with('user')
        ->where('user_id', auth()->id())
        ->where('remark', 'withdrawal_request')
        ->orderBy('created_at', 'desc')
        ->get();
        
        return view('Web.User.payment_status', compact('fund'));
    }


    public function commission_report()
    {
        $userId = Auth::id();

        $commission = Transaction::with('user')
        ->where('user_id', $userId)
        ->where('remark', 'reffrel_bonus')
        ->orderBy('created_at', 'desc')
        ->get();
        
        return view('Web.User.commission_report', compact('commission'));
    }


    public function fund_transaction()
    {

        $fund = Transaction::with('user')
        ->where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();
        return view('Web.User.fund_transaction', compact('fund'));
    }

    
}
