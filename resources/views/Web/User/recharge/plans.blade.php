@extends('Web.layout.main')

@section('content')
<style>
    .choose_plan-container {
    margin-top: 100px!important;
}
.details_user{
    color:white;
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
</style>

<div class="content-body">
    <div class="container choose_plan-container mt-5">
        <div class="row mt-5">
            <div class="col-12 text-center mb-3">
                <div class="card_top">
                    <div class="card_heading p-2 d-flex justify-content-between">
                        <div class="reharge_us d-flex">
                            <img src="{{ asset('path/to/logo.png') }}" width="50" height="50">
                            <div class="details_user ms-3">
                                <div class="btn-num">{{ $mobileNumber }}</div>
                                <div class="btn-num-2">{{ $circle ?? 'N/A' }}</div>
                                <div class="btn-num-3">{{ $operator ?? 'N/A' }}</div>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-light">Change</button>
                    </div>
                </div>
            </div>

            <div class="col-12 text-center">
                <!-- <div class="input-group_1 mb-2">
                    <div class="input-with-icon">
                        <input type="text" id="mobile-number" placeholder="Search or enter amount">
                        <span class="contact-icon"><i class="fa fa-search"></i></span>
                    </div>
                </div> -->

                <!-- Recharge Categories -->
                <div class="plan_choose">
                    <div class="btn-group scroll-right" role="group">
                        <button type="button" class="btn btn-primary filter-btn active" data-type="ALL">All</button>
                        @foreach(['TOPUP', 'PlanVoucher', 'FULLTT ', 'DATA','STV'] as $type)
                            <button type="button" class="btn btn-primary filter-btn" data-type="{{ $type }}">{{ $type }}</button>
                        @endforeach
                    </div>

                </div>

                <!-- Dynamic Plans -->
                <div class="row mt-3">
                @foreach($planVouchers as $plan)
    <div class="col-md-4 plan-card" data-type="{{ $plan['recharge_type'] }}">
        <div class="card p-3 mb-3">
            <h4>₹{{ $plan['recharge_amount'] }}</h4>
            <p class="validity">{{ $plan['recharge_validity'] }}</p>
            <p>{{ $plan['recharge_short_desc'] }}</p>
            <p class="cashback">Cashback: ₹{{ cashback_value('Prepaid-Mobile', 'Prepaid-Mobile', $plan['recharge_amount']) }}</p>
            <button class="btn btn-recharge">Recharge</button>
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
        document.querySelectorAll('.filter-btn').forEach(button => button.classList.remove('active'));
        this.classList.add('active');
    });
});

</script>
@endsection
