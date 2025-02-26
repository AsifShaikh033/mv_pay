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
        <h2 class="text-light text-center mb-4 mt-2">Payment Status List</h2>

        @if($fund->isEmpty())
            <p class="text-center text-white">No Payment Status List found for this report.</p>
        @else
            <div class="row g-3"> 

                @foreach($fund as $transaction)

                    <div class="col-12 col-sm-6 col-md-4 col-lg-12">
                        <div class="card p-0 m-0 shadow-lg border-0 ">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <!-- User Info -->
                                    <div class=" col-6">
                                    @if(isset($transaction->barcode))
                                        <img 
                                            src="{{ $transaction->barcode ? url('storage/app/public/' . $transaction->barcode) : asset('assets_web/images/profile/default.png') }}"
                                            alt="Barcode Image" 
                                            class="img-fluid" width="100px" height="100px" style="border-radius: 30px;">

                                        @endif
                                        <div>
                                            <h5 class="card-title mb-1">{{ ucfirst($transaction->user->name) }}</h5>
                                            <strong>UPI ID:</strong> 
                                                <span class="">{{ $transaction->upi_id }}</span>
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
                                        <p class="small"><strong>Account Holder Name:</strong> {{ $transaction->account_holder_name }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6">
                                        <p class="small"><strong>Account Number:</strong> {{ $transaction->account_number }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6">
                                    <p class="small"><strong>Branch Name:</strong> {{ $transaction->branch_name }}</p>
                                    </div>
                                <!-- </div>

                                <div class="row"> -->
                                <div class="col-lg-4 col-md-6 col-6">
                                        <p class="small"><strong>Bank Name:</strong> {{ $transaction->bank_name }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6">
                                    <p class="small"><strong>IFSC Code:</strong> {{ $transaction->ifsc_code }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6">
                                    <p class="small"><strong>Date:</strong> {{ $transaction->created_at ? $transaction->created_at->format('d-m-y') : 'N/A' }}</p>
                                    </div>
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
