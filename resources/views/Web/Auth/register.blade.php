@extends('Web.layout.main')

@section('content')
<div class="content-body">
<!-- row -->
<div class="container-fluid mt-5">
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header  justify-content-center"><h2>{{ __('Register') }}</h2></div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('registeruser') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label d-block text-start">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label d-block text-start">{{ __('Email') }}</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label d-block text-start">{{ __('Mobile Number') }}</label>
                        <input type="text" id="mobile" name="mob_number" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mob_number') }}" required>
                        @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label d-block text-start">{{ __('Profile Image') }}</label>
                        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label d-block text-start">{{ __('Password') }}</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Referral Code -->
                        <div class="mb-3">
                            <label for="referral_code" class="form-label d-block text-start">{{ __('Referral Code') }}</label>
                            <input 
                                type="text" 
                                id="referral_code" 
                                name="referral_code" 
                                class="form-control @error('referral_code') is-invalid @enderror" 
                                value="{{ request('referral_code') ?? old('referral_code') }}" 
                                {{ request('referral_code') ? '' : '' }}>
                            @error('referral_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                    <!-- Confirm Password -->
                    {{-- <div class="mb-3">
                        <label for="password_confirmation" class="form-label d-block text-start">{{ __('Confirm Password') }}</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div> --}}

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
                        <a href="{{ route('login') }}" class="btn btn-link">{{ __('Already have an account? Login') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
