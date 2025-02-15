<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RechargeService;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class LeadGenerateController extends Controller
{
    protected $leadGenerate;
    public function __construct(RechargeService $leadGenerate)
    {
        $this->leadGenerate = $leadGenerate;
    }

    
    public function credit_card_link()
    {
        $tokenResponse = $this->leadGenerate->credit_card_link();
    
        \Log::info('Credit Card API Response: ', $tokenResponse);
    
        if (isset($tokenResponse['status']) && $tokenResponse['status'] === true && isset($tokenResponse['data']['link'])) {
            return redirect()->away($tokenResponse['data']['link']); // Open link in new tab
        }
    
        return back()->with('error', $tokenResponse['message'] ?? 'Something went wrong');
    }
    
}
