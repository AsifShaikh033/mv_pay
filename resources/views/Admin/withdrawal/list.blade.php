@extends('Admin.layout.main')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Withdrawal History</h3>
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
                            <table id="" class="display table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Account Details</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Transaction ID</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($withdrawals as $withdrawal)
                                    <tr>
                                        <td>{{ $withdrawal->id }}</td>
                                        <td>{{ $withdrawal->user->name ?? 'N/A' }}</td>
                                        <td>
                                                                    {{-- UPI Section --}}
                                        @if(!empty($withdrawal->Bank->upi_id) || !empty($withdrawal->Bank->barcode_image))
                                            <div>
                                                <strong>UPI Details:</strong><br>
                                                @if(!empty($withdrawal->Bank->upi_id))
                                                    <span class="badge bg-success">UPI ID:</span> {{ $withdrawal->Bank->upi_id }}<br>
                                                @endif

                                                @if(!empty($withdrawal->Bank->barcode))
                                                    <span class="badge bg-info">QR Code:</span><br>
                                                    <img 
                                                    src="{{ asset('storage/' . $withdrawal->bank->barcode) }}" 
                                                    alt="QR Code" 
                                                    style="max-width: 120px; margin-top: 5px; cursor: pointer;" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#qrModal{{ $withdrawal->id }}"
                                                >
                                                <div class="modal fade" id="qrModal{{ $withdrawal->id }}" tabindex="-1" aria-labelledby="qrModalLabel{{ $withdrawal->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="qrModalLabel{{ $withdrawal->id }}">Full QR Code</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('storage/' . $withdrawal->bank->barcode) }}" alt="Full QR Code" style="max-width: 100%;">
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                                @endif
                                            </div>
                                            @else
                                              N/A   {{ $withdrawal->Bank->bank_name }}
                                             @endif

                                        {{-- Bank Section --}}
                                        @if(!empty($withdrawal->Bank->bank_name) || !empty($withdrawal->Bank->account_number))
                                            <div style="margin-top: 10px;">
                                                <strong>Bank Details:</strong><br>
                                                @if(!empty($withdrawal->Bank->bank_name))
                                                    <span class="badge bg-primary">Bank Name:</span> {{ $withdrawal->Bank->bank_name }}<br>
                                                @endif
                                                @if(!empty($withdrawal->Bank->branch_name))
                                                    <span class="badge bg-primary">Branch:</span> {{ $withdrawal->Bank->branch_name }}<br>
                                                @endif
                                                @if(!empty($withdrawal->Bank->ifsc_code))
                                                    <span class="badge bg-primary">IFSC:</span> {{ $withdrawal->Bank->ifsc_code }}<br>
                                                @endif
                                                @if(!empty($withdrawal->Bank->account_number))
                                                    <span class="badge bg-primary">Account No:</span> {{ $withdrawal->Bank->account_number }}<br>
                                                @endif
                                            </div>
                                            @else
                                            N/A </br>
                                             @endif
                                            </td>
                                        <td>{{ $withdrawal->amount }}</td>
                                        <td>
                                            @if($withdrawal->status == 'success')
                                                <span class="badge bg-success">Success</span>
                                            @elseif($withdrawal->status == 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @elseif($withdrawal->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>{{ $withdrawal->transaction_id }}</td>
                                        <td>{{ $withdrawal->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            @if($withdrawal->status == 'pending')
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveModal" data-id="{{ $withdrawal->id }}">Approve</button>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal" data-id="{{ $withdrawal->id }}">Reject</button>
                                            @endif
                                            @if($withdrawal->status == 'rejected')
                                            <span class="badge bg-danger">{{ $withdrawal->details }}</span>
                                            @endif
                                            @if($withdrawal->status == 'success')
                                            <span class="badge bg-success">{{ $withdrawal->details }}</span>
                                            @endif
                                        </td>
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
