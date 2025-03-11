<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; 
use App\Models\User;
use Log;
use App\Models\Recharge;

class WebhookController extends Controller
{
    public function recharge_webhook(Request $request)
    {
        Log::info('Webhook received', $request->all());
    
        $data = $request->only([
            'Status', 'OperatorRef', 'APITransID', 'TransID', 'ErrorCode', 'Amount'
        ]);
    
        if (empty($data['TransID']) || !is_string($data['TransID'])) {
            Log::warning('Invalid or missing transaction ID', ['data' => $data]);
            return response()->json(['message' => 'Invalid transaction ID'], 400);
        }
    
        $transaction = Transaction::where('transaction_id', $data['TransID'])->first();
    
        if (!$transaction) {
            Log::warning('Transaction not found', ['TransID' => $data['TransID']]);
            return response()->json(['message' => 'Transaction not found'], 404);
        }
    
        Log::info('Transaction found', ['transaction' => $transaction]);
    
        $statusMapping = [
            'PENDING' => 0,
            'SUCCESS' => 1,
            'FAILED' => 2,
            'FAILURE' => 2,
            'REFUND' => 3,
        ];
    
        $transaction->status = $statusMapping[strtoupper($data['Status'] ?? '')] ?? 0;
        $transaction->payment_status = $data['Status'] ?? 'PENDING';
        $transaction->api_trans_id = $data['APITransID'] ?? null;
        $transaction->webhook_api_response = json_encode($data);
    
        $transaction->save();
    
        Log::info('Transaction updated successfully', ['transaction' => $transaction]);
    
        return response()->json(['message' => 'Webhook processed successfully']);
    }

    public function digital_recharge_webhook(Request $request)
    {
        Log::info('Webhook received digital', $request->all());
    
        $data = $request->only([
            'payid', 'client_id', 'operator_ref', 'status'
        ]);
    
        if (empty($data['client_id']) || !is_string($data['client_id'])) {
            Log::warning('Invalid or missing transaction ID', ['data' => $data]);
            return response()->json(['message' => 'Invalid transaction ID'], 400);
        }
    
        $transaction = Transaction::where('transaction_id', $data['client_id'])->first();
    
        if (!$transaction) {
            Log::warning('Transaction not found', ['client_id' => $data['client_id']]);
            return response()->json(['message' => 'Transaction not found'], 404);
        }
    
        Log::info('Transaction found', ['transaction' => $transaction]);
        $Recharge = Recharge::where('user_tx', $data['client_id'])->first();

        if ($transaction->status === 2) {
            if ($data['status'] === 'success') {
                $transaction->status = 1; 
                $transaction->payment_status = 'success';
                $Recharge->status = 'success'; 
            } else {
                $user = User::find($transaction->user_id);
                if ($user) {
                    $user->balance += $transaction->amount;
                    $user->save(); 
                }
                $transaction->status = 0; 
                $transaction->payment_status = 'failed';
                $transaction->details = 'Payment Refunded'; 
                $Recharge->status = 'failed'; 
            }
            $transaction->save();
            $Recharge->save();
        } else {
            Log::info('Transaction already processed', ['transaction' => $transaction]);
        }
    
        $transaction->api_trans_id = $data['operator_ref'] ?? null;
        $transaction->webhook_api_response = json_encode($data);
    
        $transaction->save();
    
        Log::info('Transaction updated successfully', ['transaction' => $transaction]);
    
        return response()->json(['message' => 'Webhook processed successfully']);
    }
    
}
