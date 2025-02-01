<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operator;
use App\Models\Circle;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiFetchController extends Controller
{
      

 
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
