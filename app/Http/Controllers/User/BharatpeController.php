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
        $utr = trim($request->input('utr_number'));

        if (empty($utr)) {
            // return response()->json(['error' => 'The Order ID cannot be empty.'], 400);
            return redirect()->back()->with('error', 'The Order ID cannot be empty.');
        }

        if (Transaction::where('transaction_id', $utr)->exists()) {
            return redirect()->back()->with('error', 'This UTR is already used.');
            // return response()->json(['error' => 'This UTR is already used.'], 400);
        }

        $fromDate = now()->subDays(5)->format('Y-m-d');
        $toDate = now()->format('Y-m-d');

        $merchantId = '54323241';
        $token = '86d76b2f5da041e0933c3a6990a800d8';

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
            // return response()->json(['error' => 'Failed to fetch transactions.', 'response' => $response->body()], 500);
            return redirect()->back()->with('error', 'Failed to fetch transactions. response: ' . json_encode($response->body()));
        }

        $apiResponse = $response->json();

        if (empty($apiResponse['data']['transactions'])) {
            // return response()->json(['error' => 'No transactions found in the API response.', 'full_response' => $apiResponse], 500);
            return redirect()->back()->with('error', 'No transactions found in the API response. full_response: ' . json_encode($apiResponse));
        }

        $transactions = $apiResponse['data']['transactions'];

        $matchedTransaction = collect($transactions)->firstWhere('bankReferenceNo', $utr);

        if (!$matchedTransaction) {
            // return response()->json(['error' => 'UTR verification failed.', 'transactions' => $transactions], 400);
            return redirect()->back()->with('error', 'UTR verification failed. Transactions: ');

        }

        $user = Auth::user();

        // $paymentAmount = (float) $request->input('paymentAmount');
        $apiAmount = (float) $matchedTransaction['amount'];

        if ($matchedTransaction['status'] === 'SUCCESS') {
            
            $postBalance = $user->balance + $apiAmount;

            $payment = Transaction::create([
                'user_id' => $user->id,
                'amount' => $apiAmount,
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

            $user->increment('balance', $apiAmount);

            return redirect()->back()->with('success', 'The order ID is verified and the money has been added to your account. Transaction ID: ' . json_encode($matchedTransaction));

            // return response()->json([
            //     'success' => true,
            //     'message' => 'The order ID is verified and the money has been added to your account.',
            //     'transaction' => $matchedTransaction,
            // ]);
        }

        // return response()->json(['error' => 'Transaction verification failed.', 'matched_transaction' => $matchedTransaction, 'apiAmount' => $apiAmount], 400);
        return redirect()->back()->with('error', 'Transaction verification failed. Matched transaction: ' . json_encode($matchedTransaction) . ', API amount: ' . $apiAmount);
    }

    public function qr_code()
    {
        $utr_pay = Utr::get();
        return view('Web.User.utr.utr_payment', compact('utr_pay'));
    }
}
