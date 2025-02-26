@extends('Web.layout.main')

@section('content')
<style>
.jio-logo {
    width: 100px;
    margin-bottom: 20px;
}

.plan-card {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
    text-align: center;
}

.plan-card h4 {
    font-size: 24px;
    margin-bottom: 10px;
    font-weight: bold;
}

.plan-card p {
    margin-bottom: 5px;
    font-size: 16px;
}

.plan-card .validity {
    color: #555;
    font-size: 14px;
    margin-bottom: 10px;
}

.data-info {
    display: flex;
    justify-content: center;
    align-items: center;
}

.data-info img {
    width: 20px;
    margin-right: 5px;
}

.card {
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}
.reharge_us {
    display: flex;
}


.card-body {
    text-align: center;
}

.plan-price {
    font-size: 25px;
    font-weight: bold;
    color: black;
}

.plan-details {
    color: #00050a;
    font-size: 14px;
    font-weight: 600;
}

.btn-recharge {
    background-color: #28a745;
    color: white;
    font-size: 1.1rem;
    border-radius: 25px;
    padding: 10px 30px;
    margin-top: 20px;
}

.btn-recharge:hover {
    background-color: #218838;
}

.validity {
    display: flex;
    align-items: center;
    
    font-size: 20px;
    justify-content: space-between;
}
.validity_1 {
    display: flex;
    align-items: center;
    
    font-size: 20px;
    justify-content: space-between;
}

.card_top {
    padding: 20px;
    background: radial-gradient(circle at left, black, #000033 12%, #000066 19%, #000099 48%, #0000cc 58%, #0000ff);
    border-radius: 20px;
}

.validity_1 p {
    font-size: 20px;
    font-weight: 600;
    color: #ffffff;
    margin-bottom: 0px;
}

.validity p {
    font-size: 10px;
    font-weight: 600;
    color: green;
    margin-bottom: 0px;
}

.plans_value {
    color: grey;
    font-size: 10px;
    font-weight: 400;
}
.choose_plan-container{
    padding: 20px;
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

.plan_choose .btn-group .btn {
            border-radius: 25px;
            margin-right: 10px; /* Adding gap between buttons */
        }

        .plan_choose .btn-group .btn:last-child {
            margin-right: 0; /* Removing the margin from the last button */
        }

        /* Custom active button color */
        .btn-group .btn.active, .btn-group .btn:focus, .btn-group .btn:hover {
            background-color: #007bff; /* Blue background */
            color: white; /* White text */
        }

        /* Optional: Add a subtle box-shadow on hover for buttons */
        .btn-group .btn:hover {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card_heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.details_user {
    color: white;
}

.btn-num-3 {
    font-size: 11px;
    color: grey;
}
.btn-num-2 {
    font-size: 15px;
    color: lightgrey;
}

.plan_choose {
    overflow-x: auto;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch; /* Smooth scrolling on mobile */
}

.scroll-right {
    display: flex;
    gap: 10px;
}

.btn-group button {
    flex-shrink: 0; /* Prevents buttons from shrinking */
}
</style>
</head>

<body>

    <div class="content-body">
        <div class="container choose_plan-container">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <div class="card_top">
                            <div class="card_heading p-2">
                               <div class="reharge_us">
                                
                               <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 512" width="50" height="50">
                                <g fill-rule="nonzero">
                                    <path fill="#0A2885" d="M512 256C512 114.62 397.38 0 256 0S0 114.62 0 256s114.62 256 256 256 256-114.62 256-256z"/>
                                    <path fill="#fff" d="M375.19 310.59c-18.84 0-31.79-13.82-31.79-33.58 0-19.45 13.23-33.28 31.79-33.28S407 257.56 407 277.29c0 19.13-13.53 33.28-31.79 33.28l-.02.02zm.64-109.91c-48.32 0-80.47 30.66-80.47 76.29 0 46.83 30.96 76.89 79.55 76.89 48.3 0 80.11-30.06 80.11-76.59 0-45.93-31.47-76.59-79.21-76.59h.02zm-124.52-66.87c-18.27 0-29.76 10.3-29.76 26.51 0 16.52 11.78 26.82 30.61 26.82 18.28 0 29.76-10.3 29.76-26.82 0-16.48-11.78-26.51-30.61-26.51zm3.24 68.35h-5.91c-14.4 0-25.33 6.76-25.33 27.41v94.3c0 20.9 10.58 27.39 25.94 27.39h5.88c14.44 0 24.74-7.04 24.74-27.42v-94.27c0-21.23-10.03-27.41-25.32-27.41zm-77.14-44.46h-8.54c-16.21 0-25.04 9.17-25.04 27.41v88.1c0 22.69-7.69 30.64-25.6 30.64-14.13 0-25.63-6.19-34.78-17.41-.89-1.15-19.45 7.66-19.45 29.51 0 23.55 22.07 37.99 63.03 37.99 49.79 0 76.01-25.03 76.01-79.83l.01-89.04c0-18.26-8.81-27.37-25.64-27.37z"/>
                                </g>
                                </svg>

                             
                               <div class="details_user ms-3">
                                <div class="btn-num">{{$mobileNumber}}</div>
                                <div class="btn-num-2">{{$operator->OperatorName ?? 'N/A'}}</div>
                                <div class="btn-num-3">{{$Circle->circlename ?? 'N/A'}}</div>
                               </div>
                               </div>
                               <button type="submit" class='btn btn-sm btn-light'>Change</button>
                            </div>
                            <div class="card_bottom">
                             <div class="validity_1">
                                <p>{{ auth()->user()->name }}</p>

                                    <i class="fa fa-info-circle" aria-hidden="true" style="color:white;"></i>

                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                <div class="input-group_1 mb-2">
       
                    <div class="input-with-icon">
                        <input type="text" id="mobile-number" name="mobile_number" placeholder="Search or enter amount" required>
                        <span class="contact-icon"><i class="fa fa-search" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>

                <div class="plan_choose">
                    <div class="btn-group scroll-right" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary">Popular</button>
                        <button type="button" class="btn btn-primary">Full Talk Time</button>
                        <button type="button" class="btn btn-primary">DATA</button>
                        <button type="button" class="btn btn-primary">TOPUP</button>
                        <button type="button" class="btn btn-primary">STV</button>
                        <button type="button" class="btn btn-primary">True 5G Unlimited</button>
                    </div>
                </div>
            </div>
            <!--PlanVoucher,FULLTT, DATA,TOPUP, STV, -->
            <div class="row" id="smartphone">
             
                <div class="col-sm-12 col-md-6 col-lg-6 ">
                    <div class="card">
                        <div class="card-header">
                            <div class="plan-price">
                                ₹ 199
                            </div>
                            <div class="plan-details">
                                14 days
                                <div class="plans_value">Validity</div>
                            </div>
                            <div class="plan-details">
                                2GB/day
                                <div class="plans_value">Data</div>
                            </div>
                        </div>
                        <div class="card-body">
                       
                            <div class="validity">
                                <img src="{{ asset('assets_web/images/wallet/13.png') }}"  style="width:10%!important;" alt="">
                                <p>Spin UPTO ₹200</p>
                                <!-- <p>RECEIVE LUCKY SPIN CHANCE TO COLLECT UPTO 200₹ IN YOUR BANK ON EVERY RECHARGE OR BILL PAYMENT.</p> -->
                                <button class="btn btn-sm btn-light mb-0" type="submit">show more</button>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>

    @endsection