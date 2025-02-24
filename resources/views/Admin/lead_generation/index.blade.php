@extends('Admin.layout.main')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Lead Generation</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List of Lead Generation Records</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>S. No.</th>
                                        <th>User Name</th>
                                        <th>User Phone No.</th>
                                        <th>Type</th>
                                        <th>Account Type</th>
                                        <th>URL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leadGenerations as $index => $data)
                                    <tr>
                                        <td>{{ $index + 1 }}</td> <!-- Serial number -->
                                        <td>{{ $data->user->name ?? 'N/A' }}</td> <!-- User name -->
                                        <td>{{ $data->user->mob_number ?? 'N/A' }}</td> <!-- User phone -->
                                        <!-- <td>{{ ucfirst($data->type) }}</td> -->
                                        <td>
                                            @if(is_null($data->type))
                                                <span class="badge bg-warning">N/A</span>
                                            @else
                                                {{ $data->type == 'bank_acc' ? 'Bank Account' : 'Credit Card' }}
                                            @endif
                                        </td>

                                        <td>
                                            @if(is_null($data->account_type))
                                                <span class="badge bg-warning">N/A</span>
                                            @else
                                                {{ $data->account_type == 1 ? 'Savings' : 'Current' }}
                                            @endif
                                        </td>
                                        <td>{{ $data->url }}</td>
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
