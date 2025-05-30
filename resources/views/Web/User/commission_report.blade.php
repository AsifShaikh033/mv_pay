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
        <h2 class="text-light text-center mb-4 mt-2">Commission Report</h2>

        @if($commission->isEmpty())
            <p class="text-center text-white">No Commission Report found for this report.</p>
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
                @foreach($commission as $transaction)
                
                    @php
                        $operatorLogo = isset($operators[$transaction->operator]) 
                            ? asset('assets/operators/' . $operators[$transaction->operator]) 
                            : asset('assets/operators/default.png');
                    @endphp
                    <div class="card w-100 h-25 mb-1 shadow-lg border-0 rounded-lg mobile-h-25">
                        <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between" style="flex-direction: row;">
                    <!-- Logo & User Info (Left) -->
                    <div class="d-flex align-items-center" style="flex-direction: row;">
                        <!-- <img src="{{ $operatorLogo }}" alt="{{ $transaction->operator }}" width="50" style="border-radius: 30px;"> -->
                        <div>
                            <h5 class="card-title mb-1">{{ ucfirst($transaction->user->name) }}</h5>
                            <strong>TRX Type:</strong> 
                            @if($transaction->trx_type == '+')
                                <span class="badge bg-success">+</span>
                            @elseif($transaction->trx_type == '-')
                                <span class="badge bg-danger">-</span> 
                            @endif
                           
                        </div>
                    </div>
                        <!-- <div>
                            <p class="card-text mb-0"><strong>Post Balance:</strong> {{ $transaction->post_balance }}</p>
                        </div> -->
                    
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
                        <p class="card-text me-4"><strong>Remark:</strong> {{ ucfirst(str_replace('_', ' ', $transaction->remark)) }}</p>
                        <!-- <p class="card-text"><strong>Response Msg:</strong> {{ $transaction->response_msg }}</p> -->
                    </div>

                            
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection
