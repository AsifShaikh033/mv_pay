<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\Operator;
use App\Services\RechargeService;
use App\Models\Recharge;
use App\Models\User;
use App\Models\Transaction;
use App\Models\BalanceCashback;
use Illuminate\Support\Facades\Auth;
class BillController extends Controller
{
    protected $rechargeService;
    public function __construct(RechargeService $rechargeService)
    {
        $this->rechargeService = $rechargeService;
    }
   

       public function bill_plan(Request $request)
        {
            $request->validate([
                'bill_number' => 'required',
                'operator' => 'required',
                'circle' => 'required',
                'amount' => 'required|numeric',
            ], [
                'bill_number.required' => 'Please enter a valid Bill Number.',
                'operator.required' => 'Please select an operator.',
                'circle.required' => 'Please select a circle.',
                'amount.required' => 'Please enter an amount.',
            ]);

            if (!$request->has('amount') || empty($request->amount)) {
                return redirect()->back()->with('error', 'Amount is required.');
            }

            $user = auth()->user();

            // $tokenResponse = $this->rechargeService->getToken();
        
            $billNumber = $request->input('bill_number');
            $operatorCode = $request->input('operator');
            $circleCode = $request->input('circle');
            $rechargeAmount = $request->input('amount');

            $user = auth()->user();
            $userBalance = $user->balance ?? 0;
        
            if ($userBalance < $rechargeAmount) { 
                return redirect()->route('user.recharge.electricity')->with([
                    'error' => 'User Balance Not sufficient.'
                ])->withInput();
            }

            $transaction_id = rand(1000000000, 99999999999);

            $billplans = $this->rechargeService->fetchBillPlans(
                // $tokenResponse,  
                $billNumber,
                $operatorCode,
                $circleCode,
                $rechargeAmount,
                $transaction_id
            );

            $transaction = new Transaction;
            $transaction->user_id = $user->id;
            $transaction->amount = $rechargeAmount;
            $transaction->transaction_id = $billplans['transaction_id'] ?? $transaction_id;
            $transaction->response_api_msg = json_encode($billplans);
            $transaction->remark = 'electricity_bill';
            $transaction->trx_type = '-';


            if (isset($billplans['Status']) && $billplans['Status'] === "FAILURE") {
                $transaction->status = 0;
                $transaction->payment_status = 'pending';
                $transaction->details = 'Bill Pending for ' . $transaction->remark . ' ' . $request->circle;
            } elseif (isset($billplans['Status']) && $billplans['Status'] === "1") {
                $user->balance -= $rechargeAmount;
                $user->save();
        
                $transaction->status = 1; 
                $transaction->payment_status = 'success';
                $transaction->details = 'Bill Successful for ' . $transaction->remark . ' ' . $request->circle;
                $transaction->remark = 'electricity_bill';
                $transaction->post_balance = $user->balance;
            }
        
           

            // $this->bill_bonus($user, $rechargeAmount, $billplans);

            $user = Auth::user();
            $cashback = BalanceCashback::where('category', 'Electricity')->where('balance', $rechargeAmount)->first();

            // $send_spin_chance = null;

            if($cashback){
                $spin_count = 1;
               $send_spin_chance = send_spin_chance($user,$rechargeAmount, $cashback->cashback, $spin_count, $cashback->category);
            }
            // $transaction->spin_api_response = $send_spin_chance;
            
               $transaction->save();
            if ($transaction->status == 1) {
                return redirect()->back()->with('success', 'Bill successful. Transaction ID: ' . $transaction->transaction_id);
            }elseif(isset($billplans['message'] )){
                return redirect()->back()->with('info', $billplans['message']);
            } else {
                return redirect()->back()->with('info', 'Bill failed. Please try again.');
            }
          
        }


        public function bill_bonus($user, $rechargeAmount, $billplans) {
            
            $authUser = Auth::user();
            
            if (!empty($authUser->referred_by)) {
                $referrer = User::where('id', $authUser->referred_by)->first();
                
                if ($referrer) {
                    $referrer->balance += 1;
                    
                    Transaction::create([
                        'user_id'         => $referrer->id,
                        'amount'          => $rechargeAmount, 
                        'transaction_id'  => rand(1000000000, 99999999999),
                        'charge'          => 0.00,
                        'trx_type'        => '+',
                        'details' => 'Recharge commission from ' . $authUser->name . ' (User ID: ' . $user->id . ')',
                        'remark'          => 'bill_reffrel_bonus',
                        'post_balance'    => $user->balance, 
                        'status'          => 1,
                        'payment_status'  => 'success',
                        'response_api_msg'  => json_encode($billplans),
                    ]);
        // echo "<pre>";print_r($user->id);die;
                    $referrer->save();
                }
            }
        }

        public function electtric_f(){

            $circle = Circle::all();
            $Operator = Operator::where('ServiceTypeName', 'Electricity')
           // ->whereIn('OperatorCode', ['AT', 'BSNL', 'VI', 'JIO'])
            ->get();
        
            $billNumbers = Recharge::where('user_id', Auth::id())
                 ->where('serviceType','Prepaid-Mobile')
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        // return  $Operator;
            return view('Web.User.bills.electric_bill',compact('circle', 'Operator', 'billNumbers'));
        }

        public function bill_FORM_FETCH(Request $request)
        {
            $response = $this->rechargeService->bill_FORM_FETCH(
                $request->input('operator')
            );

            $operatorCode = $request->input('operator');
            $KEY = $response[0]['Key'] ?? null;

            return view('Web.User.bills.bill_fetch', compact('operatorCode', 'KEY'));
        }


        public function bill_details(Request $request)
        {
            $billNumber = $request->input('bill_number');
            $operatorCode = $request->input('operatorCode');
            $key = $request->input('Key');
        
            $fetchResponse = $this->rechargeService->billoperatorfetch($operatorCode, $billNumber, $key);
        
            // Decode response if it's a JSON string
            if (is_string($fetchResponse)) {
                $fetchResponse = json_decode($fetchResponse, true);
            }
        
            // Check if the response contains an error
            if (isset($fetchResponse['statuscode']) && $fetchResponse['statuscode'] === 'ERR') {
                return redirect()->back()->with('error', $fetchResponse['status']);
            }
        
        
            $customerDetails = [
                'customer_name' => trim($fetchResponse['CustomerName'] ?? 'N/A'),
                'due_amount' => $fetchResponse['DueAmount'] ?? 'N/A',
                'due_date' => $fetchResponse['DueDate'] ?? 'N/A',
                'bill_number' => $fetchResponse['BillNumber'] ?? 'N/A',
                'bill_date' => $fetchResponse['BillDate'] ?? 'N/A',
                'bill_period' => $fetchResponse['BillPeriod'] ?? 'N/A'
            ];
        
            $circle = Circle::all();
            $Operator = Operator::where('ServiceTypeName', 'Electricity')->get();
        
            return view('Web.User.bills.bill_details', compact('circle', 'Operator', 'customerDetails'));
        }
                



        public function common(Request $request)
            {
                $serviceType = $request->query('serviceType');

                $Operator = $serviceType ? Operator::where('ServiceTypeName', $serviceType)->get() : [];
                
                $circle = Circle::all();
                
                $billNumbers = Recharge::where('user_id', Auth::id())
                    ->where('serviceType', 'Prepaid-Mobile')
                    ->orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get();

                return view('Web.User.common.common_bill', compact('circle', 'Operator', 'billNumbers', 'serviceType'));
            }

}
