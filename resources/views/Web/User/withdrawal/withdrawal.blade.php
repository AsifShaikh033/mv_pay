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
.styled-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }
    .styled-table th, .styled-table td {
        padding: 12px 15px;
        text-align: left;
    }
    .styled-table thead {
        background: linear-gradient(45deg, #6a57b1, #3f43c0);
        color: #ffffff;
    }
    .styled-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .styled-table tbody tr:hover {
        background-color: #ddd;
    }
    .status-pending { color: orange; }
    .status-success { color: green; }
    .status-rejected { color: red; }
</style>
<div class="content-body">
    <div class="container" style="margin-top:90px;">
     

        <div id="back-gradient" class="card  shadow-sm mt-5 mx-auto mb-5">
            <h5 class="modal-title">Add Bank details</h5>
            <form action="{{ route('user.requestWithdrawal') }}" method="POST" enctype="multipart/form-data" id="withdrawalForm">
                @csrf
                <input type="hidden" name="user_id" id="user_id" class="form-control text-quiz" value="{{ old('user_id', Auth::id()) }}" required>


                <div class="form-group mb-3">
                    <label for="upi_id" class="text-left">Amount</label>
                    <input type="text" name="amount" id="amount" class="form-control text-quiz" value="{{ old('amount') }}" required>
                </div>
    
                </div>


            <div class="form-group">
                <button type="submit" class="btn btn-danger btn-sm btn-block py-2">withdrawal</button>
            </div>
            </form>
        </div>
        <h4 class="text-center text-white">Withdrawal History</h4>
        <table class="styled-table table table-striped table-bordered">
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
                <td class="status-{{ strtolower($withdrawal->status) }}">{{ ucfirst($withdrawal->status) }}</td>
                <td>{{ $withdrawal->transaction_id }}</td>
                <td>{{ $withdrawal->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
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
