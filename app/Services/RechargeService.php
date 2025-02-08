<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RechargeService
{
    protected $apiBaseUrl;
    protected $CYRUS_MEMBER_ID;
    protected $CYRUS_PIN;
    protected $PR_MOBILE_FETCH;
    protected $BILL_FECTH_API;
    protected $OFFERS_DTH_Info;
    protected $DTH_Plan_Fetch;

    public function __construct()
    {
        // Base URL
        $this->apiBaseUrl = 'https://cyrusrecharge.in/';

        // API Credentials
        $this->CYRUS_MEMBER_ID = 'AP548117';
        $this->CYRUS_PIN = 'jghffhftryur567dhfd';

        // API Keys
        $this->PR_MOBILE_FETCH = 'htrytdsa5674564564hj';
        $this->PR_PLAN_FETCH = 'jghffhftryur567dhfd';
        $this->BILL_FECTH_API = '546ghjfdtreyertyrrtd';
        $this->OFFERS_DTH_Info = '465fghgfdfegfghfdhdh';
        $this->DTH_Plan_Fetch = 'jghffhftryur567dhfd';
    }

    
    /**
     * Fetch Recharge Plans
     */
    public function mobileoperatorfetch($mobileNumber)
    {
        $response = Http::get($this->apiBaseUrl . 'API/CyrusOperatorFatchAPI.aspx', [
            'APIID'         => $this->CYRUS_MEMBER_ID,
            'PASSWORD'      => $this->PR_MOBILE_FETCH, 
            'MOBILENUMBER' => $mobileNumber,
        ]);

        return $response->json();
    }



    /**
     * Fetch Recharge Plans
     */
    public function fetchPlans($mobileNumber, $operatorCode, $circleCode)
    {
        $response = Http::get($this->apiBaseUrl . 'API/CyrusPlanFatchAPI.aspx', [
            'APIID'         => $this->CYRUS_MEMBER_ID,
            'PASSWORD'      => $this->PR_PLAN_FETCH, 
            'Operator_Code' => $operatorCode,
            'Circle_Code'   => $circleCode,
            'MobileNumber'  => $mobileNumber,
            'data'          => 'ALL'
        ]);

        return $response->json();
    }
}
