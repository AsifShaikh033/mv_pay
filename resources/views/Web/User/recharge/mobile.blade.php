@extends('Web.layout.main')

@section('content')
<style>
    /* public/css/recharge.css */

    .mobile-recharge-container {
    max-width: 500px;
    margin: 100px auto;
    padding: 20px;
    border-radius: 20px;
    border: 1px solid #ff66c4;
    background: linear-gradient(to right, black 0%, black 5%, blue 50%, black 95%, black 100%);
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
    background: linear-gradient(to right, #ff0033, #ff0066);
    color: white;
}

.input-section {
    margin-bottom: 20px;
    border-radius: 20px;
    padding: 15px;
    border: 2px solid white;
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
    color: white;
    border: 2px solid white;
    border-radius: 10px;
    background: linear-gradient(to right, black 0%, black 0%, blue 50%, black 100%, black 100%);
}

.input-with-icon select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 2px solid white;
    border-radius: 10px;
    background: linear-gradient(to right, black 0%, black 0%, blue 50%, black 100%, black 100%);
    color: white;
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
    background: linear-gradient(to right, #00ccff, #ff0066);
    color: white;
    border: none;
    border-radius: 13px;
    cursor: pointer;
    width: 100%;
}

.check-plans-btn:hover {
    background: linear-gradient(to right, #ff0033, #ff0066);
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
    background-color: transparent;
    border: none;
    border-bottom: 2px solid blue;
    color: blue;
    cursor: pointer;
    outline: none;
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
.recharge-history ul {
    padding: 0;
    margin: 0;
}

.recharge-history li {
    border: 1px solid white;
    background: linear-gradient(to right, black 0%, black 0%, blue 50%, black 100%, black 100%);
    color: white;
    padding: 8px 12px;
    border-radius: 5px;
    margin-bottom: 5px;
}

.history-btn {
    display: flex;
    align-items: center;
    background: linear-gradient(to right, #ff0033, #ff0066);
    color: white;
    border: 2px solid white;
    padding: 10px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: bold;
}

.history-btn i {
    margin-right: 10px;
}

button.prepaid-button {
    background: white;
    font-weight: bolder;
    border-radius: 10px;
    padding: 0px 10px 1px 10px;
    font-size: 30px;
    font-family: 'Flaticon';
}

.validity {
    display: flex;
    align-items: center;
    border: 2px solid white;
    background: black;
    color: white;
    border-radius: 10px;
}

.input-with-icon input::placeholder {
    color: white;
}

hr {
    height: 5px !important;
    background:  #ffde59;
}
</style>

<div class="content-body">
<div class="mobile-recharge-container ">
  
        <button class="prepaid-button ms-5">Prepaid</button>
    <hr>
    <form id="rechargeForm" action="{{ route('user.recharge.plan') }}" method="POST">
    @csrf 
    
    @if($planId)
        <input type="hidden" name="plan_id" value="{{ $planId }}">
    @endif
    <div class="input-section">
        <div class="input-group_1 mb-2">
            <div class="input-with-icon">
                <input type="text" id="mobile-number" name="mobile_number" placeholder="Enter mobile number" value="{{ old('mobile_number') }}" required>
                <span class="contact-icon"><i class="fa fa-address-book text-white" aria-hidden="true"></i></span>
            </div>
        </div>
        
        <div class="input-group_1 mb-2">
            <div class="input-with-icon">
                <select name="operator" id="operator" class="form-control" required>
                    <option value="">Select Operator</option>
                    @foreach($Operator as $op)
                        <option value="{{ $op->OperatorCode }}" {{ old('operator') == $op->OperatorCode ? 'selected' : '' }}>{{ $op->OperatorName }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="input-group_1 mb-2">
            <div class="input-with-icon">
                <select name="circle" id="circle" class="form-control" required>
                    <option value="">Select Circle</option>
                    @foreach($circle as $c)
                        <option value="{{ $c->circlecode }}" {{ old('circle') == $c->circlecode ? 'selected' : '' }}>{{ $c->circlename }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="validity">
            <img src="{{ asset('assets_web/images/wallet/13.png') }}" class="spin-img ms-3" style="width:10%!important;" alt="">
            <p class="m-auto fw-bold" style="word-spacing: 8px;">Spin & Earn upto ₹200</p>
        </div>
        <!-- Check Plans Button -->
        <div class="plans-button-container mt-4">
            <button type="submit" class="check-plans-btn mt-3 text-decoration-none">Checkout Plans & Offers</button>
        </div>
    </div>
</form>

<div class="recent-recharges">
    <!-- <p>Recent or Personal Recharges</p> -->
    <div class="recharge-history mt-3">
        <a href="#" class="history-btn mb-2"><i class="fa fa-address-book" aria-hidden="true"></i> Recent Numbers <i class="fa fa-download ms-2"></i></a>
        <ul class="list-unstyled">
    <li class="d-flex align-items-center gap-2 recent-number">
        <i class="fa fa-mobile" aria-hidden="true"></i>
        <span data-number="{{ auth()->user()->mob_number }}">{{ auth()->user()->mob_number }}</span>
    </li>
    @foreach($rechargeNumbers as $number)
        <li class="d-flex align-items-center gap-2 recent-number">
            <i class="fa fa-mobile" aria-hidden="true"></i>
            <span data-number="{{ $number->number }}">{{ $number->number }}</span>
        </li>
    @endforeach
</ul>

    </div>
</div>


</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    $('.recent-number span').on('click', function() {
    let selectedNumber = $(this).data('number');
    $('#mobile-number').val(selectedNumber).trigger('input');
    fetchOperatorAndCircle(selectedNumber);
   // console.log(selectedNumber);

});


function fetchOperatorAndCircle(mobileNumber) {
    if (/^\d{10}$/.test(mobileNumber)) {
        $.ajax({
            url: "{{ route('fetch.operator.circle') }}",
            type: "POST",
            data: {
                mobile_number: mobileNumber,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status === 1) {
                    $('#operator').val(response.operator).change();
                    $('#circle').val(response.circle).change();
                }
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    toastr.error(xhr.responseJSON.error, 'Error Alert', { timeOut: 8000 });
                } else {
                    toastr.error('Issue in Fetch Mobile details', 'Error', { timeOut: 8000 });
                }
            }
        });
   }
}

// Bind to keyup
$('#mobile-number').on('keyup', function() {
        let mobileNumber = $(this).val();

        if (mobileNumber === "") {
            return;
        }
        
        if (!/^\d+$/.test(mobileNumber)) {
            toastr.error('Invalid mobile number. Please enter only digits.', 'Error Alert', { timeOut: 5000 });
            return;
        }

        if (mobileNumber.length > 10) {
            toastr.error('Mobile number cannot exceed 10 digits.', 'Error Alert', { timeOut: 5000 });
            return;
        }

        if (mobileNumber.length === 10) {
            fetchOperatorAndCircle(mobileNumber);
        }
    });
    
// $('#mobile-number').on('keyup', function() {
//     fetchOperatorAndCircle($(this).val());
// });

});
</script>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/recharge.css') }}">
@endsection
