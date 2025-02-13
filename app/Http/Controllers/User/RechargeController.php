<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\Operator;
use App\Models\Transaction;
use App\Services\RechargeService;
use App\Models\Recharge;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
                ->orderBy('created_at', 'desc') // Latest first
                ->get();
            return view('Web.User.recharge.mobile',compact('circle', 'Operator','rechargeNumbers'));
        }

    //    public function plan(Request $request)
    //     {
    //         $request->validate([
    //             'mobile_number' => 'required|digits:10',
    //             'operator' => 'required',
    //             'circle' => 'required',
    //         ], [
    //             'mobile_number.digits' => 'Please enter a valid 10-digit mobile number.',
    //             'operator.required' => 'Please select an operator.',
    //             'circle.required' => 'Please select a circle.',
    //         ]);
        
    //         $mobileNumber = $request->input('mobile_number');
    //         $operatorCode = $request->input('operator');
    //         $circleCode = $request->input('circle');
    //         $plans = $this->rechargeService->fetchPlans($mobileNumber, $operatorCode, $circleCode);
    //         return $plans;
    //         // if (isset($plans['Status']) && $plans['Status'] == "1") {

    //         //     return redirect()->back()->with(['error' => $plans['ErrorDescription']])->withInput();

    //         // }elseif(isset($plans['Status']) && $plans['Status'] == "0"){

    //         //         $plans = $plans['PlanDescription'];
    //         //         $operator=  Operator::where('OperatorCode', $operatorCode)->first();
    //         //         $Circle=  Circle::where('circlecode', $circleCode)->first();
    //         //       return view('Web.User.recharge.Airtel_pr_plans', compact('mobileNumber',
    //         //        'Circle','plans', 'operator'));
    //         // }

    //         if (isset($plans['Status']) && $plans['Status'] === "1") {
    //             return redirect()->back()->with(['error' => $plans['ErrorDescription']])->withInput();
    //         } elseif (isset($plans['Status']) && $plans['Status'] === "0") {
    //             // Extract PlanVoucher plans only
    //             $allPlans = $plans['PlanDescription'];
    //             $planVouchers = array_filter($allPlans, function ($plan) {
    //                 return isset($plan['recharge_type']) && $plan['recharge_type'] === "PlanVoucher";
    //             });
        
    //             $operator = Operator::where('OperatorCode', $operatorCode)->first();
    //             $circle = Circle::where('circlecode', $circleCode)->first();
        
    //             return view('Web.User.recharge.plans', compact('mobileNumber', 'circle', 'planVouchers', 'operator'));
    //         }
          
    //         // return $plans;
    //         return view('Web.User.recharge.plan', compact('mobileNumber', 'operator', 'circle'));
    //     }

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
    
    public function recharge(Request $request)
    {
        $mobileNumber = $request->input('mobileNumber');
        $circle = $request->input('circle');
        $circleCode = $request->input('circleCode');
        $operator = $request->input('operator');
        $operatorCode = $request->input('operatorCode');
        $rechargeAmount = $request->input('recharge_amount');
        $rechargeValidity = $request->input('recharge_validity');
        $serviceType = $request->input('serviceType');
    
        $user = auth()->user();
        $userBalance = $user->balance ?? 0;
    
        if ($userBalance < $rechargeAmount) { 
            return redirect()->route('user.recharge.mobile')->with([
                'error' => 'User Balance Not sufficient.'
            ])->withInput();
        }
    
        $transaction_id = rand(1000000000, 99999999999);
    
        // Call the recharge service
        $plans = $this->rechargeService->recharge_prepaid($mobileNumber, $operatorCode, $circleCode, $rechargeAmount, $transaction_id);
        // echo "<pre>";print_r($plans['Status']);die;

        if (isset($plans['Status']) && $plans['Status'] === "0") {
            
            return redirect()->route('user.recharge.mobile')->with([
                'error' => 'Invalid Credientials.'
            ])->withInput();
        }elseif (isset($plans['Status']) && $plans['Status'] === "FAILURE") {
        
        $user->balance -= $rechargeAmount;
        $user->save();

        $Transaction =  new Transaction();
        $Transaction->user_id = $user->id;
        $Transaction->amount = $rechargeAmount;
        $Transaction->charge = 0.00;
        $Transaction->post_balance = $user->balance;
        $Transaction->trx_type = '+';
        $Transaction->details = 'recharge';
        $Transaction->remark = 'recharge_deduct';
        $Transaction->status = 0;
        $Transaction->payment_status = 'pending';
        $Transaction->transaction_id = $transaction_id;

        $Transaction->save();
        $user->save();


        $Recharge = new Recharge();
        $Recharge->user_id = $user->id;
        $Recharge->number = $mobileNumber;
        $Recharge->serviceType = $serviceType;
        $Recharge->operator = $operator;
        $Recharge->circle = $circleCode;
        $Recharge->amount = $rechargeAmount;
        $Recharge->user_tx = $transaction_id;
        $Recharge->status = 'success';
        $Recharge->format = 'json';
        $Recharge->api_response = json_encode($plans);
        $Recharge->save();

        return redirect()->route('user.recharge.mobile')->with([
            'success' => 'Recharge successfully completed.'
        ]);
    
        // return response()->json([
        //     'status' => 'success',
        //     'mobileNumber' => $mobileNumber,
        //     'circle' => $circle,
        //     'circleCode' => $circleCode,
        //     'operator' => $operator,
        //     'operatorCode' => $operatorCode,
        //     'recharge_amount' => $rechargeAmount,
        //     'recharge_validity' => $rechargeValidity,
        //     'transaction_id' => $transaction_id,
        // ]);
    }
}
    
    

}
