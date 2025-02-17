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
                                        <option value="Prepaid-Mobile" @if($Data->category == 'Prepaid-Mobile') selected @endif>Prepaid-Mobile</option>
                                        <option value="Broadband" @if($Data->category == 'Broadband') selected @endif>Broadband</option>
                                        <option value="DTH" @if($Data->category == 'DTH') selected @endif>DTH</option>
                                        <option value="Landline-Postpaid" @if($Data->category == 'Landline-Postpaid') selected @endif>Landline Postpaid</option>
                                        <option value="Electricity" @if($Data->category == 'Electricity') selected @endif>Electricity</option>
                                        <option value="GAS" @if($Data->category == 'GAS') selected @endif>GAS</option>
                                        <option value="Insurance" @if($Data->category == 'Insurance') selected @endif>Insurance</option>
                                        <option value="DMR" @if($Data->category == 'DMR') selected @endif>DMR</option>
                                        <option value="Water" @if($Data->category == 'Water') selected @endif>Water</option>
                                        <option value="PAN-UTI-Token-Based" @if($Data->category == 'PAN-UTI-Token-Based') selected @endif>PAN UTI - Token Based</option>
                                        <option value="Loan-Repayment" @if($Data->category == 'Loan-Repayment') selected @endif>Loan Repayment</option>
                                        <option value="Education-Fees" @if($Data->category == 'Education-Fees') selected @endif>Education Fees</option>
                                        <option value="METRO-CARD-RECHARGE" @if($Data->category == 'METRO-CARD-RECHARGE') selected @endif>METRO CARD RECHARGE</option>
                                        <option value="CHALLAN" @if($Data->category == 'CHALLAN') selected @endif>CHALLAN</option>
                                        <option value="Mobile-Postpaid" @if($Data->category == 'Mobile-Postpaid') selected @endif>Mobile Postpaid</option>
                                        <option value="Municipal-Services" @if($Data->category == 'Municipal-Services') selected @endif>Municipal Services</option>
                                        <option value="Life-Insurance" @if($Data->category == 'Life-Insurance') selected @endif>Life Insurance</option>
                                        <option value="Housing-Society" @if($Data->category == 'Housing-Society') selected @endif>Housing Society</option>
                                        <option value="Municipal-Taxes" @if($Data->category == 'Municipal-Taxes') selected @endif>Municipal Taxes</option>
                                        <option value="Health-Insurance" @if($Data->category == 'Health-Insurance') selected @endif>Health Insurance</option>
                                        <option value="LPG-Gas" @if($Data->category == 'LPG-Gas') selected @endif>LPG Gas</option>
                                        <option value="Cable-TV" @if($Data->category == 'Cable-TV') selected @endif>Cable TV</option>
                                        <option value="Hospital" @if($Data->category == 'Hospital') selected @endif>Hospital</option>
                                        <option value="Subscription" @if($Data->category == 'Subscription') selected @endif>Subscription</option>
                                        <option value="Credit-Card" @if($Data->category == 'Credit-Card') selected @endif>Credit Card</option>
                                        <option value="PayService" @if($Data->category == 'PayService') selected @endif>PayService</option>
                                        <option value="OTT-Subscription" @if($Data->category == 'OTT-Subscription') selected @endif>OTT Subscription</option>
                                        <option value="IRCTC-Dongle-Based" @if($Data->category == 'IRCTC-Dongle-Based') selected @endif>IRCTC - Dongle Based</option>
                                        <option value="Clubs-and-Associations" @if($Data->category == 'Clubs-and-Associations') selected @endif>Clubs and Associations</option>
                                        <option value="Broadband-Postpaid" @if($Data->category == 'Broadband-Postpaid') selected @endif>Broadband Postpaid</option>
                                        <option value="Axis-Bank-Saving-Account" @if($Data->category == 'Axis-Bank-Saving-Account') selected @endif>Axis Bank Saving A/c</option>
                                        <option value="Fastag" @if($Data->category == 'Fastag') selected @endif>Fastag</option>
                                        <option value="Google-Play" @if($Data->category == 'Google-Play') selected @endif>Google Play</option>
                                        <option value="Recurring-Deposit" @if($Data->category == 'Recurring-Deposit') selected @endif>Recurring Deposit</option>
                                        <option value="Rental" @if($Data->category == 'Rental') selected @endif>Rental</option>
                                        <option value="Hospital-and-Pathology" @if($Data->category == 'Hospital-and-Pathology') selected @endif>Hospital and Pathology</option>
                                        <option value="Donation" @if($Data->category == 'Donation') selected @endif>Donation</option>
                                        <option value="NCMC-Recharge" @if($Data->category == 'NCMC-Recharge') selected @endif>NCMC Recharge</option>
                                        <option value="Prepaid-Meter" @if($Data->category == 'Prepaid-Meter') selected @endif>Prepaid Meter</option>
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
