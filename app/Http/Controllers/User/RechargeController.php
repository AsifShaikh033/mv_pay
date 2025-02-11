<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\Operator;
use App\Services\RechargeService;
use App\Models\Recharge;
use Illuminate\Support\Facades\Auth;
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

    $plans = $this->rechargeService->fetchPlans($mobileNumber, $operatorCode, $circleCode);

    // Ensure that processing continues only if $plans is received
    if (isset($plans['Status']) && $plans['Status'] === "1") {
        return redirect()->back()->with(['error' => $plans['ErrorDescription']])->withInput();
    } elseif (isset($plans['Status']) && $plans['Status'] === "0") {
        $plans = $plans['PlanDescription'] ?? [];
        
        $planVouchers = array_filter($plans, function ($plan) {
            return isset($plan['recharge_type']) && in_array($plan['recharge_type'], ["PlanVoucher", "FULLTT ", "DATA", "TOPUP","STV"]);
        });
        


        $operator = $request->input('operator');
        $circle = $request->input('circle');
        // $plans = $this->rechargeService->fetchPlans($mobileNumber, $operatorCode, $circleCode);
        return view('Web.User.recharge.plans', compact('mobileNumber', 'circle', 'planVouchers', 'operator', 'plans'));
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
}
