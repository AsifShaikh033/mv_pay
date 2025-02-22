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
    
    <form id="rechargeForm" action="{{ route('user.recharge.bill_plan') }}" method="POST">
    @csrf 
    <div class="input-section">
        <div class="input-group_1 mb-2">
       
            <div class="input-with-icon">
                <input type="text" id="bill-number" name="bill_number" placeholder="Enter Bill number" value="{{ old('bill_number') }}" required>
                <span class="contact-icon"><i class="fa fa-electric" aria-hidden="true"></i>
                </span>
            </div>
        </div>

        <div class="input-group_1 mb-2">
            <div class="input-with-icon">
                <input type="text" id="amount" name="amount" placeholder="Enter Amount" value="{{ old('amount') }}" > 
            </div>
        </div>
        
        <div class="input-group_1 mb-2">
            <div class="input-with-icon">
            <select name="operator" id="operator" class="form-control" required>
                <option value="">Select Operator</option>
                @foreach($Operator as $op)
                <option value="{{ $op->OperatorCode }}" {{ old('operator') == $op->OperatorCode ? 'selected' : '' }}>
                    {{ $op->OperatorName }}
                </option>
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
        <!-- Check Plans Button -->
        <div class="plans-button-container mt-4">
            <button  type="submit" class="check-plans-btn mt-3 text-decoration-none" >Checkout Plans & Offers</button>
            <!-- <button class="check-plans-btn" >Checkout Plans & Offers</button> -->
        </div>
    </div>
    </form>

    <div class="recent-recharges">
    <p>Recent or Personal Bill Recharges</p>
    <div class="recharge-history mt-3">
        <h6 class="fw-bold">Recent Bill Numbers</h6>
        <ul class="list-unstyled">
    @foreach($billNumbers as $number)
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
    $('#bill-number').val(selectedNumber).trigger('input');
    fetchOperatorAndCircle(selectedNumber);
   // console.log(selectedNumber);

});


function fetchOperatorAndCircle(billNumber) {
        $.ajax({
            url: "{{ route('billfetch.operator.circle') }}",
            type: "POST",
            data: {
                bill_number: billNumber,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status === 1) {
                    $('#operator').val(response.operator).change();
                    $('#circle').val(response.circle).change();
                }
            },
            // error: function(xhr) {
            //     if (xhr.responseJSON && xhr.responseJSON.error) {
            //         toastr.error(xhr.responseJSON.error.replace('mobile', 'Bill'), 'Error Alert', { timeOut: 8000 });
            //     } else {
            //         toastr.error('Invalid Bill number', 'Error', { timeOut: 8000 });
            //     }
            // }

        });
}

// Bind to keyup
// $('#bill-number').on('keyup', function() {
//     fetchOperatorAndCircle($(this).val());
// });


$('#bill-number').on('keyup', function() {
        let billNumber = $(this).val();

        if (billNumber === "") {
            return;
        }

        fetchOperatorAndCircle(billNumber);
    });

});
</script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/recharge.css') }}">
@endsection
