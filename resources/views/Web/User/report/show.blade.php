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

        @if($recharges->isEmpty())
            <p class="text-center text-white">No Recharges found for this report.</p>
        @else
            <div class="d-flex flex-wrap justify-content-center">
                @php
                    $operators = [
                        'Airtel' => 'airtel.png',
                        'AIRTEL' => 'airtel.png',
                        'AT' => 'airtel.png',
                        'Idea' => 'idea.png',
                        'Jio' => 'jio.png',
                        'JIO' => 'jio.png',
                        'Jio Logo' => 'jio.png',
                        'Reliance Jio' => 'jio.png',
                        'BSNL TopUp' => 'bsnl.png',
                        'BSNL' => 'bsnl.png',
                        'Vi' => 'vi.png',
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
                @endphp
                @foreach($recharges as $recharge)
                    @php
                        $operatorLogo = isset($operators[$recharge->operator]) 
                            ? asset('assets/operators/' . $operators[$recharge->operator]) 
                            : asset('assets/operators/default.png');
                    @endphp
                    <div class="card w-100 mb-1 shadow-lg border-0 rounded-lg mobile-h-25">
                        <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between" style="flex-direction: row;">
                    <!-- Logo & User Info (Left) -->
                    <div class="d-flex align-items-center" style="flex-direction: row;">
                        <img src="{{ $operatorLogo }}" alt="{{ $recharge->operator }}" width="50" style="border-radius: 30px;">
                        <div class="ms-2">
                            <h5 class="card-title mb-1">{{ ucfirst($recharge->user_name) }}</h5>
                            <p class="card-text mb-0">{{ $recharge->number }}</p>
                        </div>
                    </div>

    <!-- Status (Right) -->
                        <div>
                            @if($recharge->status == 'success')
                                <span class="badge bg-success">Success</span>
                            @elseif($recharge->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-danger">Failed</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between" style="flex-direction: row;">
                    <p class="card-text me-4"><strong>Amount:</strong> ₹{{ $recharge->amount }}</p>
                    <p class="card-text me-4"><strong>Transaction ID:</strong> {{ $recharge->user_tx }}</p>
                    <p class="card-text"><strong>Date:</strong> {{ $recharge->created_at ? $recharge->created_at->format('d-m-y') : 'N/A' }}</p>
                </div>

                            
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection
