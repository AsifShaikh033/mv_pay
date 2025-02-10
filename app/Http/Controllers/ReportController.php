<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebConfig;
use App\Models\Banner;
use App\Models\Transaction;
use App\Models\Recharge;

class ReportController extends Controller
{
    public function showReport($type)
    {
        $validTypes = [
            'recharge_report' => 'Recharge Report',
            'customer_report' => 'Customer Report',
            'spin_report' => 'Spin Report',
            'wallet_report' => 'Wallet Report',
            'payment_report' => 'Payment Report',
        ];

        if (!isset($validTypes[$type])) {
            abort(404);
        }

        // Fetch only required fields from 'recharges' table
        $recharges = Recharge::whereIn('recharges.status', ['pending', 'success', 'failed'])
        ->join('users', 'users.id', '=', 'recharges.user_id')
        ->select(
            'recharges.id',
            'recharges.user_id',
            'users.name as user_name',
            'recharges.number',
            'recharges.operator',
            'recharges.circle',
            'recharges.amount',
            'recharges.user_tx',
            'recharges.status',
            'recharges.created_at'
        )
        ->orderBy('recharges.created_at', 'desc')
        ->get();

        $reportTitle = $validTypes[$type];

        return view('Web.User.report.show', compact('recharges', 'reportTitle'));
    }


    // public function showReport($type)
    // {
    //     $validRemarks = [
    //         'recharge_report' => ['recharge_deduct'],
    //         'customer_report' => ['reffrel_bonus'],
    //         'spin_report' => ['spin_win'],
    //         'wallet_report' => ['wallet_add'],
    //         'payment_report' => ['recharge_deduct','reffrel_bonus','spin_win','wallet_add']
    //     ];

       
    //     if (!isset($validRemarks[$type])) {
    //         abort(404); 
    //     }

    //     $remarks = $validRemarks[$type];

       
    //     $transactions = Transaction::whereIn('remark', $remarks)->get();

    //     $reportTitles = [
    //         'recharge_report' => 'Recharge recharge report',
    //         'customer_report' => 'Team recharge report',
    //         'spin_report' => 'Spin report',
    //         'wallet_report' => 'Bill payment report',
    //         'payment_report' => 'Other payment report',
    //     ];

    //     $reportTitle = $reportTitles[$type] ?? 'Report';
    //    return view('Web.User.report.show', compact('transactions', 'reportTitle'));
    // }


}
