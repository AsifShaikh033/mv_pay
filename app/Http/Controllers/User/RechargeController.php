<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\Operator;
use App\Models\Transaction;
use App\Services\RechargeService;
use App\Services\CplanetService;
use App\Models\Recharge;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\BalanceCashback;
use Log;

class RechargeController extends Controller
{
    protected $rechargeService;
    protected $cplanetService;
    public function __construct(RechargeService $rechargeService, CplanetService $cplanetService)
    {
        $this->rechargeService = $rechargeService;
        $this->cplanetService = $cplanetService;
    }
   
    public function mobile(Request $request)
    {       
        $planId = $request->query('plan_id', null);
          $type = $request->query('type', 'Prepaid-Mobile');
            if ($type === 'postpaid_mob') {
                $type = 'Postpaid-Mobile';
                $exists = Operator::where('ServiceTypeName', $type)->exists();
                if (!$exists) {
                    insertOperators($type);
                }
                $Operator = Operator::where('ServiceTypeName', $type)->get();
            }else{
                $Operator = Operator::where('ServiceTypeName', $type)
                    ->whereIn('OperatorCode', ['AT', 'BSNL', 'VI', 'JIO'])
                    ->get();
            }
            $circle = Circle::all();

            $rechargeNumbers = Recharge::where('user_id', Auth::id())
                 ->where('serviceType','Prepaid-Mobile')
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
            return view('Web.User.recharge.mobile',compact('circle', 'Operator','rechargeNumbers', 'planId'));
        }

 

    public function plan(Request $request)
{
    
    $request->validate([
        'mobile_number' => 'required|digits:10',
        'operator' => 'required',
        'circle' => 'required',
    ], [
        'mobile_number.digits' => 'Please enter a valid 10-digit mobile number.',
        'operator.required' => 'Please select an operator.',
        'circle.required' => 'Please select a circle.',
    ]);

    $mobileNumber = $request->input('mobile_number');
    $operatorCode = $request->input('operator');
    $circleCode = $request->input('circle');
    if ($request->has('plan_id')) {
        $planId = $request->input('plan_id');
    }else{
        $planId = 0;
    }
    $operator = Operator::where('OperatorCode', $operatorCode)->value('OperatorName');

    if (!$operator) {
        return redirect()->back()->with(['error' => 'Invalid Operator selected.'])->withInput();
    }

    $circle = Circle::where('CircleCode', $circleCode)->value('CircleName');

    if (!$circle) {
        return redirect()->back()->with(['error' => 'Invalid Circle selected.'])->withInput();
    }

    $plans = $this->rechargeService->fetchPlans($mobileNumber, $operatorCode, $circleCode);
// return $plans;
    // Ensure that processing continues only if $plans is received
    if (isset($plans['Status']) && $plans['Status'] === "1") {
        return redirect()->back()->with(['error' => $plans['ErrorDescription']])->withInput();
    } elseif (isset($plans['Status']) && $plans['Status'] === "0") {
        $plans = $plans['PlanDescription'] ?? [];
        
        // $planVouchers = array_filter($plans, function ($plan) {
        //     return isset($plan['recharge_type']) && in_array($plan['recharge_type'], ["PlanVoucher", "FULLTT", "DATA", "TOPUP","STV","3G/4G"]);
        // });


        $operatorRechargeTypes = [
            'Jio' => ['PlanVoucher', 'FULLTT', 'DATA', 'JioPhone', 'JioPhoneDataAddon', 'JioBharatPhone', 'ISD', 'Value', 'IRWiFiCalling', 'InFlightPacks', 'Annual Plans', 'Entertainment', 'TrueUnlimitedUpgrade', 'True Unlimited Upgrade', 'Plan Extension', 'International Roaming'],
            'BSNL' => ['FULLTT', 'TOPUP', '3G/4G', 'COMBO', 'Romaing'],
            'Airtel' => ['PlanVoucher', 'COMBO', 'Annual Plans', 'Roaming', 'Value', 'Entertainment'],
            'VI' => ['TOPUP', 'STV', 'TrueUnlimitedUpgrade', 'IRWiFiCalling', 'InFlightPacks'],
        ];

        $operatorKey = null;
        foreach ($operatorRechargeTypes as $key => $types) {
            if (stripos($operator, $key) !== false) {
                $operatorKey = $key;
                break;
            }
        }
        
        if (!$operatorKey) {
            return redirect()->back()->with(['error' => 'Unsupported operator selected.'])->withInput();
        }
        
        $allowedRechargeTypes = $operatorRechargeTypes[$operatorKey] ?? [];

        $filteredPlans = array_filter($plans, function ($plan) use ($allowedRechargeTypes) {
            return isset($plan['recharge_type']) && in_array($plan['recharge_type'], $allowedRechargeTypes);
        });

        // $operator = $request->input('operator');
        // $circle = $request->input('circle');
        // $plans = $this->rechargeService->fetchPlans($mobileNumber, $operatorCode, $circleCode);
        return view('Web.User.recharge.plans', compact('mobileNumber', 'circle',
        'operatorCode', 'circleCode', 'filteredPlans', 'operator', 'plans','planId'));
    }


    return redirect()->back()->with(['error' => 'Invalid response received from the API.'])->withInput();
}


    
    public function recharge(Request $request)
    {
        $planId = $request->input('plan_id', null);
        $user = auth()->user();
        
        if ($planId) {
            $mobileNumber = $request->input('mobileNumber');
            $circle = $request->input('circle');
            $circleCode = $request->input('circleCode');
            $operator = $request->input('operator');
            $operatorCode = $request->input('operatorCode');
            $rechargeAmount = $request->input('recharge_amount');
            $rechargeValidity = $request->input('recharge_validity');
            $serviceType = $request->input('serviceType') ?? 'Prepaid-Mobile';


            $operatorMapping = [
                'AT' => 1,
                'VI' => 2,
                'JIO' => 3,
                'BSNL' => 4,
            ];

            $mappedCode = $operatorMapping[$operatorCode] ?? null;
            
            $operators = [
                ['OperatorCode' => 1, 'Operator' => 'AIRTEL'],
                ['OperatorCode' => 2, 'Operator' => 'VI'],
                ['OperatorCode' => 3, 'Operator' => 'JIO'],
                ['OperatorCode' => 4, 'Operator' => 'BSNL'],
            ];
            
            // dd(collect($operators)->pluck('OperatorCode')->toArray());

            $operator = collect($operators)->firstWhere('OperatorCode', $mappedCode)['Operator'] ?? null;
            
            if (!$operator) {
                return redirect()->route('user.recharge.mobile', ['plan_id' => 1])->with([
                    'error' => 'Invalid operator selected.'
                ])->withInput();
            }
            
            
            if (empty($rechargeAmount)) {
                return redirect()->route('user.recharge.mobile', ['plan_id' => 1])->with([
                    'error' => 'Recharge amount is missing.'
                ])->withInput();
            }
        
            if ($user->balance < $rechargeAmount) {
                return redirect()->route('user.recharge.mobile', ['plan_id' => 1])->with([
                    'error' => 'User Balance Not sufficient.'
                ])->withInput();
            }
        
            $transaction_id = $request->input('transaction_id') ?? rand(1000000000, 99999999999);
        
            $rechargeResponse = $this->cplanetService->rechargePrepaid(
                $request->input('mobileNumber'),
                $request->input('operatorCode'),
                $request->input('circle_code'),
                $rechargeAmount,
                $transaction_id
            );
            Log::warning('Call the c planet service', ['rechargeResponse' => $rechargeResponse]);
            $transaction = new Transaction;
            $transaction->user_id = $user->id;
            $transaction->amount = $rechargeAmount;
            $transaction->transaction_id = $transaction_id;
            $transaction->response_api_msg = json_encode($rechargeResponse);
            $transaction->remark = 'recharge_deduct';
            $transaction->trx_type = '-';
        
            $recharge = new Recharge();
            $recharge->user_id = $user->id;
            $recharge->number = $mobileNumber;
            $recharge->serviceType = $serviceType;
            $recharge->operator = $operator;
            $recharge->circle = $circleCode;
            $recharge->amount = $rechargeAmount;
            $recharge->user_tx = $transaction_id;
            $recharge->format = 'json';
        
            if (is_array($rechargeResponse) && isset($rechargeResponse['Status']) && $rechargeResponse['Status'] == '0') {
                $transaction->status = 0;
                $transaction->payment_status = 'failed';
                $transaction->details = 'Recharge failed for ' . $request->input('mobileNumber');
                $recharge->status = 'failed';
            } else {
                $user->balance -= $rechargeAmount;
                $user->save();
        
                $transaction->status = 1;
                $transaction->payment_status = 'success';
                $transaction->details = 'Recharge successful for ' . $request->input('mobileNumber');
                $transaction->post_balance = $user->balance;
        
                $recharge->status = 'success';
                $this->recharge_bonus($user, $rechargeAmount, $rechargeResponse);
        
                $cashback = BalanceCashback::where('category', 'Prepaid-Mobile')->where('balance', $rechargeAmount)->first();
                Log::warning('BalanceCashback', ['cashback' => $cashback]);
                if ($cashback) {
                    send_spin_chance($user, $rechargeAmount, $cashback->cashback, $cashback->category);
                }
            }
        
            $transaction->save();
            $recharge->api_response = json_encode($rechargeResponse);
            $recharge->save();
        
            if ($transaction->status == 1) {
                return redirect()->route('user.recharge.mobile', ['plan_id' => 1])->with([
                    'success' => 'Recharge successful. Transaction ID: ' . $transaction->transaction_id
                ]);
            } else {
                return redirect()->route('user.recharge.mobile', ['plan_id' => 1])->with([
                    'error' => $rechargeResponse['ErrorMessage'] ?? 'Recharge failed. Please try again.'
                ])->withInput();
            }


        }else{

            return 'cyrus api working';
         
        //cyrus
        $mobileNumber = $request->input('mobileNumber');
        $circle = $request->input('circle');
        $circleCode = $request->input('circleCode');
        $operator = $request->input('operator');
        $operatorCode = $request->input('operatorCode');
        $rechargeAmount = $request->input('recharge_amount');
        $rechargeValidity = $request->input('recharge_validity');
        $serviceType = $request->input('serviceType') ?? 'Prepaid-Mobile';
    
        $user = auth()->user();
        $userBalance = $user->balance ?? 0;
    
        if ($userBalance < $rechargeAmount) { 
            return redirect()->route('user.recharge.mobile')->with([
                'error' => 'User Balance Not sufficient.'
            ])->withInput();
        }
    
        $transaction_id = rand(1000000000, 99999999999);

        $Transaction =  new Transaction();
        $Transaction->user_id = $user->id;
        $Transaction->amount = $rechargeAmount;
        $Transaction->transaction_id = $transaction_id;
        $Transaction->charge = 0.00;
        $Transaction->trx_type = '-';
        $Transaction->details = 'recharge';
        $Transaction->remark = 'recharge_deduct';

        $Recharge = new Recharge();
        $Recharge->user_id = $user->id;
        $Recharge->number = $mobileNumber;
        $Recharge->serviceType = $serviceType;
        $Recharge->operator = $operator;
        $Recharge->circle = $circleCode;
        $Recharge->amount = $rechargeAmount;
        $Recharge->user_tx = $transaction_id;

      
    
        // Call the recharge service
     //   $plans = $this->rechargeService->recharge_prepaid($mobileNumber, $operatorCode, $circleCode, $rechargeAmount, $transaction_id);
        Log::warning('Call the recharge service', ['plans' => $plans]);
        if (isset($plans['Status']) && $plans['Status'] === "FAILURE") {

            $Transaction->post_balance = $user->balance;
            $Transaction->status = 0;
            $Transaction->payment_status = 'failed';
            $Transaction->save();
            
            $Recharge->status = 'failed';
            $Recharge->format = 'json';
            $Recharge->api_response = json_encode($plans);
            $Recharge->save();
            
            return redirect()->route('user.recharge.mobile')->with([
                'error' => $plans['ErrorMessage'],
            ])->withInput();
        }elseif (isset($plans['Status']) && $plans['Status'] === "Success") {
        
                // return   $plans;
            $user->balance -= $rechargeAmount;
        
            $Recharge->status = 'success';
            $Recharge->format = 'json';
            $Recharge->api_response = json_encode($plans);

            $Transaction->post_balance = $user->balance;
            $Transaction->status = 1;
            $Transaction->payment_status = 'success';
            $Transaction->save();
            $Recharge->save();
            $user->save();
            //recharge bonus
            $this->recharge_bonus($user, $rechargeAmount, $plans);
            //spin bonus
            $user = Auth::user();
            $cashback = BalanceCashback::where('category', 'Prepaid-Mobile')->where('balance', $rechargeAmount)->first();
            Log::warning('BalanceCashback', ['BalanceCashback' => $cashback]);
            if($cashback){
                send_spin_chance($user,$rechargeAmount, $cashback->cashback, $cashback->category);
            }
                

            return redirect()->route('user.recharge.mobile')->with([
                'success' => "Recharge successfully completed. Transaction ID: $transaction_id"
            ]);
    
    }
   }
        
}

public function recharge_bonus($user, $rechargeAmount, $plans) {
    $authUser = Auth::user();
    Log::warning('recharge_bonus', ['user' => $authUser]);
    if (!empty($authUser->referred_by)) {
        $referrer = User::where('id', $authUser->referred_by)->first();
        Log::warning('referrer', ['referrer' => $referrer]);
        if ($referrer) {
            $cashbackInPaise = (1 / 100) * 50;
            $referrer->balance += $cashbackInPaise;
          
            Transaction::create([
                'user_id'         => $referrer->id,
                'amount'          => $rechargeAmount, 
                'transaction_id'  => rand(1000000000, 99999999999),
                'charge'          => 0.00,
                'trx_type'        => '+',
                'details'         => 'recharge commission from '.$authUser->name,
                'remark'          => 'reffrel_bonus',
                'post_balance'    => $user->balance, 
                'status'          => 1,
                'payment_status'  => 'success',
                'response_api_msg'  => json_encode($plans),
            ]);


            $referrer->save();
            Log::warning('recharge bones given', ['referrer' => $referrer]);
        }
    }
}

public function showRechargeForm(Request $request)
{

    $data['mobileNumber'] = $request->input('mobileNumber');
    $data['circle'] = $request->input('circle');
    $data['circleCode'] = $request->input('circleCode');
    $data['operator'] = $request->input('operator');
    $data['operatorCode'] = $request->input('operatorCode');
    $data['rechargeAmount'] = $request->input('recharge_amount');
    $data['rechargeValidity'] = $request->input('recharge_validity');
    $data['serviceType'] = $request->input('serviceType') ?? 'Prepaid-Mobile';
    $data['plan_id'] = $request->input('plan_id');


    $operatorCode = $request->input('operatorCode');
    $circleCode = $request->input('circleCode');
    $mobileNumber = $request->input('mobileNumber');

    $Operator = Operator::all();
    $plans = $this->rechargeService->fetchPlans($mobileNumber, $operatorCode, $circleCode);
    
    $operator = $request->input('operator');
    $rechargeAmount = $request->input('recharge_amount');

    return view('Web.User.recharge.recharge', compact('plans', 'Operator', 'operator', 'rechargeAmount', 'data'));
}

public function saveRechargePin(Request $request)
    {
        $request->validate([
            'recharge_pin' => 'required'
        ]);

    $data['mobileNumber'] = $request->input('mobileNumber');
    $data['circle'] = $request->input('circle');
    $data['circleCode'] = $request->input('circleCode');
    $data['operator'] = $request->input('operator');
    $data['operatorCode'] = $request->input('operatorCode');
    $data['rechargeAmount'] = $request->input('recharge_amount');
    $data['rechargeValidity'] = $request->input('recharge_validity');
    $data['serviceType'] = $request->input('serviceType') ?? 'Prepaid-Mobile';
    $data['plan_id'] = $request->input('plan_id');


        $authUser = Auth::user();
        $checkPin =  User::where('id', $authUser->id)->first();

        if($request->forget_pin == 0 && $checkPin->recharge_pin != $request->recharge_pin){
            return redirect()->back()->with('error', 'Recharge PIN is not match!');
            // return redirect()->back()->with(['error' => 'Invalid response received from the API.'])->withInput();
        }

        
        if($checkPin->recharge_pin && ($checkPin->recharge_pin == $request->recharge_pin
        )){
            // return redirect()->route('user.recharge.final_recharge')->with('success', 'Recharge PIN set successfully!');
            return redirect()->route('user.recharge.final_recharge')
    ->with('success', 'Recharge PIN set successfully!')
    ->with('rechargeData', $data);

        }elseif(empty($checkPin->recharge_pin) || $request->forget_pin == 1){
            $user = Auth::user();
            $user->recharge_pin = $request->recharge_pin;
            $user->save();
            // return redirect()->route('user.recharge.final_recharge')->with('success', 'Recharge PIN set successfully!');
            return redirect()->route('user.recharge.final_recharge')
    ->with('success', 'Recharge PIN set successfully!')
    ->with('rechargeData', $data);

        }

        
    }

    public function finalRecharge(Request $request)
    {

        $rechargeData = session('rechargeData');
        if(empty($rechargeData)){
            return redirect()->back();
        }
        
        $operatorCode = $request->input('operatorCode');
        $circleCode = $request->input('circleCode');
        $mobileNumber = $request->input('mobileNumber');
    
        
    
        $Operator = Operator::all();
        $plans = $this->rechargeService->fetchPlans($mobileNumber, $operatorCode, $circleCode);
    
        $operator = $request->input('operator');
        $rechargeAmount = $request->input('recharge_amount');
        $circle = $request->input('circle');
        $planId = $request->input('plan_id');
    
        return view('Web.User.recharge.final_recharge', compact(
            'plans', 'Operator', 'operator', 'rechargeAmount',
            'mobileNumber', 'circle', 'circleCode', 'operatorCode', 'planId','rechargeData'
        ));
    }
    


public function electtric_f(){

    $circle = Circle::all();
    $Operator = Operator::where('ServiceTypeName', 'Electricity')
   // ->whereIn('OperatorCode', ['AT', 'BSNL', 'VI', 'JIO'])
    ->get();

    return view('Web.User.bills.electric_bill',compact('circle', 'Operator'));
}

public function wallet(){
    $userId = auth()->id();
    $authUser = Auth::user();

    $spinWinTotal = Transaction::where('user_id', $userId)
        ->where('remark', 'spin_win')
        ->where('status', 1)
        ->count();

        $user = User::find($userId);
        $referredUser = User::find($authUser->referred_by);
        $referredBalance = $referredUser ? $referredUser->balance : 0.00;

        $total = $spinWinTotal + $referredBalance;

        $userBalance = $user->balance;

    return view('Web.User.recharge.wallet', compact('spinWinTotal', 'referredBalance', 'total', 'userBalance'));
}

public function pages(){
return view('Web.User.recharge.searchpages');
}

    

}
