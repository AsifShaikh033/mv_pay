@extends('Web.layout.main')

@section('content')
<style>
    .recharge-container {
        max-width: 400px;
        margin: auto;
        text-align: center;
        padding: 20px;
    }
    .info-box {
        background: #e8f5e9;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .info-box p {
        margin: 5px 0;
        font-size: 18px;
    }
    .pin-input {
        display: flex;
        justify-content: center;
        gap: 10px;
    }
    .pin-input input {
        width: 40px;
        height: 40px;
        text-align: center;
        font-size: 18px;
        border: 1px solid #ccc;
        border-radius: 8px;
    }
    .numpad {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-top: 20px;
    }
    .numpad button {
        padding: 15px;
        font-size: 18px;
        background: #2e7d32;
        color: #fff;
        border: none;
        border-radius: 8px;
    }
    .hidden { display: none; }


</style>
<div class="content-body">
    <div class="container choose_plan-container mt-5">
        <div class="recharge-container">
            <div class="info-box">
                <p><strong>Paid To:</strong>{{ $operator ?? 'N/A' }}</p>
                <p><strong>Amount:</strong>  ₹{{ $rechargeAmount ?? '0.00' }}</p>
            </div>
            <p class="text-success message-box">Enter 4 digits T-PIN</p>

            <form method="POST" action="{{ route('user.save.recharge.pin') }}" onsubmit="submitPin(event)">
                @csrf
                <input type="hidden" name="recharge_pin" id="recharge_pin" value="">
                <input type="hidden" name="forget_pin" id="forget_pin" value="0">
                <input type="hidden" name="operator" value="{{ $operator }}">
                <input type="hidden" name="recharge_amount" value="{{ $rechargeAmount }}">

                <input type="hidden" name="mobileNumber" value="{{ $data['mobileNumber'] }}">
                <input type="hidden" name="circle" value="{{ $data['circle'] }}">
                <input type="hidden" name="circleCode" value="{{ $data['circleCode'] }}">
                <input type="hidden" name="operator" value="{{ $data['operator'] }}">
                <input type="hidden" name="operatorCode" value="{{ $data['operatorCode'] }}">
                <input type="hidden" name="recharge_amount" value="{{ $data['rechargeAmount'] }}">
                <input type="hidden" name="recharge_validity" value="{{ $data['rechargeValidity'] }}">
                <input type="hidden" name="serviceType" value="{{ $data['serviceType'] }}">

                <div class="pin-input">
                    <input type="password" maxlength="1" oninput="moveToNext(this, 0)">
                    <input type="password" maxlength="1" oninput="moveToNext(this, 1)">
                    <input type="password" maxlength="1" oninput="moveToNext(this, 2)">
                    <input type="password" maxlength="1" oninput="moveToNext(this, 3)">
                </div>
                <p class="text-success message-box d-none">Enter New PIN</p>
                <a href="javascript:void(0)" class="text-danger" onclick=showMessage()>Forgot PIN</a>


                <div class="numpad">
                    <button type="button" onclick="addDigit(1)">1</button>
                    <button type="button" onclick="addDigit(2)">2</button>
                    <button type="button" onclick="addDigit(3)">3</button>
                    <button type="button" onclick="addDigit(4)">4</button>
                    <button type="button" onclick="addDigit(5)">5</button>
                    <button type="button" onclick="addDigit(6)">6</button>
                    <button type="button" onclick="addDigit(7)">7</button>
                    <button type="button" onclick="addDigit(8)">8</button>
                    <button type="button" onclick="addDigit(9)">9</button>
                    <button type="button" onclick="deleteDigit()">⌫</button>
                    <button type="button" onclick="addDigit(0)">0</button>
                    <button type="submit">Enter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const inputs = document.querySelectorAll('.pin-input input');
    let currentInput = 0;

    function addDigit(digit) {
        if (currentInput < inputs.length) {
            inputs[currentInput].value = digit;
            currentInput++;
        }
        updateHiddenPin();
    }

    function deleteDigit() {
        if (currentInput > 0) {
            currentInput--;
            inputs[currentInput].value = '';
        }
        updateHiddenPin();
    }

    function moveToNext(input, index) {
        if (input.value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
        updateHiddenPin();
    }

    function updateHiddenPin() {
        const pin = Array.from(inputs).map(input => input.value).join('');
        document.getElementById('recharge_pin').value = pin;
        console.log('Updated PIN:', pin);
    }

    function submitPin(event) {
        updateHiddenPin();
        const pin = document.getElementById('recharge_pin').value;
        if (!/^\d{4}$/.test(pin)) {
            event.preventDefault();
            alert('Please enter a 4-digit PIN');
        } else {
            console.log('PIN submitted:', pin);
        }
    }

  function showMessage() {

        $('.message-box').removeClass('d-none');
        $('#forget_pin').val('1');
        
    };

</script>


@endsection