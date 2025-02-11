<?php

use App\Models\WebConfig;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use App\Models\Operator;
use App\Models\BalanceCashback;



if (!function_exists('webConfig')) {
    /**
     * Get value from the web_config table by column name.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function webConfig($key, $default = null)
    {
        $config = WebConfig::first();
        return $config ? $config->{$key} : $default;
    }
}

if (!function_exists('cashback_value')) {
    /**
     * Get value from the web_config table by column name.
     *
     * @param string $type
     * @param mixed $amount
     * @return mixed
     */
    function cashback_value($type, $category, $amount)
    {
        $config = BalanceCashback::where('category',$type)->where('balance',$amount)->value('cashback');

        return $config;
    }
}



if (!function_exists('webConfig')) {
    /**
     * Get value from the web_config table by column name.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function webConfig($key, $default = null)
    {
        $config = WebConfig::first();
        return $config ? $config->{$key} : $default;
    }
}


  
if (!function_exists('SetToken')) {
    /**
     * Set and save a new token for the user if it's their first login.
     * Also sends the token to the external API to update.
     *
     * @param User $user
     * @return void
     */
    function SetToken(User $user)
    {
        $randomToken = Str::random(10); 
        $user->remember_token = $randomToken; 
        $user->save(); 
    
        try {
            $response = Http::get('https://mvvision.in/api/update-token', [
                'email' => $user->email, 
                'name' => $user->name, 
                'mob_number' => $user->mob_number,
                'identity_image' => $user->identity_image,
                'password' => $user->password,
                'random_token' => $randomToken, 
            ]);
            if ($response->successful()) {
                return response()->json([
                    'message' => 'Login successful and token sent to mvpay.',
                    'token' => $randomToken,
                ]);
            } else {
                return response()->json([
                    'message' => 'Token update failed on mvpay.',
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error sending token to mvpay: ' . $e->getMessage(),
            ], 500);
        }
    }
}



 
if (!function_exists('send_spin_chance')) {
    /**
     * Set and save a new token for the user if it's their first login.
     * Also sends the token to the external API to update.
     *
     * @param User $user
     * @return void
     */
    function send_spin_chance(User $user, $spin_count)
    {
      
        try {
            $response = Http::get(env('MVivsionURL') . '/api/update-spinchance', [
                'email' => $user->email, 
                'token' =>  $user->remember_token, 
                'spin_count'=> $spin_count
            ]);
    
            if ($response->successful()) {
                return response()->json([
                    'message' => 'mv vision spin count updated.',
                    'token' => $randomToken,
                ]);
            } else {
                return response()->json([
                    'message' => 'spin update failed on mv vision.',
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error sending spin count to vision: ' . $e->getMessage(),
            ], 500);
        }
    }


    function checkSubcription(User $user)
    { 
       
    
        try {
            $response = Http::get('https://mvvision.in/api/chech-subcription', [
                'email' => $user->email, 
            ]);
//    echo $response;die;
    if ($response->successful()) {
        $responseData = $response->json();

        if (isset($responseData['subscription'])) {
            $subscription = $responseData['subscription']; 
        }

        return $subscription; // Return the subscription status
    } else {
                return response()->json([
                    'message' => 'Token update failed on mvpay.',
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error sending token to mvpay: ' . $e->getMessage(),
            ], 500);
        }
    }
}



if (!function_exists('insertOperators')) {
    function insertOperators($type)
    {
        $operators = [
            'Postpaid-Mobile' => [
                ['ServiceTypeName' => $type, 'OperatorCode' => 'ATP', 'OperatorName' => 'Airtel'],
                ['ServiceTypeName' => $type, 'OperatorCode' => 'IDP', 'OperatorName' => 'Idea'],
                ['ServiceTypeName' => $type, 'OperatorCode' => 'VPOLD', 'OperatorName' => 'Vodafone'],
                ['ServiceTypeName' => $type, 'OperatorCode' => 'BSP', 'OperatorName' => 'BSNL Mobile'],
                ['ServiceTypeName' => $type, 'OperatorCode' => 'TDCMP', 'OperatorName' => 'Tata Docomo CDMA Mobile Postpaid'],
                ['ServiceTypeName' => $type, 'OperatorCode' => 'TDGMP', 'OperatorName' => 'Tata Docomo GSM Mobile Postpaid'],
                ['ServiceTypeName' => $type, 'OperatorCode' => 'MMD', 'OperatorName' => 'MTNL Mumbai Dolphin'],
                ['ServiceTypeName' => $type, 'OperatorCode' => 'VFP', 'OperatorName' => 'Vi Postpaid'],
                ['ServiceTypeName' => $type, 'OperatorCode' => 'RJC', 'OperatorName' => 'Reliance Jio Postpaid'],
            ]
        ];

        if (isset($operators[$type])) {
            Operator::insert($operators[$type]);
        }
    }
}

