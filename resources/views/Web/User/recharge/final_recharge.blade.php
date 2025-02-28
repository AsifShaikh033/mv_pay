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
        <div class="operator-logo">
            <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/2/21/Jio_Logo.png" alt="Jio Logo"> -->
        </div>
        <div class="phone-number">+91 9340029158</div>
        <div class="amount">&#8377; 249</div>
        <div class="confirmation-text">
            Please confirm the prepaid recharge details, including balance, validity, and available offers, with the operator once.
        </div>
        <button class="recharge-btn">Recharge</button>
        
    </div>
    </div>
</div>

@endsection