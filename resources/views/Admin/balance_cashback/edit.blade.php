@extends('Admin.layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Balance Cashback Setting</h3>
            <ul class="breadcrumbs mb-3">
                <!-- <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li> -->
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"> Details</div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    </div>
                    <div class="card-body">
                      <form action="{{ route('admin.balance.cashback.update', $Data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="logo">Balance</label>
                                        <input type="number" name="balance" id="bannerImage" class="form-control" value="{{ $Data->balance}}">
                                    </div>
                                </div>
                               
                                <div class="col-md-6 col-lg-8">
                                <div class="form-group mb-3">
                                    <label for="priority" class="form-label">Cashback</label>
                                    <input type="number" name="cashback" value="{{ $Data->cashback}}" id="priority" class="form-control"  placeholder="Enter cashback">
                                </div>
                                </div>
                                <div class="col-md-6 col-lg-8">
                                <div class="form-group">
                                <label for="">Select Ctegory</label>
                                <select class="form-control" required="required" name="category" id="category"> 
                                    <option value="">Select</option>
                                    <option value="electricity" @if($Data->category == 'electricity') selected @endif>Electricity</option>
                                    <option value="postpaid" @if($Data->category == 'postpaid') selected @endif>Postpaid </option>
                                    <option value="landline" @if($Data->category == 'landline') selected @endif>Landline</option>
                                    <option value="broadband" @if($Data->category == 'broadband') selected @endif>Broadband</option>
                                    <option value="gas_piped" @if($Data->category == 'gas_piped') selected @endif>GAS Piped</option>
                                    <option value="insurance_service" @if($Data->category == 'insurance_service') selected @endif>Insurance Service</option>
                                    <option value="water_service" @if($Data->category == 'water_service') selected @endif>Water Service</option>
                                    <option value="fastag_recharge" @if($Data->category == 'fastag_recharge') selected @endif>Fastag Recharge</option>
                                    <option value="loan_repayment" @if($Data->category == 'loan_repayment') selected @endif>Loan Repayment</option>
                                    <option value="gas_cylinder" @if($Data->category == 'gas_cylinder') selected @endif>Gas Cylinder</option>
                                    <option value="municipal_services" @if($Data->category == 'municipal_services') selected @endif>Municipal Services</option>
                                    <option value="municipal_tax" @if($Data->category == 'municipal_tax') selected @endif>Municipal Tax</option>
                                    <option value="housing_society" @if($Data->category == 'housing_society') selected @endif>Housing Society</option>
                                    <option value="cable_tv" @if($Data->category == 'cable_tv') selected @endif>Cable TV</option>
                                    <option value="clubs_and_associations" @if($Data->category == 'clubs_and_associations') selected @endif>Clubs and Associations</option>
                                    <option value="education_fees" @if($Data->category == 'education_fees') selected @endif>Education Fees</option>
                                    <option value="hospital" @if($Data->category == 'hospital') selected @endif>Hospital</option>
                                    <option value="credit_card" @if($Data->category == 'credit_card') selected @endif>Credit Card</option>
                                    <option value="donation" @if($Data->category == 'donation') selected @endif>Donation</option>
                                    <option value="recurring_deposit" @if($Data->category == 'recurring_deposit') selected @endif>Recurring Deposit</option>
                                    <option value="rental_services" @if($Data->category == 'rental_services') selected @endif>Rental Services</option>
            
                                    </select>
                                </div>
                                </div>

                                <div class="col-md-6 col-lg-8">
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1" {{ $Data->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $Data->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
