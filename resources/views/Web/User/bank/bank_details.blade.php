@extends('Web.layout.main')
@section('content')
<style>
    
.text-quiz {
    background: linear-gradient(45deg, #05004a, #0c00b3, #040040);
    border: 1px solid gold;
    border-radius: 5px;
    color: #ffffff;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.text-quiz:focus {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Enhanced shadow when focused */
    border-radius: 5px; /* Ensure border-radius remains the same on focus */
}

.text-quiz:disabled {
    background: #e0e0e0; /* Lighter background when disabled */
    color: #b0b0b0; /* Lighter text color when disabled */
    cursor: not-allowed; /* Change cursor to indicate disabled state */
}

a.transaction-title {
    position: absolute;
    bottom: 46px;
    right: 9px;
    font-size: 11px;
}
.form-group button {
    width: 100%;
    margin-bottom: 0px;
    background: linear-gradient(45deg, #ff6a00, #ee0979);
    border: none;
    border-radius: 20px;
    color: #fff;
    font-size: 16px;
    padding: 10px 20px;
    transition: all 0.3s ease;
    cursor: pointer;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
    margin-top: 10px;
}
#back-gradient {
    /* background: linear-gradient(219deg, #682087, #9c27b0, #fb25f9) !important; */
    background: linear-gradient(45deg, #6a57b1, #3f43c0, #5b4f9a) !important;
    color: white !important;
    border-radius: 8px !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3)!important;
}

#back-gradient .modal-header h4 {
    color: white;
}
</style>
<div class="content-body">
    <div class="container" style="margin-top:90px;">
     

        <div id="back-gradient" class="card  shadow-sm mt-5 mx-auto mb-5">
            <h5 class="modal-title">Add Bank details</h5>
            <form action="{{ route('user.save.bank.details') }}" method="POST" enctype="multipart/form-data" id="withdrawalForm">
                @csrf
                <input type="hidden" name="user_id" id="user_id" class="form-control text-quiz" value="{{ old('user_id', Auth::id()) }}" required>


                <div class="form-group mb-3">
                    <label for="upi_id" class="text-left">UPI ID:</label>
                    <input type="text" name="upi_id" id="upi_id" class="form-control text-quiz" value="{{ old('upi_id', $bankDetail->upi_id ?? '') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="account_holder_name">Account Holder Name:</label>
                    <input type="text" name="account_holder_name" id="account_holder_name" class="form-control text-quiz" value="{{ old('account_holder_name', $bankDetail->account_holder_name ?? '') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="bank_name">Bank Name:</label>
                    <input type="text" name="bank_name" id="bank_name" class="form-control text-quiz" value="{{ old('bank_name', $bankDetail->bank_name ?? '') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="branch_name">Branch Name:</label>
                    <input type="text" name="branch_name" id="branch_name" class="form-control text-quiz" value="{{ old('branch_name', $bankDetail->branch_name ?? '') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="ifsc_code">IFSC Code:</label>
                    <input type="text" name="ifsc_code" id="ifsc_code" class="form-control text-quiz" value="{{ old('ifsc_code', $bankDetail->ifsc_code ?? '') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="account_number">Account Number:</label>
                    <input type="text" name="account_number" id="account_number" class="form-control text-quiz" value="{{ old('account_number', $bankDetail->account_number ?? '') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="status">Status:</label>
                    <select name="status" id="status" class="form-control text-quiz" required>
                        <option value="1" {{ old('status', $bankDetail->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $bankDetail->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Barcode Upload -->
                <div class="form-group mb-3">
    <label for="barcode_image">Barcode Image:</label>
    
    <!-- QR Code upload button -->
    <div style="border: 2px dashed #ffffff; padding: 20px; border-radius: 10px; text-align: center; cursor: pointer;">
        <label for="barcode_image" style="display: block; color: #ffffff; font-size: 16px; font-weight: bold; cursor: pointer;">
            <i class="fas fa-cloud-upload-alt" style="font-size: 36px; margin-bottom: 10px;"></i><br>
            Click to Upload
        </label>
        <small style="color: #c9c0c0; display: block; margin-top: 5px;">Supported formats: JPG, PNG, SVG</small>
    </div>

    <!-- Hidden file input -->
    <input type="file" name="barcode_image" id="barcode_image" class="form-control text-quiz" style="display: none;" onchange="previewImage(event)">

    <!-- Preview uploaded barcode image -->
    <div id="imagePreview" class="mt-3">
        @if(isset($bankDetail->barcode))
            <img 
                src="{{ $bankDetail->barcode ? url('storage/app/public/' . $bankDetail->barcode) : asset('assets_web/images/profile/default.png') }}"
                alt="Barcode Image" 
                class="img-fluid" style="max-width: 200px;">

            @endif
    </div>
</div>


            <div class="form-group">
                <button type="submit" class="btn btn-danger btn-sm btn-block py-2">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Function to show the uploaded image as a preview
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                imagePreview.innerHTML = `
                    <img src="${reader.result}" alt="Barcode Image" class="img-fluid" style="max-width: 200px;">
                   
                `;
            };
            reader.readAsDataURL(file);
        }
    }

</script>
@endsection
