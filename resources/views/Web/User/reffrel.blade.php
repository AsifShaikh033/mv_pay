@extends('Web.layout.main')

@section('content')
<div class="content-body">
    <!-- Referral Program Section -->
    <div class="mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary  text-center">
                <h3>Referral</h3>
            </div>
            <div class="card-body">
                <!-- Referral Code Section -->
                <div class="mb-4 text-center">
                    <h5 class="mb-3 text-primary"><i class="fas fa-share-alt"></i> Your Referral Code</h5>
                    <div class="input-group justify-content-center">
                        <input 
                            type="text" 
                            id="referralCode" 
                            class="form-control w-50 text-center" 
                            value="{{ route('register', ['referral_code' => $referralCode]) }}" 
                            readonly>
                        <button 
                            id="copyButton" 
                            class="btn btn-primary ms-2" 
                            onclick="copyReferralCode()">
                            Copy Link
                        </button>
                    </div>
                    <small class="text-muted mt-2 d-block">Share this link with your friends and earn rewards!</small>
                </div>

                <!-- List of Referred Users -->
                <div class="mt-4">
                    <h5 class="text-primary"><i class="fas fa-users"></i> Referred Users</h5>
                    @if($referredUsers->isEmpty())
                        <div class="alert alert-warning mt-3 text-center">
                            <i class="fas fa-exclamation-circle"></i> No users have registered using your referral code yet.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Registration Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($referredUsers as $key => $referredUser)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $referredUser->name }}</td>
                                            <td>{{ $referredUser->email }}</td>
                                            <td>{{ $referredUser->mob_number }}</td>
                                            <td>{{ $referredUser->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyReferralCode() {
        const referralInput = document.getElementById('referralCode');
        const copyButton = document.getElementById('copyButton');

        referralInput.select();
        referralInput.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(referralInput.value).then(() => {
            copyButton.textContent = 'Copied!';
            copyButton.classList.remove('btn-primary');
            copyButton.classList.add('btn-success');
            setTimeout(() => {
                copyButton.textContent = 'Copy Link';
                copyButton.classList.remove('btn-success');
                copyButton.classList.add('btn-primary');
            }, 2000);
        });
    }
</script>
@endsection
