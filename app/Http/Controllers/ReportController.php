<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebConfig;
use App\Models\Banner;
use App\Models\Transaction;
use App\Models\Recharge;
use Illuminate\Support\Facades\Auth;

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

    $userId = Auth::id();

    // Start the query
    $query = Recharge::join('users', 'users.id', '=', 'recharges.user_id')
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
        ->where('recharges.user_id', $userId)
        ->whereIn('recharges.status', ['pending', 'success', 'failed'])
        ->orderBy('recharges.created_at', 'desc');

    // Apply filter only for 'customer_report'
    if ($type === 'customer_report') {
        $query->where('users.referred_by', 1);
    }
    if ($type === 'wallet_report') {
        $query->where(function ($q) {
            $q->whereIn('recharges.operator', [
                'DTH', 'Electricity', 'Broadband', 'GAS', 'Insurance', 'DMR', 'Water', 'PAN UTI - Token Based',
                'Loan Repayment', 'Prepaid Meter', 'NCMC Recharge', 'Donation', 'Hospital and Pathology', 'Rental',
                'Recurring Deposit', 'Google Play', 'Fastag', 'Axis Bank Saving A/c', 'Broadband Postpaid',
                'Clubs and Associations', 'IRCTC - Dongle Based', 'OTT Subscription', 'PayService', 'Credit Card',
                'Subscription', 'Hospital', 'Cable TV', 'LPG Gas', 'Health Insurance', 'Municipal Taxes',
                'Housing Society', 'Life Insurance', 'Municipal Services', 'CHALLAN', 'METRO CARD RECHARGE',
                'Education Fees'
            ])
            ->orWhereNotIn('recharges.operator', ['Airtel', 'Idea', 'Jio', 'BSNL', 'Vi']);
        });
    } 
    
    if ($type === 'payment_report') {
        $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')
            ->select(
                'transactions.*',
                'users.name as user_name'
            )
            ->where('transactions.user_id', $userId)
            ->orderBy('transactions.created_at', 'desc')
            ->get();

        $reportTitle = $validTypes[$type];

        return view('Web.User.report.payment', compact('transactions', 'reportTitle'));
    }


    if ($type === 'spin_report') {
        $transactions = Transaction::join('users', 'users.id', '=', 'transactions.user_id')
            ->select(
                'transactions.*',
                'users.name as user_name'
            )
            ->where('transactions.user_id', $userId)
            ->where('transactions.remark', 'spin_win')
            ->orderBy('transactions.created_at', 'desc')
            ->get();
    
        $reportTitle = $validTypes[$type];
    
        return view('Web.User.report.spin', compact('transactions', 'reportTitle'));
    }
    

    // Fetch the results
    $recharges = $query->get();

    $reportTitle = $validTypes[$type];

    $views = [
        'recharge_report' => 'Web.User.report.show',
        'customer_report' => 'Web.User.report.customer',
        'spin_report' => 'Web.User.report.spin',
        'wallet_report' => 'Web.User.report.wallet',
        'payment_report' => 'Web.User.report.payment',
    ];

    return view($views[$type], compact('recharges', 'reportTitle'));

        // return view('Web.User.report.show', compact('recharges', 'reportTitle'));
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
