@extends('Web.layout.main')
@section('content')
<div class="content-body">
    <div class="container" style="margin-top:90px;">
      

        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="card  shadow-sm w-75 mt-5 mx-auto">
            <h5>Add Bank details</h5>
            <form action="{{ route('user.save.bank.details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ old('user_id', Auth::id()) }}" required>


                <div class="form-group mb-3">
                    <label for="upi_id">UPI ID:</label>
                    <input type="text" name="upi_id" id="upi_id" class="form-control" value="{{ old('upi_id', $bankDetail->upi_id ?? '') }}" required>
                </div>

                <!-- <div class="form-group mb-3">
                    <label for="account_holder_name">Account Holder Name:</label>
                    <input type="text" name="account_holder_name" id="account_holder_name" class="form-control" value="{{ old('account_holder_name', $bankDetail->account_holder_name ?? '') }}" required>
                </div> -->

                <!-- <div class="form-group mb-3">
                    <label for="bank_name">Bank Name:</label>
                    <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{ old('bank_name', $bankDetail->bank_name ?? '') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="branch_name">Branch Name:</label>
                    <input type="text" name="branch_name" id="branch_name" class="form-control" value="{{ old('branch_name', $bankDetail->branch_name ?? '') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="ifsc_code">IFSC Code:</label>
                    <input type="text" name="ifsc_code" id="ifsc_code" class="form-control" value="{{ old('ifsc_code', $bankDetail->ifsc_code ?? '') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="account_number">Account Number:</label>
                    <input type="text" name="account_number" id="account_number" class="form-control" value="{{ old('account_number', $bankDetail->account_number ?? '') }}" required>
                </div> -->

                <div class="form-group mb-3">
                    <label for="status">Status:</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="1" {{ old('status', $bankDetail->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $bankDetail->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Barcode Upload -->
                <div class="form-group mb-3">
                    <label for="barcode_image">Barcode Image:</label>
                    <input type="file" name="barcode_image" id="barcode_image" class="form-control" onchange="previewImage(event)">
                    
                    <!-- Preview uploaded barcode image -->
                    <div id="imagePreview" class="mt-3">
                        @if(isset($bankDetail->barcode))
                      
                            <img src="{{ url('storage/app/private/public/barcodes/'.$bankDetail->barcode) }}" alt="Barcode Image" class="img-fluid" style="max-width: 200px;">
                            <button type="button" class="btn btn-danger btn-sm mt-2" onclick="deleteImage()">Delete Image</button>
                        @endif
                    </div>
                </div>

                <!-- Buttons -->
                <button type="submit" class="btn btn-primary btn-block py-2">Save</button>

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
                    <button type="button" class="btn btn-danger mt-2" onclick="deleteImage()">Delete Image</button>
                `;
            };
            reader.readAsDataURL(file);
        }
    }

    // Function to delete the uploaded image from the preview
    function deleteImage() {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = '';  // Remove the image and the delete button
        document.getElementById('barcode_image').value = '';  // Clear the file input
    }
</script>
@endsection
