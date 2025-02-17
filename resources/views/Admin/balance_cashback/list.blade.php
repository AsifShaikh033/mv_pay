@extends('Admin.layout.main')

@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Balance Cashback</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List</h4>
                            <button
                        class="btn btn-primary btn-round ms-auto"
                         id="addBannerButton"
                      >
                        <i class="fa fa-plus"></i>
                        Add Balance Cashback
                      </button>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Balance</th>
                                        <th>Cashback</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <body>
                                    @foreach($balanceCashbacks as $data)
                                    <tr>
                                        <td>
                                            {{$data->balance}}
                                        </td>
                                        <td>
                                            {{$data->cashback}}
                                        </td>
                                        <td>
                                            {{ ucwords(str_replace('_', ' ', $data->category)) }}
                                        </td>
                                        <td>
                                     @if($data->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('admin.balance.cashback.edit', $data->id) }}" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        data-id="{{ $data->id }}"
                                                        class="btn btn-link btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </body>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ADD BANNER MODEL -->
<div class="modal fade" id="addBannerModal" tabindex="-1" aria-labelledby="addBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.balance.cashback.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addBannerModalLabel">Add Balance Cashback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="bannerImage" class="form-label">Balance</label>
                        <input type="number" name="balance" id="bannerImage" class="form-control" placeholder="Enter Balance">
                    </div>
                    <div class="form-group mb-3">
                        <label for="priority" class="form-label">Cashback</label>
                        <input type="number" name="cashback" id="cashback" class="form-control" placeholder="Enter Cashback">
                    </div>
                   
                        <div class="form-group">
                            <label for="">Select Ctegory</label>
                            <select class="form-control" required="required" name="category" id="category">
                                          <option value="">Select</option>
                                          <option value="Prepaid-Mobile">Prepaid-Mobile</option>
                                          <option value="Broadband">Broadband</option>
                                          <option value="DTH">DTH</option>
                                          <option value="Landline-Postpaid">Landline Postpaid</option>
                                          <option value="Electricity">Electricity</option>
                                          <option value="GAS">GAS</option>
                                          <option value="Insurance">Insurance</option>
                                          <option value="DMR">DMR</option>
                                          <option value="Water">Water</option>
                                          <option value="PAN-UTI-Token-Based">PAN UTI - Token Based</option>
                                          <option value="Loan-Repayment">Loan Repayment</option>
                                          <option value="Education-Fees">Education Fees</option>
                                          <option value="METRO-CARD-RECHARGE">METRO CARD RECHARGE</option>
                                          <option value="CHALLAN">CHALLAN</option>
                                          <option value="Mobile-Postpaid">Mobile Postpaid</option>
                                          <option value="Municipal-Services">Municipal Services</option>
                                          <option value="Life-Insurance">Life Insurance</option>
                                          <option value="Housing-Society">Housing Society</option>
                                          <option value="Municipal-Taxes">Municipal Taxes</option>
                                          <option value="Health-Insurance">Health Insurance</option>
                                          <option value="LPG-Gas">LPG Gas</option>
                                          <option value="Cable-TV">Cable TV</option>
                                          <option value="Hospital">Hospital</option>
                                          <option value="Subscription">Subscription</option>
                                          <option value="Credit-Card">Credit Card</option>
                                          <option value="PayService">PayService</option>
                                          <option value="OTT-Subscription">OTT Subscription</option>
                                          <option value="IRCTC-Dongle-Based">IRCTC - Dongle Based</option>
                                          <option value="Clubs-and-Associations">Clubs and Associations</option>
                                          <option value="Broadband-Postpaid">Broadband Postpaid</option>
                                          <option value="Axis-Bank-Saving-Account">Axis Bank Saving A/c</option>
                                          <option value="Fastag">Fastag</option>
                                          <option value="Google-Play">Google Play</option>
                                          <option value="Recurring-Deposit">Recurring Deposit</option>
                                          <option value="Rental">Rental</option>
                                          <option value="Hospital-and-Pathology">Hospital and Pathology</option>
                                          <option value="Donation">Donation</option>
                                          <option value="NCMC-Recharge">NCMC Recharge</option>
                                          <option value="Prepaid-Meter">Prepaid Meter</option>
                                      </select>
                        </div>
                   
                    <div class="form-group mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this Banner? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="{{ route('admin.balance.cashback.delete') }}" style="display:inline;">
                            @csrf
                            @method('DELETE') <!-- Use DELETE method for the destroy route -->
                            <input type="hidden" name="id" id="banner_id"> <!-- Change 'user_id' to 'id' -->
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
  
    $(document).ready(function() {
        $('#deleteModal').on('show.bs.modal', function (e) {
            var userId = $(e.relatedTarget).data('id'); 
            $(this).find('#banner_id').val(userId); 
        });
        $('#addBannerButton').on('click', function () {
            $('#addBannerModal').modal('show'); 
        });
    });
</script>
@endpush



@endsection

