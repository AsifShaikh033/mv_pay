<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\Operator;
class RechargeController extends Controller
{
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
            // {{ route('user.recharge.mobile', ['type' => 'postpaid_mob']) }}
        // return  $Operator;
            return view('Web.User.recharge.mobile',compact('circle', 'Operator'));
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
            $operator = $request->input('operator');
            $circle = $request->input('circle');
            return view('Web.User.recharge.plan', compact('mobileNumber', 'operator', 'circle'));
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
