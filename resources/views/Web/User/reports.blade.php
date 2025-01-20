@extends('Web.layout.main')

@section('content')

<div class="content-body">
    <div class="container-fluid py-5">
    <h2 class="text-light text-center mb-4">Reports</h2>

        <!-- Row of Report Cards -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- Recharge Report Card -->
            <div class="col">
                <div class="card h-100" style="cursor: pointer;" onclick="window.location=''">
                    <div class="card-body text-center">
                        <i class="fas fa-bolt fa-3x mb-3"></i> <!-- Recharge Icon -->
                        <h5 class="card-title">Recharge Report</h5>
                        <p class="card-text">View the details of recharge transactions.</p>
                    </div>
                </div>
            </div>

            <!-- Customer Report Card -->
            <div class="col">
                <div class="card h-100" style="cursor: pointer;" onclick="window.location=''">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x mb-3"></i> <!-- Customer Icon -->
                        <h5 class="card-title">Customer Report</h5>
                        <p class="card-text">View the details of customer activities.</p>
                    </div>
                </div>
            </div>

            <!-- Sales Report Card -->
            <div class="col">
                <div class="card h-100" style="cursor: pointer;" onclick="window.location=''">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line fa-3x mb-3"></i> <!-- Sales Icon -->
                        <h5 class="card-title">Sales Report</h5>
                        <p class="card-text">View the details of sales transactions.</p>
                    </div>
                </div>
            </div>

            <!-- Inventory Report Card -->
            <div class="col">
                <div class="card h-100" style="cursor: pointer;" onclick="window.location=''">
                    <div class="card-body text-center">
                        <i class="fas fa-boxes fa-3x mb-3"></i> <!-- Inventory Icon -->
                        <h5 class="card-title">Inventory Report</h5>
                        <p class="card-text">View the details of inventory status.</p>
                    </div>
                </div>
            </div>

            <!-- Payment Report Card -->
            <div class="col">
                <div class="card h-100" style="cursor: pointer;" onclick="window.location=''">
                    <div class="card-body text-center">
                        <i class="fas fa-credit-card fa-3x mb-3"></i> <!-- Payment Icon -->
                        <h5 class="card-title">Payment Report</h5>
                        <p class="card-text">View the details of payments made.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
