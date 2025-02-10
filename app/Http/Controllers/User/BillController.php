<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\Operator;
use App\Services\RechargeService;
use App\Models\Recharge;
use Illuminate\Support\Facades\Auth;
class BillController extends Controller
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

       public function bill_plan(Request $request)
        {
            $request->validate([
                'bill_number' => 'required',
                'operator' => 'required',
                'circle' => 'required',
            ], [
                'bill_number.digits' => 'Please enter a valid Bill Number.',
                'operator.required' => 'Please select an operator.',
                'circle.required' => 'Please select a circle.',
            ]);
        
            $billNumber = $request->input('bill_number');
            $operatorCode = $request->input('operator');
            $circleCode = $request->input('circle');
            $plans = $this->rechargeService->fetchBillPlans($billNumber, $operatorCode, $circleCode);
            if (isset($plans['Status']) && $plans['Status'] == "1") {

                return redirect()->back()->with(['error' => $plans['ErrorDescription']])->withInput();

            }elseif(isset($plans['Status']) && $plans['Status'] == "0"){

                    $plans = $plans['PlanDescription'];
                    $operator=  Operator::where('OperatorCode', $operatorCode)->first();
                    $Circle=  Circle::where('circlecode', $circleCode)->first();
                  return view('Web.User.recharge.Airtel_pr_plans', compact('billNumber',
                   'Circle','plans', 'operator'));
            }else{
                return redirect()->back()->with(['error' => json_encode($plans)])->withInput();
            }
          
            return $plans;
            return view('Web.User.recharge.plan', compact('billNumber', 'operator', 'circle'));
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
