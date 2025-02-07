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
    <!-- Prepaid Button -->
  
        <button class="prepaid-button mb-3">Prepaid</button>
    
    
    <!-- Mobile Number Input Section -->
    <form id="rechargeForm" action="{{ route('user.recharge.plan') }}" method="POST">
    @csrf 
    <div class="input-section">
        <div class="input-group_1 mb-2">
            <div class="input-with-icon">
                <input type="text" id="mobile-number" name="mobile_number" placeholder="Enter mobile number" required>
                <span class="contact-icon"><i class="fa fa-address-book" aria-hidden="true"></i></span>
            </div>
        </div>
        
        <div class="input-group_1 mb-2">
            <div class="input-with-icon">
                <select name="operator" id="operator" class="form-control" required>
                    <option value="">Select Operator</option>
                    @foreach($Operator as $op)
                        <option value="{{ $op->OperatorCode }}">{{ $op->OperatorName }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="input-group_1 mb-2">
            <div class="input-with-icon">
                <select name="circle" id="circle" class="form-control" required>
                    <option value="">Select Circle</option>
                    @foreach($circle as $c)
                        <option value="{{ $c->circlecode }}">{{ $c->circlename }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Check Plans Button -->
        <div class="plans-button-container mt-4">
            <button type="submit" class="check-plans-btn mt-3 text-decoration-none">Checkout Plans & Offers</button>
        </div>
    </div>
</form>

    <!-- Recent Recharges / Personal Recharges Section -->
    <div class="recent-recharges">
        <p>Recent or Personal Recharges</p>
       <div class="d-flex gap-2 my_num">
            <div><i class="fa fa-mobile" aria-hidden="true"></i>
            </div>
            <div>
                <h6 class="fw-bold">My Number</h6>
                <p>{{ auth()->user()->mobile_number }}</p>
            </div>
       </div>
    </div>

</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#mobile-number').on('keyup', function() {
        let mobileNumber = $(this).val();

        if (mobileNumber.length === 10) {
            $.ajax({
                url: "{{ route('fetch.operator.circle') }}",
                type: "POST",
                data: {
                    mobile_number: mobileNumber,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.operator) {
                        $('#operator').val(response.operator);
                    }
                    if (response.circle) {
                        $('#circle').val(response.circle);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON);
                    $('#operator').val('');
                    $('#circle').val('');
                }
            });
        }
    });
});
</script>
@endsection



@section('styles')
    <link rel="stylesheet" href="{{ asset('css/recharge.css') }}">
@endsection
