@extends('Web.layout.main')

@section('content')

<div class="content-body">
    <!-- Referral Program Section -->
    <div class="mt-5 pt-5">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-gradient text-white text-center">
                <h4><i class="fas fa-share-alt"></i> Referral Program</h4>
            </div>
            <div class="card-body">
                <!-- Referral Code Section -->
                @if($subcription)
                <div class="mb-4 text-center">
                    <h5 class="mb-3 text-primary"><i class="fas fa-link"></i> Your Referral Code</h5>
                    <div class="input-group justify-content-center">
                        <input 
                            type="text" 
                            id="referralCode" 
                            class="form-control w-75 text-center fs-5" 
                            value="{{ route('register', ['referral_code' => $referralCode]) }}" 
                            readonly>
                    </div>
                    <small class="text-muted mt-2 d-block">Share this link with your friends and earn rewards!</small>
                </div>

                <!-- Social Media Share Buttons -->
                <div class="text-center mt-4">
                    <h5 class="text-primary"><i class="fas fa-share-alt"></i> Share on Social Media</h5>
                    <div class="d-flex justify-content-center gap-1 mt-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('register', ['referral_code' => $referralCode])) }}" 
                           target="_blank" class="btn btn-facebook rounded-pill shadow-sm btn-md">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('register', ['referral_code' => $referralCode])) }}" 
                           target="_blank" class="btn btn-twitter rounded-pill shadow-sm btn-md">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode(route('register', ['referral_code' => $referralCode])) }}" 
                           target="_blank" class="btn btn-whatsapp rounded-pill shadow-sm btn-md">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="https://t.me/share/url?url={{ urlencode(route('register', ['referral_code' => $referralCode])) }}" 
                           target="_blank" class="btn btn-telegram rounded-pill shadow-sm btn-md">
                            <i class="fab fa-telegram-plane"></i> Telegram
                        </a>
                    </div>
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
                                        <th>Image</th>
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
                                            <td>
                                                <img src="{{ $referredUser->identity_image ? url('storage/app/public/' . $referredUser->identity_image) : asset('assets_web/images/profile/default.png') }}" width="100px" height="100px" alt="{{ $referredUser->name }}" style="border-radius: 30px;">
                                            </td>
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
                @else
                <div class="mb-4 text-center">
                   
                   
                    <div class="alert alert-warning mt-3 text-center">
                        <i class="fas fa-exclamation-circle"></i> You don't have any subscription plan so subscribe first then see your referral link.
                    </div>
                    
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

