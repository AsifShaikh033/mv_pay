<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Circle;

class CircleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["circlecode" => "36", "circlename" => "ANDAMAN AND NICOBAR ISLANDS"],
            ["circlecode" => "1", "circlename" => "Andhra Pradesh"],
            ["circlecode" => "26", "circlename" => "ARUNACHAL PRADESH"],
            ["circlecode" => "2", "circlename" => "Assam"],
            ["circlecode" => "3", "circlename" => "Bihar"],
            ["circlecode" => "42", "circlename" => "Bihar and Jharkhand"],
            ["circlecode" => "4", "circlename" => "Chennai"],
            ["circlecode" => "27", "circlename" => "CHHATTISGARH"],
            ["circlecode" => "41", "circlename" => "DADRA AND NAGAR"],
            ["circlecode" => "40", "circlename" => "DAMAN AND DIU"],
            ["circlecode" => "5", "circlename" => "Delhi"],
            ["circlecode" => "28", "circlename" => "GOA"],
            ["circlecode" => "6", "circlename" => "Gujarat"],
            ["circlecode" => "7", "circlename" => "Haryana"],
            ["circlecode" => "8", "circlename" => "Himachal Pradesh"],
            ["circlecode" => "9", "circlename" => "Jammu & Kashmir"],
            ["circlecode" => "24", "circlename" => "Jharkhand"],
            ["circlecode" => "10", "circlename" => "Karnataka"],
            ["circlecode" => "11", "circlename" => "Kerala"],
            ["circlecode" => "12", "circlename" => "Kolkata"],
            ["circlecode" => "39", "circlename" => "LAKSHADWEEP"],
            ["circlecode" => "14", "circlename" => "MADHYA PRADESH CHHATTISGARH"],
            ["circlecode" => "13", "circlename" => "Maharashtra"],
            ["circlecode" => "29", "circlename" => "MANIPUR"],
            ["circlecode" => "30", "circlename" => "MEGHALAYA"],
            ["circlecode" => "31", "circlename" => "MIZORAM"],
            ["circlecode" => "15", "circlename" => "Mumbai"],
            ["circlecode" => "32", "circlename" => "NAGALAND"],
            ["circlecode" => "16", "circlename" => "North East"],
            ["circlecode" => "17", "circlename" => "Odisha"],
            ["circlecode" => "38", "circlename" => "PUDUCHERRY"],
            ["circlecode" => "18", "circlename" => "Punjab"],
            ["circlecode" => "19", "circlename" => "Rajasthan"],
            ["circlecode" => "33", "circlename" => "SIKKIM"],
            ["circlecode" => "20", "circlename" => "Tamil Nadu"],
            ["circlecode" => "37", "circlename" => "TELANGANA"],
            ["circlecode" => "25", "circlename" => "TRIPURA"],
            ["circlecode" => "34", "circlename" => "UTTAR PRADESH"],
            ["circlecode" => "21", "circlename" => "Uttar Pradesh - East"],
            ["circlecode" => "22", "circlename" => "Uttar Pradesh - West"],
            ["circlecode" => "35", "circlename" => "UTTARAKHAND"],
            ["circlecode" => "23", "circlename" => "West Bengal"],
        ];

        Circle::insert($data);
    }
}
