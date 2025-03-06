@extends('Web.layout.main')

@section('content')
<style>
    @media (max-width: 767px) { 
    .mobile-h-25 {
        height: 25% !important;
    }
}

</style>
<div class="content-body">
    <div class="container py-4">
        <h2 class="text-light text-center mb-4 mt-2">{{ $reportTitle }}</h2>

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
                            <span class="card-text mb-0" style="
    border: var(--bs-border-width) solid var(--bs-border-color);
"><strong>Spin Redirect Link:</strong><a href="https://mvvision.in/student/spin-mv-pay" target="_blank" id="spin-link"> https://mvvision.in/student/spin-mv-pay</a>
                            <button onclick="copyLink()" class="btn btn-sm btn-info btn-outline-primary ms-2">Copy Link</button>  
                </span>
                        <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between" style="flex-direction: row;">
                    <!-- Logo & User Info (Left) -->
                    <div class="d-flex align-items-center" style="flex-direction: row;">
                        <!-- <img src="{{ $operatorLogo }}" alt="{{ $transaction->operator }}" width="50" style="border-radius: 30px;"> -->
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
                            
                        <!-- <span id="copy-message" style="display: none; color: limegreen;">Link copied successfully!</span>
                            <p class="card-text mb-0"><strong>Spin Redirect Link:</strong><a href="https://mvvision.in/student/spin-mv-pay" target="_blank" id="spin-link"> https://mvvision.in/student/spin-mv-pay</a>
                            <button onclick="copyLink()" class="btn btn-sm btn-info btn-outline-primary ms-2">Copy Link</button>  
                        </p> -->
                            <p class="card-text mb-0"><strong>Post Balance:</strong> {{ $transaction->post_balance }}</p>
                        </div>
                    
    <!-- Status (Right) -->
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

                    <div class="d-flex justify-content-between" style="flex-direction: row;">
                        <p class="card-text me-4"><strong>Amount:</strong> ₹{{ $transaction->amount }}</p>
                        <p class="card-text me-4"><strong>Transaction ID:</strong> {{ $transaction->transaction_id }}</p>
                        <p class="card-text"><strong>Date:</strong> {{ $transaction->created_at ? $transaction->created_at->format('d-m-y') : 'N/A' }}</p>
                    </div>

                    <div class="d-flex justify-content-between" style="flex-direction: row;">
                        <p class="card-text me-4"><strong>Details:</strong> {{ $transaction->details }}</p>
                        <p class="card-text me-4"><strong>Remark:</strong> {{ $transaction->remark }}</p>
                        <p class="card-text"><strong>Response Msg:</strong> {{ $transaction->response_msg }}</p>
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
                setTimeout(() => { message.style.display = 'none'; }, 2000);
            })
            .catch(err => console.error('Failed to copy link:', err));
    }
</script>
@endsection
