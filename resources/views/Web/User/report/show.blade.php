@extends('Web.layout.main')

@section('content')

<div class="content-body">
    <div class="container py-4">
        <h2 class="text-light text-center mb-4">{{ $reportTitle }}</h2>

        @if($recharges->isEmpty())
            <p class="text-center text-white">No Recharges found for this report.</p>
        @else
            <div class="d-flex flex-wrap justify-content-center">
                @php
                    $operators = [
                        'Airtel' => 'airtel.png',
                        'Idea' => 'idea.png',
                        'Jio' => 'jio.png',
                        'BSNL' => 'bsnl.png',
                        'Vi' => 'vi.png'
                    ];
                @endphp
                @foreach($recharges as $recharge)
                    @php
                        $operatorLogo = isset($operators[$recharge->operator]) 
                            ? asset('assets/operators/' . $operators[$recharge->operator]) 
                            : asset('assets/operators/default.png');
                    @endphp
                    <div class="card w-100 h-25 mb-3 shadow-lg border-0 rounded-lg">
                        <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                    <!-- Logo & User Info (Left) -->
                    <div class="d-flex align-items-center">
                        <img src="{{ $operatorLogo }}" alt="{{ $recharge->operator }}" width="50">
                        <div>
                            <h5 class="card-title mb-1">{{ ucfirst($recharge->user_name) }}</h5>
                            <p class="card-text mb-0">{{ $recharge->number }}</p>
                        </div>
                    </div>

    <!-- Status (Right) -->
                        <div>
                            @if($recharge->status == 'success')
                                <span class="badge bg-success">Success</span>
                            @elseif($recharge->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-danger">Failed</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between">
                    <p class="card-text me-4"><strong>Amount:</strong> ₹{{ $recharge->amount }}</p>
                    <p class="card-text me-4"><strong>Transaction ID:</strong> {{ $recharge->user_tx }}</p>
                    <p class="card-text"><strong>Date:</strong> {{ $recharge->created_at ? $recharge->created_at->format('Y-M-d') : 'N/A' }}</p>
                </div>

                            
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@endsection
