@extends('Web.layout.main')

@section('content')
<style>
    .choose_plan-container {
    margin-top: 100px!important;
}
.details_user {
    color: white;
    text-align: left;
}
.reharge_us {
    display: flex;
    align-content: center;
    align-items: center;
    justify-content: space-between;
}

.validity {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    align-content: flex-start;
}
@media screen and (max-width: 500px) {
    .details_user {
        font-size: x-small;
    }
    .validity_desc {
    font-size: small;
    text-align: left;
}
}
    .jio-logo { width: 100px; margin-bottom: 20px; }
    .plan-card { border-radius: 5px; padding: 20px; margin-bottom: 20px; text-align: center; }
    .plan-card h4 { font-size: 24px; margin-bottom: 10px; font-weight: bold; }
    .plan-card p { margin-bottom: 5px; font-size: 16px; }
    .plan-card .validity { color: #555; font-size: 14px; margin-bottom: 10px; }
    .card { border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); margin-top: 20px; }
    .btn-recharge { background-color: #28a745; color: white; font-size: 1.1rem; border-radius: 25px; padding: 10px 30px; margin-top: 20px; }
    .btn-recharge:hover { background-color: #218838; }
    .card_top { padding: 20px; background: radial-gradient(circle at left, black, #000033, #000099, #0000cc, #0000ff); border-radius: 20px; }
    .validity_1 p { font-size: 20px; font-weight: 600; color: #ffffff; margin-bottom: 0px; }
    .plan_choose { overflow-x: auto; white-space: nowrap; -webkit-overflow-scrolling: touch; }
    .scroll-right { display: flex; gap: 10px; }
    .btn-group .btn.active, .btn-group .btn:focus, .btn-group .btn:hover { background-color: #007bff; color: white; }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.spin-animation {
    animation: spin 1s linear;
}

img.spin-img {
    cursor: pointer;
}
</style>

<div class="content-body">
    <div class="container choose_plan-container mt-5">
        <div class="row mt-5">
            <div class="col-12 text-center mb-3">
                <div class="card_top">
                    <div class="card_heading p-2 reharge_us">
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
                        <div class="reharge_us">
                            <!-- <img src="{{ asset('path/to/logo.png') }}" width="50" height="50"> -->
                            <img src="{{ $operatorLogo }}" alt="{{ $operator }}" width="50" height="50" style="border-radius: 30px;">
                            <div class="details_user ms-3">
                                <div class="btn-num">{{ $mobileNumber }}</div>
                                <div class="btn-num-2">{{ $circle ?? 'N/A' }}</div>
                                <div class="btn-num-3">{{ $operator ?? 'N/A' }}</div>
                            </div>
                        </div>
                       <!-- <button class="btn btn-sm btn-light">Change</button> -->
                        <a href="{{ route('user.recharge.mobile') }}"><button class="btn btn-sm btn-light">Change</button></a>

                    </div>
                </div>
            </div>

            <div class="col-12 text-center">
                <div class="input-group_1 mb-2">
                    <div class="input-with-icon">
                        <input type="text" id="mobile-number" placeholder="Search or enter amount" onkeyup="filterPlans()" class="form-control me-2">
                        <!-- <span class="contact-icon"><i class="fa fa-search"></i></span> -->
                    </div>
                </div>

                <!-- Recharge Categories -->
                <div class="plan_choose">
                    <div class="btn-group scroll-right" role="group">
                        <button type="button" class="btn btn-primary filter-btn active" data-type="ALL">All</button>
                        @php
                            $rechargeTypes = collect($plans)->pluck('recharge_type')->unique();
                        @endphp
                        @foreach($rechargeTypes as $type)
                            <button type="button" class="btn btn-primary filter-btn" data-type="{{ $type }}">{{ $type }}</button>
                        @endforeach
                        <!-- @foreach(['TOPUP', 'PlanVoucher', 'FULLTT ', 'DATA','STV'] as $type)
                            <button type="button" class="btn btn-primary filter-btn" data-type="{{ $type }}">{{ $type }}</button>
                        @endforeach -->
                    </div>

                </div>

                <!-- Dynamic Plans -->
                <div class="row mt-3">
                @foreach($plans as $plan)
                    <div class="col-md-4 plan-card" data-type="{{ $plan['recharge_type'] }}" data-amount="{{ $plan['recharge_amount'] }}">
                        <div class="card p-3 mb-3">
                            <h4>₹{{ $plan['recharge_amount'] }}</h4>
                            <p class="validity">{{ $plan['recharge_validity'] }}</p>
                            <p class="validity_desc">{{ $plan['recharge_short_desc'] }}</p>
                            <!-- <p class="cashback">Cashback: ₹{{ cashback_value('Prepaid-Mobile', 'Prepaid-Mobile', $plan['recharge_amount']) }}</p> -->
                            <div class="validity d-flex align-items-center">
                                <img src="{{ asset('assets_web/images/wallet/13.png') }}" class="spin-img" style="width:20%!important;height:20%!important;" alt="">
                                <p class="text-success m-auto">Spin UPTO ₹200</p>
                                <!-- <p class="text-success m-auto">RECEIVE LUCKY SPIN CHANCE TO COLLECT UPTO 200₹ IN YOUR BANK ON EVERY RECHARGE OR BILL PAYMENT.</p> -->
                                <!-- <button class="btn btn-sm btn-light mb-0" type="submit">show more</button> -->
                            </div>
                            <form id="rechargeForm" action="{{ route('user.recharge.process') }}" method="POST">
                                @csrf
                                <input type="hidden" name="mobileNumber" value="{{ $mobileNumber }}">
                                <input type="hidden" name="circle" value="{{ $circle }}">
                                <input type="hidden" name="circleCode" value="{{ $circleCode }}">
                                <input type="hidden" name="operator" value="{{ $operator }}">
                                <input type="hidden" name="operatorCode" value="{{ $operatorCode }}">
                                <input type="hidden" name="recharge_amount" value="{{ $plan['recharge_amount'] }}">
                                <input type="hidden" name="recharge_validity" value="{{ $plan['recharge_validity'] }}">
                                @if($planId)
                                    <input type="hidden" name="plan_id" value="{{ $planId }}">
                                @endif
                                <button type="submit" class="btn btn-recharge">Recharge</button>
                            </form>

                            <!-- <a href="{{ route('user.recharge.process', ['mobileNumber' => $mobileNumber, 'circle' => $circle, 'operator' => $operator]) }}">
                                <button class="btn btn-recharge">Recharge</button>
                            </a> -->


                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        let type = this.dataset.type;
        
        document.querySelectorAll('.plan-card').forEach(card => {
            card.style.display = (type === 'ALL' || card.getAttribute('data-type') === type) ? 'block' : 'none';
        });

        // Remove active class from all buttons and add it to the clicked one
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.classList.remove('active', 'btn-success');
            button.classList.add('btn-primary'); 
        });
        
        this.classList.add('active', 'btn-success');
        this.classList.remove('btn-primary');
    });
});

</script>


<script>
document.querySelectorAll('.btn-recharge').forEach(button => {
    button.addEventListener('click', function() {
        let mobileNumber = this.getAttribute('data-mobile');
        let circle = this.getAttribute('data-circle');
        let operator = this.getAttribute('data-operator');

        fetch("{{ route('user.recharge.process') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({
                mobileNumber: mobileNumber,
                circle: circle,
                operator: operator
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            alert("Recharge successful!");
        })
        .catch(error => console.error("Error:", error));
    });
});
</script>


<script>
document.querySelectorAll('.spin-img').forEach(img => {
    img.addEventListener('click', function() {
        this.classList.add('spin-animation');
        
        // Remove the animation class after it completes (1s) to allow re-clicking
        setTimeout(() => {
            this.classList.remove('spin-animation');
        }, 1000);
    });
});
</script>


<script>
function filterPlans() {
    let input = document.getElementById('mobile-number').value.toLowerCase();
    let plans = document.getElementsByClassName('plan-card');

    console.log("Search input:", input); // Check input value

    for (let i = 0; i < plans.length; i++) {
        let amount = plans[i].getAttribute('data-amount');
        console.log("Plan amount:", amount); // See if data-amount exists
        
        if (amount && amount.toLowerCase().includes(input)) {
            plans[i].style.display = "block";
        } else {
            plans[i].style.display = "none";
        }
    }
}
</script>

@endsection
