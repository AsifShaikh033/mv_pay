@extends('Admin.layout.main')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Users</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Users List</h4>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                                <!-- Status Dropdown -->
                                <h4 class="card-title"></h4>

                                <form action="{{ route('admin.transaction.list') }}" method="GET" id="statusFilterForm" class="d-flex ml-10">
                                    <label for="statusFilter" class="form-label me-2 small align-self-center">Filter by Status</label>
                                    <select class="form-select form-select-lg w-auto" name="status" id="statusFilter" onchange="document.getElementById('statusFilterForm').submit()">
                                        <option value="">All</option>
                                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pending</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Success</option>
                                        <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Failed</option>
                                        <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>
                            </div>
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th> 
                                        <th>User</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Post Amount</th>
                                        <th>status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $index => $userData) 
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $userData->user->name }} <br> 
                                            <small>{{ $userData->user->email }}</small>
                                        </td>
                                        <td>
                                            <span class="badge {{ $userData->trx_type === '+' ? 'badge-success' : 'badge-danger' }} fs-4">
                                                {{ $userData->trx_type }}
                                            </span>
                                        </td>


                                         <td>{{ $userData->amount }}</td>
                                         <td>{{ $userData->post_balance }}</td>
                                         <td>
                                            @php
                                                // Map status values to labels and badge classes
                                                $statusMap = [
                                                    0 => ['label' => 'Pending', 'class' => 'badge badge-warning'],
                                                    1 => ['label' => 'Success', 'class' => 'badge badge-success'],
                                                    2 => ['label' => 'Failed', 'class' => 'badge badge-danger'],
                                                    4 => ['label' => 'Rejected', 'class' => 'badge badge-secondary'], // Replace with custom orange if needed
                                                ];

                                                // Get the appropriate label and badge class or use default values
                                                $status = $statusMap[$userData->status] ?? ['label' => 'Unknown', 'class' => 'badge badge-muted'];
                                            @endphp

                                            <span class="{{ $status['class'] }}">
                                                {{ $status['label'] }}
                                            </span>
                                        </td>

                                        <td>{{ $userData->created_at->format('d-m-Y') }}</td>
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

@endsection

@push('scripts')
<script>
    // JavaScript code for handling modal behavior or table operations
    $(document).ready(function() {
        $('#deleteModal').on('show.bs.modal', function (e) {
            var userId = $(e.relatedTarget).data('id'); // Get the ID of the clicked user
            $(this).find('#user_id').val(userId); // Set the hidden input to the user ID
        });
    });
</script>
@endpush
