@extends('Admin.layout.main')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Spin Cashback History</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Transaction ID</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($withdrawals as $withdrawal)
                                    <tr>
                                        <td>{{ $withdrawal->id }}</td>
                                        <td>{{ $withdrawal->user->name ?? 'N/A' }}</td>
                                        <td>{{ $withdrawal->amount }}</td>
                                        <td>
                                        @if($withdrawal->status == 1)
                                                <span class="badge bg-success">Success</span>
                                        @elseif($withdrawal->status == 2)
                                        <span class="badge bg-danger">Failed</span>
                                        @elseif($withdrawal->status == 3)
                                            <span class="badge bg-danger">Rejected</span>
                                        @elseif($withdrawal->status == 0)
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                        </td>
                                        <td>{{ $withdrawal->transaction_id }}</td>
                                        <td>{{ $withdrawal->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>

</script>
@endpush

@endsection
