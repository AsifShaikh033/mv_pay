<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebConfig;
use App\Models\Banner;
// ReportController.php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function showReport($type)
    {
        $validRemarks = [
            'recharge_report' => ['recharge_deduct'],
            'customer_report' => ['reffrel_bonus'],
            'spin_report' => ['spin_win'],
            'wallet_report' => ['wallet_add'],
            'payment_report' => ['recharge_deduct','reffrel_bonus','spin_win','wallet_add']
        ];

       
        if (!isset($validRemarks[$type])) {
            abort(404); 
        }

        $remarks = $validRemarks[$type];

       
        $transactions = Transaction::whereIn('remark', $remarks)->get();

        $reportTitles = [
            'recharge_report' => 'Recharge recharge report',
            'customer_report' => 'Team recharge report',
            'spin_report' => 'Spin report',
            'wallet_report' => 'Bill payment report',
            'payment_report' => 'Other payment report',
        ];

        $reportTitle = $reportTitles[$type] ?? 'Report';
       return view('Web.User.report.show', compact('transactions', 'reportTitle'));
    }
}
