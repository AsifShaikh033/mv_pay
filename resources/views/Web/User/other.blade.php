@extends('Web.layout.main')

@section('content')

<STYLE>
    
      .service-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    . {
      
        color: #fff;
        /* padding: 20px; */
        width: calc(33.333% - 20px); /* Default width for larger screens */
        border-radius: 10px;
        text-align: center;
       
        transition: transform 0.3s ease;
    }

    .:hover {
        transform: translateY(-5px);
    }

    .other_icon {
        font-size: 3rem;
        margin-bottom: 15px;
    }

    . h3 {
        font-size: 1.2rem;
    }


    
    /* Additional style tweaks for mobile */
    @media (max-width: 480px) {
        .icon {
            font-size: 2rem;
        }

      
        .other_icon {
    font-size: 2rem;
    margin-bottom: 5px;
}

.other_icon img {
    width: 100%;
    height: 100%;
}


    }
    
</STYLE>
<div class="content-body">
    <div class="container-fluid ">
       
        <section class="services">
            <h2 class="text-light mb-4">Other Services</h2>
            <div class="service-cards">
              
                <!-- Payment Request -->
                <div class="card " style="cursor: pointer;" onclick="window.location='{{route('user.bank_details')}}'">
                    <div class="other_icon">
                        <img src="{{ asset('assets_web/images/others_services/payment_staus.png') }}" width="100px" height="100px" alt="">
                            </div>
                    <h5 class="card-title">Bank details for withdrawal</h5>
                </div>

                <!-- Payment Status -->
                <div class="card " style="cursor: pointer;" onclick="window.location=''">
                    <div class="other_icon"><img src="{{ asset('assets_web/images/dashboard/payment status.png') }}" width="100px" height="100px" alt=""></div>
                    <h5 class="card-title">Payment Status</h5>
                </div>
                
                <!-- Add User -->
                <!-- <div class="card " style="cursor: pointer;" onclick="window.location=''">
                    <div class="other_icon">➕</div>
                    <h5 class="card-title">Add User</h5>
                </div> -->

                <!-- Day Book -->
                <!-- <div class="card " style="cursor: pointer;" onclick="window.location=''">
                    <div class="other_icon">📖</div>
                    <h5 class="card-title">Day Book</h5>
                </div> -->

                <!-- Member List -->
                <div class="card " style="cursor: pointer;" onclick="window.location='{{route('user.memberlist')}}'">
                    <div class="other_icon">
                        <img src="{{ asset('assets_web/images/others_services/member_list.png') }}"  width="100px" height="100px"  alt="">
                    </div>
                    <h5 class="card-title">Member Refer List</h5>
                </div>

                <!-- Commission Report -->
                <div class="card " style="cursor: pointer;" onclick="window.location='{{route('user.commissionreport')}}'">
                    <div class="other_icon"><img src="{{ asset('assets_web/images/dashboard/commission report.png') }}" width="100px" height="100px" alt=""></div>
                    <h5 class="card-title">Commission Report</h5>
                </div>

                <!-- Fund Transaction -->
                <div class="card " style="cursor: pointer;" onclick="window.location='{{route('user.fundtransaction')}}'">
                    <div class="other_icon">
                    <img src="{{ asset('assets_web/images/others_services/fund_trans.png') }}" width="100px" height="100px" alt="">
              
                    </div>
                    <h5 class="card-title">Fund Transaction</h5>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
