@extends('Web.layout.main')

@section('content')
<div class="content-body">
    <!-- row -->
    <div class="mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Referral Program</h3>
            </div>
            <div class="card-body">
                <!-- Referral Code Section -->
                <div class="mb-4">
                    <h5>Your Referral Code</h5>
                    <div class="input-group">
                      <input 
                          type="text" 
                          id="referralCode" 
                          class="form-control" 
                          value="{{ route('register', ['referral_code' => $referralCode]) }}" 
                          readonly>
                      <button 
                          id="copyButton" 
                          class="btn btn-primary" 
                          onclick="copyReferralCode()">
                          Copy Link
                      </button>
                  </div>
                </div>

                <!-- List of Referred Users -->
                <div class="mt-4">
                    <h5>Referred Users</h5>
                    @if($referredUsers->isEmpty())
                        <p>No users have registered using your referral code yet.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
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
