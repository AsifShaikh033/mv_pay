<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CplanetService
{
    protected $apiBaseUrl;
    protected $user_name;
    protected $password;
    protected $token;

    public function __construct()
    {
        $this->apiBaseUrl = 'https://planetctechnology.in/';
        $this->user_name = '9340029158';
        $this->password = 'Welcome@2580';
        $this->token_key = '49.43.1.135'; 
    }

    /**
         * Generate Token
         */

         public function getToken()
         {
             $response = Http::asForm()->post($this->apiBaseUrl . 'planetcapi/auth/user/generateToken', [
                 'user_name' => $this->user_name,
                 'password'  => $this->password,
             ]);
         
             $data = $response->json();
         
             if ($response->successful() && isset($data['data']['token'])) {
                 return $data['data']['token'];
             }
         
             if (isset($data['error']) && is_array($data['error'])) {
                 $firstError = reset($data['error']);
                 return [
                     'status' => false,
                     'message' => $firstError,
                 ];
             }
         
             return [
                 'status' => false,
                 'message' => $data,
             ];
         }


          /**
     * Perform Prepaid Recharge
     */
    public function rechargePrepaid($token, $mobileNumber, $operatorCode, $amount)
{
    // Ensure all required parameters are available
    if (empty($token) || empty($mobileNumber) || empty($operatorCode) || empty($amount) || empty($this->token_key)) {
        return [
            'status' => false,
            'message' => 'Missing required parameters. Please check your request.',
        ];
    }

    $clientReferenceNo = 'PLCT' . time();

    // Log the request for debugging
    \Log::info('Recharge API Request', [
        'Authorization' => 'Bearer ' . $token,
        'clientReferenceNo' => $clientReferenceNo,
        'customer_mobile'   => $mobileNumber,
        'opCode'            => $operatorCode,
        'amount'            => $amount,
        'token_key'         => $this->token_key,
    ]);

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post($this->apiBaseUrl . 'planetcapi/api/rechargeApi', [
        'clientReferenceNo' => $clientReferenceNo,
        'customer_mobile'   => $mobileNumber,
        'opCode'            => $operatorCode,
        'amount'            => $amount,
        'token_key'         => $this->token_key,
    ]);

    $data = $response->json();

    // Log API response for debugging
    \Log::info('Recharge API Response', $data);

    if ($response->successful() && isset($data['status']) && $data['status']) {
        return [
            'status' => true,
            'transaction_id' => $data['data']['data']['transid'] ?? null,
            'message' => $data['data']['data']['message'] ?? 'Recharge successful.',
            'statusCode' => $data['data']['data']['statusCode'] ?? null, // statusCode 2(Success), 1-(Pending), 3(Failed)
        ];
    }

    return [
        'status' => false,
        'message' => $data['message'],
    ];
}

         


}
