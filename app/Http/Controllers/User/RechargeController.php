<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\Operator;
use App\Models\Transaction;
use App\Services\RechargeService;
use App\Models\Recharge;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\BalanceCashback;

class RechargeController extends Controller
{
    protected $rechargeService;
    public function __construct(RechargeService $rechargeService)
    {
        $this->rechargeService = $rechargeService;
    }
    public function mobile(Request $request)
    {       
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
            return view('Web.User.recharge.mobile',compact('circle', 'Operator','rechargeNumbers'));
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
        'operatorCode', 'circleCode', 'filteredPlans', 'operator', 'plans'));
    }


    return redirect()->back()->with(['error' => 'Invalid response received from the API.'])->withInput();
}


    
    public function recharge(Request $request)
    {
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
        $plans = $this->rechargeService->recharge_prepaid($mobileNumber, $operatorCode, $circleCode, $rechargeAmount, $transaction_id);
        // echo "<pre>";print_r($plans['Status']);die;

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
        }elseif (isset($plans['Status']) && $plans['Status'] === "1") {
        
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
        $this->recharge_bonus($user, $rechargeAmount);
        //spin bonus
        $user = Auth::user();
        $cashback = BalanceCashback::where('category', 'Prepaid-Mobile')->where('balance', $rechargeAmount)->first();
        if($cashback){
            send_spin_chance($user,$rechargeAmount, $cashback->cashback, $cashback->category);
        }
       
               

        return redirect()->route('user.recharge.mobile')->with([
            'success' => 'Recharge successfully completed.'
        ]);
    
    }
}

public function recharge_bonus($user, $rechargeAmount) {
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
                'details'         => 'recharge commission from '.$authUser->name,
                'remark'          => 'reffrel_bonus',
                'post_balance'    => $user->balance, 
                'status'          => 1,
                'payment_status'  => 'success',
            ]);


            $referrer->save();
        }
    }
}


public function electtric_f(){

    $circle = Circle::all();
    $Operator = Operator::where('ServiceTypeName', 'Electricity')
   // ->whereIn('OperatorCode', ['AT', 'BSNL', 'VI', 'JIO'])
    ->get();

// return  $Operator;
    return view('Web.User.bills.electric_bill',compact('circle', 'Operator'));
}

public function wallet(){
return view('Web.User.recharge.wallet');
}

public function pages(){
return view('Web.User.recharge.searchpages');
}

    

}
