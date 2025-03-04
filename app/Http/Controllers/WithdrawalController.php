<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdrawal;
use App\Models\Transaction;

class WithdrawalController extends Controller
{

    public function withdrawal() {
        $user = Auth::user();
        $withdrawals = Withdrawal::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('Web.User.withdrawal.withdrawal', compact('withdrawals', 'user'));
    }
    
    public function requestWithdrawal(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10'
        ]);

        $amount = $request->input('amount');
        if (empty($amount) || !is_numeric($amount) || $amount < 10) {
            return redirect()->route('user.withdrawal')->with([
                'error' => 'The minimum withdrawal amount is 10 rupees.'
            ])->withInput();
        }

        $user = auth()->user();
        $userBalance = $user->balance ?? 0;

    if ($userBalance < $amount) { 
        return redirect()->route('user.withdrawal')->with([
            'error' => 'User balance is not sufficient for this withdrawal.'
        ])->withInput();
    }

        $transactionId = 'TXN' . uniqid();

        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'transaction_id' => $transactionId
        ]);

        $postBalance = $userBalance - $amount;


        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $amount;
        $transaction->charge = 0.00;
        $transaction->post_balance = $postBalance;
        $transaction->trx_type = '-';
        $transaction->details = 'Withdrawal request initiated';
        $transaction->remark = 'withdrawal_request';
        $transaction->status = 1;
        $transaction->payment_status = 'pending';
        $transaction->transaction_id = $transactionId;
        $transaction->save();


        $user->balance -= $amount;
        $user->save();

        return redirect()->route('user.withdrawal')->with([
            'success' => 'Withdrawal request sent successfully.'
        ]);
        
    }


   
    // public function approveWithdrawal($id)
    // {
    //     $withdrawal = Withdrawal::findOrFail($id);

    //     $withdrawal->update([
    //         'status' => 'success',
    //        // 'transaction_id' => 'TXN' . uniqid(),
    //         'details' => 'Withdrawal approved by admin',
    //     ]);

    //    return redirect()->back()->with(['success' => 'Withdrawal approved.'])->withInput();
    // }

    // public function rejectWithdrawal(Request $request, $id)
    // {
    //     $withdrawal = Withdrawal::findOrFail($id);
    
    //     // Update withdrawal status
    //     $withdrawal->update([
    //         'status' => 'rejected',
    //         'details' => $request->reason,
    //     ]);
    
    //     // Add amount back to user balance
    //     $user = $withdrawal->user;
    //     $user->balance += $withdrawal->amount;
    //     $user->save();
    
    //     return redirect()->back()->with(['success' => 'Withdrawal rejected and amount added back to user balance.'])->withInput();
    // }
    public function approveWithdrawal($id)
{
    $withdrawal = Withdrawal::findOrFail($id);

    $withdrawal->update([
        'status' => 'success',
        'details' => 'Withdrawal approved by admin',
    ]);

    // Update the transaction table
    Transaction::where('transaction_id', $withdrawal->transaction_id)->update([
        'status' => 1,
        'payment_status' => 'success',
        'details' => 'Withdrawal approved by admin'
    ]);

    return redirect()->back()->with(['success' => 'Withdrawal approved.'])->withInput();
}

public function rejectWithdrawal(Request $request, $id)
{
    $withdrawal = Withdrawal::findOrFail($id);

    $withdrawal->update([
        'status' => 'rejected',
        'details' => $request->reason,
    ]);

    // Add amount back to user balance
    $user = $withdrawal->user;
    $user->balance += $withdrawal->amount;
    $user->save();
    Transaction::where('transaction_id', $withdrawal->transaction_id)->update([
        'status' => 3,
        'payment_status' => 'rejected',
        'details' => $request->reason
    ]);

    return redirect()->back()->with(['success' => 'Withdrawal rejected and amount added back to user balance.'])->withInput();
}

    
    public function failed_page(){
        return view('web.user.failed.rechargefailedModal');
    }
    public function list()
    {
        $withdrawals = Withdrawal::orderBy('created_at', 'desc')->get();
        return view('Admin.withdrawal.list', compact('withdrawals'));

    }

}
