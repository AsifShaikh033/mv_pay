<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; 
use Log;

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
    
}
