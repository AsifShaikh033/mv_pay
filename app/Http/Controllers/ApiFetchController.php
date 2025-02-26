<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;
use App\Models\Circle;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\RechargeService;
class ApiFetchController extends Controller
{
    protected $rechargeService;
    public function __construct(RechargeService $rechargeService)
    {
        $this->rechargeService = $rechargeService;
    }


    public function fetchOperatorCircle(Request $request)
    {
        $mobileNumber = $request->mobile_number;
    
        if (strlen($mobileNumber) !== 10) {
            return response()->json(['error' => 'Invalid mobile number'], 400);
        }

        $plans = $this->rechargeService->mobileoperatorfetch($mobileNumber);
      
        if (isset($plans['error'])) {
            return response()->json(['error' => $plans['error']], 400);
        }
        if (isset($plans['Status']) && $plans['Status'] == "1") {
            return response()->json(['error' => $plans['ErrorDescription']], 400);
        }elseif(isset($plans['Status']) && $plans['Status'] == "0"){
            return response()->json([
                'status' => 1,
                'operator' => $plans['OperatorCode'],
                'circle' => $plans['CircleCode'],
            ]);
        }else{
            return response()->json(['error' => $plans], 400);
        }
      
    }

    public function billfetchOperatorCircle(Request $request)
        {
            $billNumber = $request->bill_number;
            $operator = $request->operator;

            if (empty($operator) || empty($billNumber)) {
                return response()->json(['error' => 'Both operator and bill number are required'], 400);
            }

            $plans = $this->rechargeService->billoperatorfetch($operator, $billNumber);

            if (isset($plans['error'])) {
                return response()->json(['error' => $plans['error']], 400);
            }

            if (isset($plans['Status']) && $plans['Status'] == "1") {
                return response()->json(['error' => $plans['ErrorDescription']], 400);
            } elseif (isset($plans['Status']) && $plans['Status'] == "0") {
                return response()->json([
                    'status' => 1,
                    'operator' => $plans['OperatorCode'],
                    'circle' => $plans['CircleCode'],
                ]);
            } else {
                return response()->json(['error' => $plans], 400);
            }
        }


        public function dthfetchOperatorCircle(Request $request)
        {
            $billNumber = $request->bill_number;
            $operator = $request->operator;

            if (empty($operator) || empty($billNumber)) {
                return response()->json(['error' => 'Both operator and number are required'], 400);
            }

            $plans = $this->rechargeService->dthoperatorfetch($operator, $billNumber);

            if (isset($plans['error'])) {
                return response()->json(['error' => $plans['error']], 400);
            }

            if (isset($plans['Status']) && $plans['Status'] == "1") {
                return response()->json(['error' => $plans['ErrorDescription']], 400);
            } elseif (isset($plans['Status']) && $plans['Status'] == "0") {
                return response()->json([
                    'status' => 1,
                    'operator' => $plans['OperatorCode'],
                    'circle' => $plans['CircleCode'],
                ]);
            } else {
                return response()->json(['error' => $plans], 400);
            }
        }

 
    public function circle_api()
    {
        $response = Http::get('https://cyrusrecharge.in/api/GetOperator.aspx', [
            'memberid' => env('CYRUS_MEMBER_ID'),
            'pin' => env('CYRUS_PIN'),
            'Method' => 'getcircle'
        ]);

        $data = $response->json();
      

        if (!empty($data) && is_array($data)) {
            $firstElement = $data[0] ?? null; 

            if ($firstElement && isset($firstElement['Status']) && $firstElement['Status'] == "1" && isset($firstElement['data'])) {
                foreach ($firstElement['data'] as $circle) {
                    if (!isset($circle['circlecode']) || !isset($circle['circlename'])) {
                        continue; 
                    }

                    Circle::updateOrCreate(
                        ['circlecode' => $circle['circlecode']],
                        ['circlename' => $circle['circlename']]
                    );
                }

                return response()->json([
                    'message' => 'Circles updated successfully',
                    'status' => true
                ]);
            }
        }

        return response()->json([
            'message' => 'Invalid API response format',
            'status' => false
        ], 400);
    }


    public function operator_api()
    {
        $response = Http::get('https://cyrusrecharge.in/api/GetOperator.aspx', [
            'memberid' => env('CYRUS_MEMBER_ID'),
            'pin' => env('CYRUS_PIN'),
            'Method' => 'getoperator'
        ]);

        $data = $response->json();

        if (!empty($data) && is_array($data)) {
            $firstElement = $data[0] ?? null; 

            if ($firstElement && isset($firstElement['Status']) && $firstElement['Status'] == "1" && isset($firstElement['data'])) {
                foreach ($firstElement['data'] as $service) {
                    $serviceType = $service['ServiceTypeName'] ?? null;
                    
                    if (!$serviceType || !isset($service['data']) || !is_array($service['data'])) {
                        continue; 
                    }

                    foreach ($service['data'] as $operator) {
                        if (!isset($operator['OperatorCode']) || !isset($operator['OperatorName'])) {
                            continue; 
                        }

                        Operator::updateOrCreate(
                            [
                                'ServiceTypeName' => $serviceType,
                                'OperatorCode' => $operator['OperatorCode'],
                            ],
                            ['OperatorName' => $operator['OperatorName']]
                        );
                    }
                }

                return response()->json([
                    'message' => 'Operators updated successfully',
                    'status' => true
                ]);
            }
        }

        return response()->json([
            'message' => 'Invalid API response format',
            'status' => false
        ], 400);
    }
}
