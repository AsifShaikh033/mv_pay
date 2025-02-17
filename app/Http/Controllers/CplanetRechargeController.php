<?php

namespace App\Http\Controllers;
use App\Models\Recharge;
use App\Models\Transaction;
use App\Services\CplanetService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CplanetRechargeController extends Controller
{

    protected $rechargeService;
    public function __construct(CplanetService $rechargeService)
    {
        $this->rechargeService = $rechargeService;
    }
    
      public function mobile(Request $request)
     {     
        $rechargeNumbers = Recharge::where('user_id', Auth::id())
        ->where('serviceType','Prepaid-Mobile')
       ->orderBy('created_at', 'desc')
       ->limit(3)
       ->get();
       
        $Operator = [
            ['OperatorCode' => 1, 'OperatorName' => 'AIRTEL'],
            ['OperatorCode' => 2, 'OperatorName' => 'VI'],
            ['OperatorCode' => 3, 'OperatorName' => 'JIO'],
            ['OperatorCode' => 4, 'OperatorName' => 'BSNL'],
        ];
       return view('Web.User.cplanet.mobile',compact('Operator','rechargeNumbers'));
        }

        public function recharge_prepaid_m(Request $request)
        {     
            $request->validate([
                'mobile_number' => 'required|digits:10',
                'operator' => 'required',
                'amount' => 'required|numeric|min:1',
            ], [
                'mobile_number.digits' => 'Please enter a valid 10-digit mobile number.',
                'operator.required' => 'Please select an operator.', 
                'amount.required' => 'Please enter the recharge amount.', 
            ]);
        
            $user = auth()->user();
        
            // Step 1: Check if user has sufficient balance
            // if ($user->balance < $request->amount) {
            //     return redirect()->back()->with('info', 'Insufficient wallet balance.');
            // }
        
            // Step 2: Generate API Token
          $tokenResponse = $this->rechargeService->getToken();
        
            if (is_array($tokenResponse) && !$tokenResponse['status']) {
                return redirect()->back()->with('info', $tokenResponse['message']);
            }
        
            // Step 3: Initiate Recharge Request
         return   $rechargeResponse = $this->rechargeService->rechargePrepaid(
                $tokenResponse, 
                $request->mobile_number, 
                $request->operator, 
                $request->amount
            );
        
            // Step 4: Store Transaction Details
            $transaction = new Transaction;
            $transaction->user_id = $user->id;
            $transaction->amount = $request->amount;
            $transaction->transaction_id = $rechargeResponse['transaction_id'] ?? null;
            $transaction->response_api_msg = json_encode($rechargeResponse);
            $transaction->remark = 'recharge_deduct';
            $transaction->trx_type = '-'; // Default, to be changed on success
        
            // Step 5: Check Recharge Status
            if (is_array($rechargeResponse) && !$rechargeResponse['status']) {
                $transaction->status = 0; 
                $transaction->payment_status = 'failed';
                $transaction->details = 'Recharge failed for ' . $request->mobile_number;
            } else {
                // Recharge was successful, deduct balance
                $user->balance -= $request->amount;
                $user->save();
        
                $transaction->status = 1; 
                $transaction->payment_status = 'success';
                $transaction->details = 'Recharge successful for ' . $request->mobile_number;
                $transaction->remark = 'recharge_deduct';
                $transaction->post_balance = $user->balance;
            }
        
            $transaction->save();
            if ($transaction->status == 1) {
                return redirect()->back()->with('success', 'Recharge successful. Transaction ID: ' . $transaction->transaction_id);
            }elseif(isset($rechargeResponse['message'] )){
                return redirect()->back()->with('info', $rechargeResponse['message']);
            } else {
                return redirect()->back()->with('info', 'Recharge failed. Please try again.');
            }
        }
        
        
}
