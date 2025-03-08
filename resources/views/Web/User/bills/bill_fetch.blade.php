@extends('Web.layout.main')

@section('content')
<style>
    /* public/css/recharge.css */

    .mobile-recharge-container {
    max-width: 500px;
    margin: 100px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
}

.prepaid-button-container {
    text-align: center;
    margin-bottom: 20px;
}

.prepaid-button {
    padding: 10px 20px;
    font-size: 18px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.prepaid-button:hover {
    background-color: #45a049;
}

.input-section {
    margin-bottom: 20px;
}


.input-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.input-with-icon {
    position: relative;
}

.input-with-icon input {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid transparent;
    border-radius: 10px;
    background-color: #cfcbcb57;
}

.contact-icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    font-size: 20px;
}

.plans-button-container {
    text-align: center;
}

.check-plans-btn {
    padding: 12px 30px;
    font-size: 16px;
    background-color: #4c5985;
    color: white;
    border: none;
    border-radius: 13px;
    cursor: pointer;
    width: 100%;
}

.check-plans-btn:hover {
    background-color: #81014fc9;
    color: white;
}



.recharge-table {
    width: 100%;
    border-collapse: collapse;
}

.recharge-table th, .recharge-table td {
    padding: 8px 12px;
    text-align: center;
    border: 1px solid #ddd;
}

.recharge-table th {
    background-color: #f2f2f2;
}

.your-number-column {
    margin-top: 30px;
    text-align: center;
}

.checkout-btn-container {
    text-align: center;
    margin-top: 20px;
}

.checkout-btn {
    padding: 12px 30px;
    font-size: 18px;
    background-color: #f44336;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.checkout-btn:hover {
    background-color: #e53935;
}

/* public/css/recharge.css */

.prepaid-button {
    padding: 10px 20px;
    font-size: 18px;
    background-color: transparent; /* Make background transparent */
    border: none; /* Remove default border */
    border-bottom: 2px solid blue; /* Add a 2px solid blue bottom border */
    color: blue; /* Set the text color to blue */
    cursor: pointer;
    outline: none; /* Remove outline on focus */
    transition: all 0.3s ease; 
}

.recent-recharges p {
    font-size: 14px;
    font-weight: 600;
}


.my_num {
    background-color: #cfcbcb57;
    padding: 10px 0px 6px 10px;
    border-radius: 5px;
}

</style>

<div class="content-body">
<div class="mobile-recharge-container ">

        <button class="prepaid-button mb-3">Bills</button>
    
    <form id="rechargeForm" action="{{ route('user.recharge.bill_details') }}" method="POST">
    @csrf 
    <div class="input-section">
        <div class="input-group_1 mb-2">
            <div class="input-with-icon">
                <input type="text" id="bill-number" name="bill_number" placeholder="Enter Bill number" value="{{ old('bill_number') }}" required>
                <span class="contact-icon"><i class="fa fa-electric" aria-hidden="true"></i>
                </span>
            </div>
        </div>

        <input type="hidden" name="Key" value="{{ $key }}">  

        <input type="hidden" name="isOptional" value="False">        

        <div class="validity d-flex align-items-center">
                                <img src="{{ asset('assets_web/images/wallet/13.png') }}" class="spin-img" style="width:10%!important;height:10%!important;" alt="">
                                <p class="text-success m-auto fs-6">Spin And Earn Upto ₹20</p>
                                <!-- <button class="btn btn-sm btn-light mb-0" type="submit">show more</button> -->
                            </div>
        <!-- Check Plans Button -->
        <div class="plans-button-container mt-4">
            <button  type="submit" class="check-plans-btn mt-3 text-decoration-none" >Bill Pay</button>
            <!-- <button class="check-plans-btn" >Checkout Plans & Offers</button> -->
        </div>
    </div>
    </form>

</div>
</div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/recharge.css') }}">
@endsection
