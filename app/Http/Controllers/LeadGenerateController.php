<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RechargeService;
use App\Models\LeadGeneration;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class LeadGenerateController extends Controller
{
    protected $leadGenerate;
    public function __construct(RechargeService $leadGenerate)
    {
        $this->leadGenerate = $leadGenerate;
    }


    // public function credit_card_link()
    // {
    //     $tokenResponse = $this->leadGenerate->credit_card_link();
        
    //     if (isset($tokenResponse['status']) && $tokenResponse['status'] === true && isset($tokenResponse['data']['link'])) {
    //         return response()->json(['url' => $tokenResponse['data']['link']]);
    //     }
    
    //     return response()->json(['error' => $tokenResponse['message'] ?? 'Something went wrong'], 400);
    // }

    public function credit_card_link()
{
    $tokenResponse = $this->leadGenerate->credit_card_link();
    
    if (isset($tokenResponse['status']) && $tokenResponse['status'] === true && isset($tokenResponse['data']['link'])) {
        
        $url = $tokenResponse['data']['link'];
        $leadGeneration = LeadGeneration::create([
            'user_id' => auth()->id(), 
            'type' => 'credit_card',
            'url' => $url,
        ]);

        return response()->json(['url' => $url]);
    }
    return response()->json(['error' => $tokenResponse['message'] ?? 'Something went wrong'], 400);
}

    

    // public function axic_account(Request $request)
    // {
    //     $type = $request->query('type'); // Get type (1 for savings, 2 for current)
    //     $response = $this->leadGenerate->applyAxicAccount($type);
    
    //     if ($response['status'] == true && isset($response['data'])) {
    //         return response()->json(['url' => $response['data']]);
    //     } else {
    //         return response()->json(['error' => $response['message'] ?? 'Something went wrong.'], 400);
    //     }
    // }


    public function axic_account(Request $request)
{
    $type = $request->query('type'); 
    $response = $this->leadGenerate->applyAxicAccount($type);

    if ($response['status'] == true && isset($response['data'])) {
       
        $url = $response['data'];

        $leadGeneration = LeadGeneration::create([
            'user_id' => auth()->id(),  
            'type' => 'bank_acc',
            'account_type' => $type, 
            'url' => $url,
            'status' => 1  
        ]);

     
        return response()->json(['url' => $url]);
    }

  
    return response()->json(['error' => $response['message'] ?? 'Something went wrong.'], 400);
}


    
    
}
