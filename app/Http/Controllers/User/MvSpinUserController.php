<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

class MvSpinUserController extends Controller
{
    public function updateToken(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'random_token' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->remember_token = $request->random_token;
            $user->save();

            return response()->json(['message' => 'Token updated successfully.']);
        }

        return response()->json(['error' => 'User not found.'], 404);
    }


    public function mv_pay_winning_amount(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'random_token' => 'required',
            'amount' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {

            if ($user->remember_token !== $request->random_token) {
                return response()->json(['error' => 'Invalid token.'], 403);
            }
                 $user->balance += $request->amount;
                  $transaction = new Transaction;
                  $transaction->user_id = $user->id;
                  $transaction->amount =$request->amount;
                  $transaction->post_balance =$user->balance;
                  $transaction->trx_type = '+';
                  $transaction->status = 1;
                  $transaction->payment_status = 'paid';
                  $transaction->remark ='spin_direct_winn';
                  $transaction->details = 'You have Win '. $request->amount.' Amount from Spin';
                  $transaction->save(); 
                $user->save();

                return response()->json(['message' => 'Amount updated successfully.'], 200);
        }

        return response()->json(['error' => 'User not found.'], 404);
    }

        public function update_free_spin_count(){

            $user = Auth::user();  
            $spin_count = 5;  
            send_spin_chance($user, $spin_count);
        }
            
    
}
