@extends('Web.layout.main')

@section('content')
<style>
    /* public/css/recharge.css */

.mobile-recharge-container {
    max-width: 500px;
    margin: 20px auto;
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
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: lightgray;
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
    background-color: #007B9E;
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



</style>

<div class="content-body">
<div class="mobile-recharge-container mt-5">
    <!-- Prepaid Button -->
  
        <button class="prepaid-button mb-3">Prepaid</button>
    
    
    <!-- Mobile Number Input Section -->
    <div class="input-section">
        <div class="input-group_1 mb-2">
       
            <div class="input-with-icon">
                <input type="text" id="mobile-number" name="mobile_number" placeholder="Enter mobile number" required>
                <span class="contact-icon">📞</span>
            </div>
        </div>
        
        <!-- Check Plans Button -->
        <div class="plans-button-container">
            <button class="check-plans-btn">Checkout Plans & Offers</button>
        </div>
    </div>

    <!-- Recent Recharges / Personal Recharges Section -->
    <div class="recent-recharges">
        <p>Recent or Personal Recharges</p>
       <div class="d-flex border py-2 px-2 rounded">
            <div>📞</div>
            <div>
                <h6>My Number</h6>
                <p>{{ auth()->user()->mobile_number }}</p>
            </div>
       </div>
    </div>

</div>
</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/recharge.css') }}">
@endsection
