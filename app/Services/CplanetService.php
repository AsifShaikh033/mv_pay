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


         public function rechargePrepaid($token, $mobileNumber, $operatorCode, $amount)
         {
             $url = "https://planetctechnology.in/planetcapi/api/rechargeApi";
         
             $postData = json_encode([
                 "clientReferenceNo" => "PLCT" . time(),
                 "customer_mobile"   => (string) $mobileNumber,
                 "opCode"            => (string) $operatorCode,
                 "amount"            => (int) $amount,
                 "token_key"         => "7a3e2c8bf54ee573396efcb881529747"
             ]);
         
             $curl = curl_init();
         
             curl_setopt_array($curl, [
                 CURLOPT_URL => $url,
                 CURLOPT_RETURNTRANSFER => true,
                 CURLOPT_POST => true,
                 CURLOPT_POSTFIELDS => $postData,
                 CURLOPT_HTTPHEADER => [
                     "Content-Type: application/json",
                     "Authorization: $token"
                 ]
             ]);
         
             $response = curl_exec($curl);
             $err = curl_error($curl);
         
             curl_close($curl);
         
             if ($err) {
                 return ["status" => false, "message" => "cURL Error: $err"];
             }
         
             return json_decode($response, true);
         }
         
         
         

          /**
     * Perform Prepaid Recharge
     */
    // public function rechargePrepaid($token, $mobileNumber, $operatorCode, $amount)
    // {
        
    //     $url = "https://planetctechnology.in/planetcapi/api/rechargeApi";
    
    //     $headers = [
    //         "Authorization:" . $token,
    //         "Content-Type: application/json",
    //     ];
    
    //     $postData = [
    //         "clientReferenceNo" => "PLCT" . time(),
    //         "customer_mobile"   => $mobileNumber,
    //         "opCode"            => $operatorCode,
    //         "amount"            => (int)$amount, 
    //         "token_key"         => '7a3e2c8bf54ee573396efcb881529747'
    //     ];
    
    //     $postJson = json_encode($postData, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $postJson);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Bypass SSL issue (only if necessary)
    
    //     $response = curl_exec($ch);
    //     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //     $error = curl_error($ch);
    //     curl_close($ch);
    
    //     if ($error) {
    //         return [
    //             "status" => false,
    //             "message" => "cURL Error: " . $error
    //         ];
    //     }
    
    //     $responseData = json_decode($response, true);
    
    //     if (json_last_error() !== JSON_ERROR_NONE) {
    //         return [
    //             "status" => false,
    //             "message" => "JSON Decode Error: " . json_last_error_msg(),
    //             "raw_response" => $response
    //         ];
    //     }
    
    //     if ($httpCode == 200 && isset($responseData['status'])) {
    //         return [
    //             "status" => $responseData['status'],
    //             "message" => $responseData['data']['message'] ?? "No message",
    //             "transaction_id" => $responseData['data']['data']['transid'] ?? null,
    //             "client_id" => $responseData['data']['data']['clientid'] ?? null,
    //             "status_code" => $responseData['data']['data']['statusCode'] ?? null,
    //             "operator_id" => $responseData['data']['data']['opid'] ?? null,
    //             "raw_response" => $responseData
    //         ];
    //     }
    
    //     return [
    //         "status" => false,
    //         "message" => "API Request Failed",
    //         "http_code" => $httpCode,
    //         "raw_response" => $response
    //     ];
    // }
    


         


}
