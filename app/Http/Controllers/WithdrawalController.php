<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdrawal;

class WithdrawalController extends Controller
{

    public function withdrawal() {
        $user = Auth::user();
        $withdrawals = Withdrawal::where('user_id', Auth::id())->get();
        return view('Web.User.withdrawal.withdrawal', compact('withdrawals', 'user'));
    }
    
    public function requestWithdrawal(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        Withdrawal::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
        ]);

        return response()->json(['message' => 'Withdrawal request sent']);
    }
    public function approveWithdrawal($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        $withdrawal->update([
            'status' => 'success',
            'transaction_id' => 'TXN'.uniqid(),
            'details' => 'Withdrawal approved by admin',
        ]);

        return response()->json(['message' => 'Withdrawal approved']);
    }
    public function rejectWithdrawal($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        $withdrawal->update([
            'status' => 'failed',
            'comment' => 'Insufficient balance or other issue',
        ]);

        return response()->json(['message' => 'Withdrawal rejected']);
    }

    public function failed_page(){
        return view('web.user.failed.rechargefailedModal');
    }

}
