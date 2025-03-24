@extends('Web.layout.main')

@section('content')
<style>
    .recharge-container {
        max-width: 400px;
        margin: auto;
        text-align: center;
        padding: 20px;
        background: linear-gradient(to right, black, blue);
        border-radius: 25px;
        text-align: center;
        margin-top: 105px;
    }
    .info-box {
        background: linear-gradient(to right, #000000, #0000ff, #000099);
        border: 2px solid white;
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
    /* gap: 10px; */
    gap: 18px;
}

.pin-spin {
    display: flex;
    justify-content: space-evenly;
    gap: 10px;
    gap: 31px;
    margin-bottom: 10px;
}

.pin-input input {
    /* width: 40px; */
    width: 100%;
    /* height: 40px; */
    height: 35px;
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
    align-items: center;
    justify-items: center;
}
    .numpad button {
        /* padding: 15px; */
        font-size: 18px;
        /* background: #2e7d32; */
        color: #fff;
        border: none;
        /* border-radius: 8px; */
        
        background:linear-gradient(45deg, #05004a, #0c00b3, #040040);
    border-radius: 54px;
    width: 69px;
    padding: 6px;
    border: 2px solid white;
    }
    .hidden { display: none; }
    .pin_title{
        border: 2px solid white;
    width: 293px;
    height: 38px;
    border-radius: 15px;
    color: #fff !important;
    }

.design_plan{
    display:none;
}

    .reachrge_banner {
            width: 300px;
            background: #0000ff;
            color: #fff;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .header_banner_new {
            text-align: center;
            border: 2px solid #fff;
            border-radius: 13px;
            padding: 12px 0;
            margin: 0;
            margin-bottom: 5px;
        }
        .header_banner_new img {
            width: 100%;
        }
        .header_banner_new h2, .header_banner_new h3, .header_banner_new h4 {
            margin-bottom: 2px;
            font-size: 20px;
            color: #fff;
            text-align: left;
        }
        .box_banner_new {
            color: #fff;
            margin: 5px 0;
            border-radius: 7px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 2px solid #fff;
            padding: 5px 10px;
            text-align: left;
            margin-top: 5px;
            font-weight: 600;
        }
        .benefits {
            font-size: 14px;
        }
        .wallet_banner {
            padding: 10px;
            border-radius: 5px;
        }
        .highlight {
            background: #8fff00;
            font-weight: bold;
            color: #000;
        }
        .button_confirm_new {
            background: #01ff85;
            text-align: center;
            padding: 7px 12px;
            margin: 10px 0;
            cursor: pointer;
            font-size: 19px;
            color: #000;
            text-decoration: none;
            border-radius: 20px;
        }
        

</style>
<div class="content-body">
    <div class="container choose_plan-container mt-5">
              


        <div class="recharge-container banner_design">
           <div class="">
                <div class="header_banner_new row align-items-center">
                    <div class="col-4"><img src="{{ asset('assets/operators/electricity.png') }}" alt="Electricity Logo"></div>
                    <div class="col-8 ps-0">  <h2>{{ $customerDetails['bill_number'] ?? old('bill_number') }}</h2>
                        <h3>{{ $data['operator'] ?? 'N/A' }}</h3>
                        <h4>{{ $data['serviceType'] ?? 'N/A' }}</h4>
                    </div>
                </div>
                <div class="box_banner_new font-bold">
                    <span>Bill Amount</span>
                    <span> {{ $customerDetails['due_amount'] ?? old('due_amount') }} RS</span>
                </div>
                <div class="box_banner_new wallet_banner d-block">
                     <p class="d-flex justify-content-around align-items-center mb-1"><span> Customer Name</span><span> {{ $customerDetails['customer_name'] ?? old('customer_name') }} </span></p>
                    <p class="d-flex justify-content-around align-items-center mb-1"><span> Wallet Balance</span><span> {{ Auth::user()->balance }} RS</span></p>
                    <p class="d-flex justify-content-around align-items-center mb-1"><span> Bill Date</span><span> {{ $customerDetails['bill_date'] ?? old('bill_date') }} </span></p>
                    <p class="d-flex justify-content-around align-items-center mb-1"><span> Due Date</span><span> {{ $customerDetails['due_date'] ?? old('due_date') }} </span></p>
                    <p class="d-flex justify-content-around align-items-center mb-1"><span> Bill Period</span><span> {{ $customerDetails['bill_period'] ?? old('bill_period') }} </span></p>
                </div>

                <div class="box_banner_new  highlight justify-content-around">
                    <span >  Payable Amount</span> <span>= {{ $customerDetails['due_amount'] ?? old('due_amount') }}  RS</span>
                </div>

                <div class="box_banner_new" style="border:0;">
                    <span> <img src="{{ asset('assets_web/images/wallet/13.png') }}" class="spin-img" height="25" width="25"  alt=""> Spin & Earn </span> <span>Upto ₹20</span>
                </div>
                <a href="javascript:void(0);" class="button_confirm_new">Confirm to Pay</a>
             
            </div>
        </div>


        <div class="recharge-container design_plan">
            <div class="info-box">
                <p class="text-white"><strong class="text-white">Paid To:  </strong>{{ $data['operator'] ?? 'N/A' }}</p>
                <p class="text-white"><strong class="text-white">Amount:  </strong>  ₹{{ $customerDetails['due_amount'] ?? '0.00' }}</p>
            </div>
            

            <h4 class="text-success pin_title m-auto">Enter 4 Digits MV-PIN</h4>
            <div class="ms-3 mt-3">
            <form method="POST" action="{{ route('user.recharge.bill_plan') }}" onsubmit="submitPin(event)">
                @csrf
                <!-- <input type="hidden" name="bill_number" value="{{ $customerDetails['bill_number'] ?? old('bill_number') }}"> -->
                <input type="hidden" name="bill_number" value="{{ request('bill_number') ?? old('bill_number') }}">
                <input type="hidden" name="circle" value="{{ $data['circle'] ?? old('circle') }}">
                <input type="hidden" name="recharge_amount" value="{{ $customerDetails['due_amount'] ?? old('due_amount') }}">
                <input type="hidden" name="mode" value="{{ $mode }}">

                <div class="pin-spin">
                    <img src="{{ asset('assets_web/images/wallet/13.png') }}" class="spin-img" style="width:25px!important;height:25px!important;" alt="">
                    <img src="{{ asset('assets_web/images/wallet/13.png') }}" class="spin-img" style="width:25px!important;height:25px!important;" alt="">
                    <img src="{{ asset('assets_web/images/wallet/13.png') }}" class="spin-img" style="width:25px!important;height:25px!important;" alt="">
                    <img src="{{ asset('assets_web/images/wallet/13.png') }}" class="spin-img" style="width:25px!important;height:25px!important;" alt="">
                </div>
                <div class="pin-input">
                    <input type="password" maxlength="1" oninput="moveToNext(this, 0)">
                    <input type="password" maxlength="1" oninput="moveToNext(this, 1)">
                    <input type="password" maxlength="1" oninput="moveToNext(this, 2)">
                    <input type="password" maxlength="1" oninput="moveToNext(this, 3)">
                </div>
                <p class="text-success message-box d-none">Enter New PIN</p>
                


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

    document.addEventListener('DOMContentLoaded', function() {
    const button = document.querySelector('.button_confirm_new');
    const banner = document.querySelector('.banner_design');
    const designPlan = document.querySelector('.design_plan');

    button.addEventListener('click', function() {
        designPlan.style.display = 'block';
        banner.style.display = 'none';
    });
});


</script>
<script>
    function toggleReadMore() {
        const shortDesc = document.getElementById('short-desc');
        const fullDesc = document.getElementById('full-desc');
        const readMoreText = document.getElementById('read-more-text');

        if (shortDesc.style.display === 'none') {
            shortDesc.style.display = 'inline';
            fullDesc.style.display = 'none';
            readMoreText.textContent = 'Read more';
        } else {
            shortDesc.style.display = 'none';
            fullDesc.style.display = 'inline';
            readMoreText.textContent = 'Read less';
        }
    }
</script>


@endsection