@extends('Web.layout.main')

@section('content')
<style>
    @media (max-width: 767px) {
        .mobile-h-25 {
            height: 25% !important;
        }

    }
</style>
<style>
      
        
        /* Main section */
        .snow {
    display: flex;
    /* align-items: center; */
    justify-content: center;
    padding: 20px;
    border-radius: 10px;
    background: linear-gradient(to right, black, blue);
    text-align: center;
}

        /* Trophy section */
        .shows img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }


        .d-flex {
            flex-direction: column !important;
        }

        .card-text {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .justify-content-between {
            justify-content-center !important;
        }
    }

    .snow {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        border-radius: 10px;
        background: linear-gradient(to right, black, blue);
        text-align: center;
    }


      
        .trophy {
    width: 50%;
    /* height: 50%; */
}
        .showss img{
            width:30%;
           
        }

        @media (max-width: 400px) {
            .showss img {
                    width: 30%;
                }
                .showss h2 a {
                    font-size: 15px;
                }        
            .showss h3 {
                font-size: 15px;
            }
            .showss p {
    font-size: 10px;
    margin: 0px;
}
            .showss h1 {
                font-size: 20px !important;
                margin:0px;
            }

    }
  

    .showss {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .showss h2 {
        font-size: 24px;
        font-weight: bold;
       
    }

    .showss h1 {
        font-size: 40px;
        font-weight: bold;
        color: #FFD700;
    }


    .showss a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

    .trophy {
        width: 50%;
        /* height: 50%; */
    }
</style>

<div class="content-body">
<div class="container py-4">
    <h2 class="text-light text-center mb-4 mt-5">{{ $reportTitle }}</h2>

    <div class="container">
        <div class="snow">
            <img src="{{ asset('assets_web/images/others_services/trophy.png') }}" class="trophy" alt="Trophy">

            <div class="showss">


                <img src="{{ asset('assets_web/images/others_services/spin.png') }}" alt="Spin Wheel">
                <h2>
                    <a href="https://mvvision.in/student/spin-mv-pay" target="_blank">
                        Click here
                    </a>
                </h2>
                <p>
                    <a href="https://mvvision.in/student/spin-mv-pay" target="_blank">
                        https://mvvision.in/student/spin-mv-pay
                    </a>
                </p>

                <h3>You have received</h3>
                <h1>Spin Cashback</h1>
            </div>
        </div>
    </div>
</div>


        @if($transactions->isEmpty())
        <p class="text-center text-white">No Transactions found for this report.</p>
        @else
        <div class="d-flex flex-wrap justify-content-center">
            @php
            $operators = [
            'Airtel' => 'airtel.png',
            'Idea' => 'idea.png',
            'Jio' => 'jio.png',
            'BSNL TopUp' => 'bsnl.png',
            'Vi' => 'vi.png',
            'DTH' => 'dth.png',
            'Electricity' => 'electricity.png',
            'Hospital' => 'hospital.png',
            'Loan Repayment' => 'loan.png',
            'LPG Gas' => 'lpg.png',
            'Municipal Services' => 'municipal.png',
            'Municipal Taxes' => 'municipal.png',
            'Education Fees' => 'education.png'
            ];
            @endphp
            @foreach($transactions as $transaction)

            @php
            $operatorLogo = isset($operators[$transaction->operator])
            ? asset('assets/operators/' . $operators[$transaction->operator])
            : asset('assets/operators/default.png');
            @endphp
            <div class="card w-100 h-25 mb-1 shadow-lg border-0 rounded-lg mobile-h-25">
                <span id="copy-message" style="display: none; color: limegreen;">Link copied successfully!</span>
                <span class="card-text mb-0" style="border: var(--bs-border-width) solid var(--bs-border-color);"><strong>Spin Redirect Link:</strong><a href="https://mvvision.in/student/spin-mv-pay" target="_blank" id="spin-link"> https://mvvision.in/student/spin-mv-pay</a>
                    <button onclick="copyLink()" class="btn btn-sm btn-info btn-outline-primary ms-2">Copy Link</button>
                </span>
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between" style="flex-direction: row;">
                        <div class="d-flex align-items-center" style="flex-direction: row;">
                            <div>
                                <h5 class="card-title mb-1">{{ ucfirst($transaction->user_name) }}</h5>
                                <strong>TRX Type:</strong>
                                @if($transaction->trx_type == '+')
                                <span class="badge bg-success">+</span>
                                @elseif($transaction->trx_type == '-')
                                <span class="badge bg-danger">-</span>
                                @endif

                            </div>
                        </div>

                        <div>
                            <strong>Status:</strong>
                            @if($transaction->status == '1')
                            <span class="badge bg-success">Success</span>
                            @elseif($transaction->status == '0')
                            <span class="badge bg-warning">Pending</span>
                            @elseif($transaction->status == '2')
                            <span class="badge bg-danger">Failed</span>
                            @elseif($transaction->status == '3')
                            <span class="badge bg-danger">Rejected</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p class="card-text me-4"><strong>Amount:</strong> ₹{{ $transaction->amount }}</p>
                        <p class="card-text me-4"><strong>Transaction ID:</strong> {{ $transaction->transaction_id }}</p>
                        <p class="card-text"><strong>Date:</strong> {{ $transaction->created_at ? $transaction->created_at->format('d-m-y') : 'N/A' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
<script>
    function copyLink() {
        const link = document.getElementById('spin-link').getAttribute('href');
        navigator.clipboard.writeText(link)
            .then(() => {
                const message = document.getElementById('copy-message');
                message.style.display = 'inline';
                setTimeout(() => {
                    message.style.display = 'none';
                }, 2000);
            })
            .catch(err => console.error('Failed to copy link:', err));
    }
</script>
@endsection