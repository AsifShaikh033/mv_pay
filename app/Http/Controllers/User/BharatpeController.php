<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Utr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class BharatpeController extends Controller
{

    public function bharatpe(Request $request)
    {
        // if (!defined('ADDFUNDS')) {
        //     abort(404);
        // }
        
        $utr = trim($request->input('utr_number'));
        
        if (empty($utr)) {
            return response()->json(['error' => 'The Order ID cannot be empty.'], 400);
        }
        
        
        // Check if UTR is already used
        if (Transaction::where('transaction_id', $utr)->exists()) {
            return response()->json(['error' => 'This UTR is already used.'], 400);
        }
        
        $fromDate = now()->subDays(2)->format('Y-m-d');
        $toDate = now()->format('Y-m-d');

        $merchantId = config('services.bharatpe.merchant_id');
        $token = config('services.bharatpe.token');
        

        $response = Http::withHeaders([
            'token' => $token,
            'user-agent' => 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Mobile Safari/537.36'
        ])->get("https://payments-tesseract.bharatpe.in/api/v1/merchant/transactions", [
            'module' => 'PAYMENT_QR',
            'merchantId' => $merchantId,
            'sDate' => $fromDate,
            'eDate' => $toDate,
        ]);


        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch transactions.'], 500);
        }

        $transactions = $response->json()['data']['transactions'] ?? [];
        if (empty($transactions)) {
            return response()->json(['error' => 'No transactions found in the API response.'], 500);
        }
        
        $matchedTransaction = collect($transactions)->firstWhere('bankReferenceNo', $utr);

        if (!$matchedTransaction) {
            return response()->json(['error' => 'UTR verification failed.'], 400);
        }
       
        $user = Auth::user();
        

        if ($matchedTransaction['status'] === 'SUCCESS' && $matchedTransaction['amount'] == $request->input('paymentAmount')) {
            $paidAmount = (float) $matchedTransaction['amount'];
            
            $user = Auth::user();
            $postBalance = $user->balance + $paidAmount;
        
            $payment = Transaction::create([
                'user_id' => $user->id,
                'amount' => $paidAmount,
                'charge' => 0.00,
                'post_balance' => $postBalance,
                'trx_type' => '+',
                'details' => 'Recharge via BharatPe',
                'remark' => 'wallet_add',
                'status' => 1,
                'payment_status' => 'success',
                'transaction_id' => $utr,
                'response_msg' => 'Transaction successful',
                'response_api_msg' => json_encode($matchedTransaction),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        
            $user->increment('balance', $paidAmount);
        
            return response()->json([
                'success' => true,
                'message' => 'The order ID is verified and the money has been added to your account.',
                'content' => '<script type="text/javascript">window.location.reload();</script>'
            ]);
        }
        

        return response()->json(['error' => 'Transaction verification failed.'], 400);

    }

    public function qr_code(){
        $utr_pay = Utr::get();
        return view('Web.User.utr.utr_payment', compact('utr_pay'));
    }
}
