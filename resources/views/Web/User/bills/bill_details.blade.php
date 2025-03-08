@extends('Web.layout.main')

@section('content')
<style>
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
        background-color: transparent;
        border: none;
        border-bottom: 2px solid blue;
        color: blue;
        cursor: pointer;
        outline: none;
        transition: all 0.3s ease;
    }

    .input-section {
        margin-bottom: 20px;
    }

    .input-with-icon {
        position: relative;
        margin-bottom: 10px;
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
</style>

<div class="content-body">
    <div class="mobile-recharge-container">
        <button class="prepaid-button mb-3">Bills</button>

        <form id="rechargeForm" action="{{ route('user.recharge.bill_fetch') }}" method="POST">
            @csrf
            <div class="input-section"> 
                <div class="input-with-icon">
                    <input type="text" id="customer-name" name="customer_name" placeholder="Customer Name" value="{{ old('customer_name') }}" required>
                    <span class="contact-icon"><i class="fa fa-electric" aria-hidden="true"></i></span>
                </div>

                <div class="input-with-icon">
                    <input type="text" id="due-amount" name="due_amount" placeholder="Due Amount" value="{{ old('due_amount') }}" required>
                    <span class="contact-icon"><i class="fa fa-electric" aria-hidden="true"></i></span>
                </div>

                <div class="input-with-icon">
                    <input type="text" id="due-date" name="due_date" placeholder="Due Date" value="{{ old('due_date') }}" required>
                    <span class="contact-icon"><i class="fa fa-electric" aria-hidden="true"></i></span>
                </div>

                <div class="input-with-icon">
                    <input type="text" id="bill-number" name="bill_number" placeholder="Bill Number" value="{{ old('bill_number') }}">
                </div>

                <div class="input-with-icon">
                    <input type="text" id="bill-date" name="bill_date" placeholder="Bill Date" value="{{ old('bill_date') }}">
                </div>

                <div class="input-with-icon">
                    <input type="text" id="bill-period" name="bill_period" placeholder="Bill Period" value="{{ old('bill_period') }}">
                </div>
            </div>

            <div class="plans-button-container mt-4">
                <button type="submit" class="check-plans-btn mt-3">Pay Bill</button>
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
    });

    function fetchOperatorAndCircle(billNumber, operator = '') {
        $.ajax({
            url: "{{ route('billfetch.operator.circle') }}",
            type: "POST",
            data: {
                bill_number: billNumber,
                operator: operator,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.status === 1) {
                    $('#operator').val(response.operator).change();
                    $('#circle').val(response.circle).change();
                    $('#amount').val(response.amount);
                }
            },
            error: function(xhr) {
                let errorMessage = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : 'Issue in fetching mobile details';
                toastr.error(errorMessage, 'Error', { timeOut: 8000 });
            }
        });
    }

    $('#bill-number').on('keyup', function() {
        let billNumber = $(this).val();
        let operator = $('#operator').val();
        if (billNumber && operator) {
            fetchOperatorAndCircle(billNumber, operator);
        }
    });
});
</script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/recharge.css') }}">
@endsection
