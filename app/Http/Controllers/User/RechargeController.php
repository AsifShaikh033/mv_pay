<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle;
use App\Models\Operator;
class RechargeController extends Controller
{
    public function mobile(){

        $circle = Circle::all();
        $Operator = Operator::where('ServiceTypeName', 'Prepaid-Mobile')
        ->whereIn('OperatorCode', ['AT', 'BSNL', 'VI', 'JIO'])
        ->get();
    
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
            // Retrieve form data
            $mobileNumber = $request->input('mobile_number');
            $operator = $request->input('operator');
            $circle = $request->input('circle');


           // return $request;
            // Debugging (optional)
            // dd($mobileNumber, $operator, $circle);

            // Return a view or response
            return view('Web.User.recharge.plan', compact('mobileNumber', 'operator', 'circle'));
        }

    public function wallet(){
        return view('Web.User.recharge.wallet');
    }
    
    public function pages(){
        return view('Web.User.recharge.searchpages');
    }
}
