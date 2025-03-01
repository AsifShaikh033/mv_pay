@extends('Web.layout.main')

@section('content')
<style>
        .recharge-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            width: 90%;
            max-width: 400px;
        }
        .operator-logo img {
            width: 60px;
            height: 60px;
        }
        .phone-number {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
        }
        .amount {
            background: #eafbe4;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 18px;
        }
        .confirmation-text {
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
        }
        .recharge-btn {
            background: #4CAF50;
            color: white;
            padding: 10px 0;
            border-radius: 10px;
            width: 100%;
            font-weight: bold;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: #4CAF50;
            cursor: pointer;
        }
</style>
<div class="content-body">
    <div class="container choose_plan-container mt-5">
    <div class="recharge-container">
        <span class="close-btn">&times;</span>
        @php
            $operators = [
                'Airtel' => 'airtel.png',
                'Idea' => 'idea.png',
                'Reliance Jio' => 'jio.png',
                'BSNL TopUp' => 'bsnl.png',
                'VI' => 'vi.png',
                'DTH' => 'dth.png',
                'Electricity' => 'electricity.png',
                'Hospital' => 'hospital.png',
                'Loan Repayment' => 'loan.png',
                'LPG Gas' => 'lpg.png',
                'Municipal Services' => 'municipal.png',
                'Municipal Taxes' => 'municipal.png',
                'Education Fees' => 'education.png'
            ];

            $operatorLogo = isset($operators[$operator]) 
                ? asset('assets/operators/' . $operators[$operator]) 
                : asset('assets/operators/default.png');
        @endphp
        <form id="rechargeForm" action="{{ route('user.recharge.process') }}" method="POST">
        @csrf
                <input type="hidden" name="mobileNumber" value="{{ $rechargeData['mobileNumber'] }}">
                <input type="hidden" name="circle" value="{{ $rechargeData['circle'] }}">
                <input type="hidden" name="circleCode" value="{{ $rechargeData['circleCode'] }}">
                <input type="hidden" name="operator" value="{{ $rechargeData['operator'] }}">
                <input type="hidden" name="operatorCode" value="{{ $rechargeData['operatorCode'] }}">
                <input type="hidden" name="recharge_amount" value="{{ $rechargeData['rechargeAmount'] }}">
                <input type="hidden" name="recharge_validity" value="{{ $rechargeData['recharge_validity'] ?? '' }}">
                <input type="hidden" name="plan_id" value="{{ $rechargeData['plan_id'] ?? '' }}">
            
                @if($planId)
                    <input type="hidden" name="plan_id" value="{{ $planId }}">
                @endif
        <div class="operator-logo">
        <img src="{{ $operatorLogo }}" alt="{{ $operator }}" width="50" height="50" style="border-radius: 30px;">
        </div>
        <div class="phone-number">{{ $rechargeData['mobileNumber'] ?? '' }}</div>
        <div class="amount">&#8377;  {{ $rechargeData['rechargeAmount'] ?? '0.00' }}</div>
        <div class="confirmation-text">
            Please confirm the prepaid recharge details, including balance, validity, and available offers, with the operator once.
        </div>
        <button class="recharge-btn">Recharge</button>
        </form>
    </div>
    </div>
</div>

@endsection