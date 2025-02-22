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
        $this->PR_MOBILE_RECHARGE = '788B8AD82D';
        $this->PR_PLAN_FETCH = 'jghffhftryur567dhfd';
        $this->BILL_FECTH_API = '546ghjfdtreyertyrrtd';
        $this->OFFERS_DTH_Info = '465fghgfdfegfghfdhdh';
        $this->DTH_Plan_Fetch = 'jghffhftryur567dhfd';
        $this->CREDIT_CARD='FC8FD51008';
        $this->AXIS_BANK='FC8FD51008';
        $this->Bill_Pay = 'X7Cf62_cIGage(i';
        $this->Bill_Pay_MEMBER_ID = 'AP517747';
    }


    //LEAD GENRATE START
     /**
     * genrate credit card link
     */
    public function credit_card_link()
    {
        $response = Http::asJson()->post($this->apiBaseUrl . 'api/LeadGeneration.aspx', [
            'refid'         => uniqid(), 
            'merchantcode'  => mt_rand(1000, 9999), 
            'MerchantID'    => $this->CYRUS_MEMBER_ID, 
            'MerchantKey'   =>  $this->CREDIT_CARD, 
            'MethodName'    => 'CCCA',
        ]);
        return $response->json();
    }

    public function applyAxicAccount($type)
    {
        $response = Http::post($this->apiBaseUrl . 'api/openaxisaccount.aspx', [
            "MerchantID"   => $this->CYRUS_MEMBER_ID,
            "MerchantKey"  => $this->AXIS_BANK,
            'TransID'         => uniqid(), 
            "MethodName"   => "openaxisaccount",
            "merchantcode" => rand(1000, 9999), 
            "type"         => $type 
        ]);

        return $response->json();
    }
    
    
    //RECHARGE START
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


    public function billoperatorfetch($billNumber)
    {
       
        $response = Http::get($this->apiBaseUrl . 'API/BillFetch_Cyrus_BA.aspx', [
            'APIID'         => $this->Bill_Pay_MEMBER_ID,
            'PASSWORD'      => $this->PR_MOBILE_FETCH, 
            'BILLNUMBER' => $billNumber,
        ]);
return $response;
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
    /**
     * Fetch Electricity Bill Plans
     */
    public function fetchBillPlans($billNumber, $operatorCode, $circleCode, $billAmount, $transaction_id)
    {
        $response = Http::get($this->apiBaseUrl . 'services_cyapi/recharge_cyapi.aspx', [
            'memberid'         => $this->Bill_Pay_MEMBER_ID,
            'pin'              => $this->Bill_Pay, 
            'number'           => $billNumber, 
            'operator'         => $operatorCode,
            'circle'          => $circleCode,
            'amount'          => $billAmount,
            'usertx'          => $transaction_id,
            'format'           => 'json',
            'RechargeMode'     => 1
        ]);

        return $response->json();
    }


     /**
     * Fetch Electricity Bill Plans
     */
    public function recharge_prepaid($mobileNumber, $operatorCode, $circleCode, $rechargeAmount, $transaction_id)
    {
        $response = Http::get($this->apiBaseUrl . 'services_cyapi/recharge_cyapi.aspx', [
            'memberid'         => $this->CYRUS_MEMBER_ID,
            'pin'              => $this->PR_MOBILE_RECHARGE, 
            'number'           => $mobileNumber,
            'operator'         => $operatorCode,
            'circle'           => $circleCode,
            'amount'           => $rechargeAmount,
            'usertx'           => $transaction_id,
            'format'           => 'json',
            'RechargeMode'          => 1
        ]);

        return $response->json();
    }
}
