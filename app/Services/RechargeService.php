<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Log;

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

    public function bill_FORM_FETCH($operator)
    {
        try {
            $response = Http::asForm()->post($this->apiBaseUrl . 'api/BillFetch_Cyrus_BA.aspx', [
                'memberid'    => $this->CYRUS_MEMBER_ID,
                'pin'         => $this->BILL_FECTH_API,
                'methodname'  => 'get_billerinfo',
                'operator'    => $operator,
            ]);

            if ($response->failed()) {
                return ['error' => 'Failed to connect to API', 'status' => $response->status()];
            }

            $rawResponse = $response->body();

            if (empty($rawResponse)) {
                return ['error' => 'Empty response from API'];
            }

            $data = json_decode($rawResponse, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return ['error' => 'Invalid JSON response from API', 'raw' => $rawResponse];
            }

            if (!isset($data['Request']) || !is_array($data['Request'])) {
                return ['error' => 'Invalid API response structure', 'raw' => $rawResponse];
            }

            return $data['Request'];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    


    public function billoperatorfetch($operator, $billNumber, $key)
    {
        try {
            $url = $this->apiBaseUrl . 'api/BillFetch_Cyrus_BA.aspx';
    
            $postData = [
                'memberid'    => $this->CYRUS_MEMBER_ID,
                'pin'         => $this->BILL_FECTH_API,
                'methodname'  => 'get_billfetch',
                'operator'    => $operator,
                'RequestData' => json_encode([
                    'Request' => [
                        [
                            'Key'        => $key,
                            'Value'      => $billNumber,
                            'isOptional' => 'False'
                        ]
                    ]
                ]),
                'format'      => 'json',
            ];
    
            $ch = curl_init();
    
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: multipart/form-data'
            ]);
    
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
            if (curl_errno($ch)) {
                $error = curl_error($ch);
                Log::error('cURL Error', ['error' => $error]);
                return ['error' => 'cURL Error: ' . $error];
            }
    
            curl_close($ch);
    
            Log::info('API Response', ['response' => $response]);
    
            if ($httpCode !== 200) {
                return ['error' => 'API request failed with status ' . $httpCode];
            }
    
            return json_decode($response, true);
        } catch (\Exception $e) {
            Log::error('API Exception', ['message' => $e->getMessage()]);
            return ['error' => 'An error occurred: ' . $e->getMessage()];
        }
    }
    

    public function dthoperatorfetch($operator, $billNumber)
    {
        try {
            $response = Http::asForm()->get($this->apiBaseUrl . 'api/CyrusROfferAPI.aspx', [
                'MerchantID'    => $this->CYRUS_MEMBER_ID,
                'MerchantKey'         => $this->OFFERS_DTH_Info,
                'MethodName'  => 'dthinfo',
                'operator'    => $operator,
                 'mobile' => $billNumber,
                'offer' => 'roffer'
            ]);
            // echo "<pre>";print_r($response);die;
            if ($response->failed()) {
                return ['error' => 'Failed to connect to API', 'status' => $response->status()];
            }

            $rawResponse = $response->body();

            if (empty($rawResponse)) {
                return ['error' => 'Empty response from API'];
            }

            $data = json_decode($rawResponse, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return ['error' => 'Invalid JSON response from API', 'raw' => $rawResponse];
            }

            return $data;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
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
    public function electricityBillPay($billNumber, $operatorCode, $circleCode, $amount, $transaction_id)
    {
        $response = Http::get($this->apiBaseUrl . 'services_cyapi/recharge_cyapi.aspx', [
            'memberid'         => $this->Bill_Pay_MEMBER_ID,
            'pin'              => $this->Bill_Pay, 
            'number'           => $billNumber, 
            'operator'         => $operatorCode,
            'circle'          => $circleCode,
            'amount'          => $amount,
            'usertx'          => $transaction_id,
           // 'account'         => '2715500000356',
           // 'othervalue'      => 'Other_Values',
           // 'othervalue1'     => 'Other_Values', 
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
