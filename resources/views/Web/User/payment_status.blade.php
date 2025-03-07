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
        <h2 class="text-light text-center mb-4 mt-2">Payment Status</h2>

        @if($fund->isEmpty())
            <p class="text-center text-white">No Fund Report found for this report.</p>
        @else
            <div class="row g-3"> 
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

                @foreach($fund as $transaction)
                    @php
                        $operatorLogo = isset($operators[$transaction->operator]) 
                            ? asset('assets/operators/' . $operators[$transaction->operator]) 
                            : asset('assets/operators/default.png');
                    @endphp

                    <div class="col-12 col-sm-6 col-md-4 col-lg-12">
                        <div class="card p-0 m-0 shadow-lg border-0 ">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <!-- User Info -->
                                    <div class=" col-6">
                                        <img src="{{ $operatorLogo }}" alt="{{ $transaction->operator }}" width="50" class="rounded-circle me-2">
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

                                    <!-- Status -->
                                    <div class="col-6">
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

                                <hr class="my-2">

                                <!-- Transaction Details -->
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-6">
                                        <p class="small"><strong>Amount:</strong> ₹{{ $transaction->amount }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6">
                                        <p class="small"><strong>Transaction ID:</strong> {{ $transaction->transaction_id }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6">
                                    <p class="small"><strong>Details:</strong> {{ $transaction->details }}</p>
                                    </div>
                                <!-- </div>

                                <div class="row"> -->
                                <!-- <div class="col-lg-4 col-md-6 col-6">
                                        <p class="small"><strong>Post Balance:</strong> ₹{{ $transaction->post_balance }}</p>
                                    </div> -->
                                    <div class="col-lg-4 col-md-6 col-6">
                                        <p class="small"><strong>Date:</strong> {{ $transaction->created_at ? $transaction->created_at->format('d-m-y') : 'N/A' }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6">
                                    <p class="small"><strong>Remark:</strong> {{ $transaction->remark }}</p>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <!-- <p class="small"><strong>Details:</strong> {{ $transaction->details }}</p>
                                    <p class="small"><strong>Remark:</strong> {{ $transaction->remark }}</p> -->
                                    <!-- <p class="small"><strong>Response Msg:</strong> {{ $transaction->response_msg }}</p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>


@endsection
