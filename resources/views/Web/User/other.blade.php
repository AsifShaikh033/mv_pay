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
<style>
.gradient-icon {
    font-size: 3rem;
    background: linear-gradient(45deg, #FF5722,rgb(221, 21, 37), #0d8889, #2196F3);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.gradient-icon-bank {
    font-size: 3rem;
    background: linear-gradient(45deg, #FF5722, #0d8889,rgb(221, 21, 37), #2196F3);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>
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
                <div class="card " style="cursor: pointer;" onclick="window.location='{{route('user.paymentlist')}}'">
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
                <div class="card" style="cursor: pointer;" onclick="applyCreditCard()">
                <div class="other_icon gradient-icon">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <h5 class="card-title">Credit Card</h5>
               </div>
               <div class="card" style="cursor: pointer;" onclick="showBankAccountModal()">
                        <div class="other_icon gradient-icon-bank">
                            <i class="fa fa-university"></i> <!-- Bank icon -->
                        </div>
                        <h5 class="card-title">Open Bank Account</h5>
                </div>

            </div>
        </section>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="bankAccountModal" tabindex="-1" aria-labelledby="bankAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bankAccountModalLabel">Choose Account Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Select the type of account you want to open:</p>
                <div class="d-flex flex-column gap-2">
                    <button class="btn btn-primary" onclick="openBankAccount('1')">Savings Account</button>
                    <button class="btn btn-success" onclick="openBankAccount('2')">Current Account</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function showBankAccountModal() {
    var myModal = new bootstrap.Modal(document.getElementById('bankAccountModal'));
    myModal.show();
}
function applyCreditCard() {
        let url = "{{ route('user.credit_card') }}";
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.url) {
                    window.open(data.url, '_blank'); 
                } else {
                    alert(data.error || "Something went wrong.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Something went wrong.");
            });
    }
    function openBankAccount(accountType) {
        let url = "{{ route('user.axic_bank') }}?type=" + accountType;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.url) {
                    window.open(data.url, '_blank'); 
                } else {
                    alert(data.error || "Something went wrong.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Something went wrong.");
            });
    }
</script>
@endsection
