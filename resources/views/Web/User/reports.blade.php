@extends('Web.layout.main')

@section('content')

<div class="content-body">
    <div class="container-fluid py-5">
    <h2 class="text-light text-center mb-4">Reports</h2>

        <!-- Row of Report Cards -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- Recharge Report Card -->
            <div class="col">
                <div class="card h-100" style="cursor: pointer;" onclick="window.location='{{ route('user.report.show', ['type' => 'recharge_report']) }}'">
                    <div class="card-body text-center">
                    <img src="{{ asset('assets_web/images/others_services/recharge_report.png') }}" width="100px" height="100px" alt="">
                       <h5 class="card-title">Self recharge report</h5>
                        <p class="card-text">View the details of self recharge transactions.</p>
                    </div>
                </div>
            </div>

            <!-- Customer Report Card -->
            <div class="col">
                <div class="card h-100" style="cursor: pointer;" onclick="window.location='{{ route('user.report.show', ['type' => 'customer_report']) }}'">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x mb-3"></i> <!-- Customer Icon -->
                        <h5 class="card-title">Team recharge Report</h5>
                        <p class="card-text">View the details of Team activities.</p>
                    </div>
                </div>
            </div>

          

            <!-- Wallet Report Card -->
            <div class="col">
                <div class="card h-100" style="cursor: pointer;" onclick="window.location='{{ route('user.report.show', ['type' => 'wallet_report']) }}'">
                    <div class="card-body text-center">
                        <i class="fas fa-boxes fa-3x mb-3"></i> <!-- Wallet Icon -->
                        <h5 class="card-title">Bill payment Status</h5>
                        <p class="card-text">View the details of Bill payment status.</p>
                    </div>
                </div>
            </div>

            <!-- Payment Report Card -->
            <div class="col">
                <div class="card h-100" style="cursor: pointer;" onclick="window.location='{{ route('user.report.show', ['type' => 'payment_report']) }}'">
                    <div class="card-body text-center">
                        <i class="fas fa-credit-card fa-3x mb-3"></i> <!-- Payment Icon -->
                        <h5 class="card-title">Other Payment Status</h5>
                        <p class="card-text">View the details of other payments .</p>
                    </div>
                </div>
            </div>

              <!-- Spin Report Card -->
              <div class="col">
                <div class="card h-100" style="cursor: pointer;" onclick="window.location='{{ route('user.report.show', ['type' => 'spin_report']) }}'">
                    <div class="card-body text-center">
                        <!-- <i class="fas fa-chart-line fa-3x mb-3"></i>  -->
                        <img src="{{ asset('assets_web/images/others_services/spin_cash.png') }}" width="100px" height="100px" alt="">
                        <h5 class="card-title">Spin Report</h5>
                        <p class="card-text">View the details of Spin transactions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
