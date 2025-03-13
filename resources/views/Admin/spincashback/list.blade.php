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

<!-- Approve Confirmation Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Approval</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">Are you sure you want to approve this withdrawal?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="" id="approveForm">
                    @csrf
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Reject Confirmation Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Withdrawal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <textarea id="rejectReason" class="form-control" placeholder="Enter reason for rejection"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="" id="rejectForm">
                    @csrf
                    <input type="hidden" name="reason" id="reasonInput">
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#add-row').DataTable();

        $('#approveModal').on('show.bs.modal', function(e) {
            let id = $(e.relatedTarget).data('id');
            $('#approveForm').attr('action', `{{ url('admin/withdrawal') }}/${id}/approve`);
        });

        $('#rejectModal').on('show.bs.modal', function(e) {
            let id = $(e.relatedTarget).data('id');
            $('#rejectForm').attr('action', `{{ url('admin/withdrawal') }}/${id}/reject`);
        });

        $('#rejectForm').submit(function() {
            $('#reasonInput').val($('#rejectReason').val());
        });
    });
</script>
@endpush

@endsection
