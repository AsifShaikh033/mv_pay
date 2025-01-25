@extends('Web.layout.main') 
@section('content') 
    <div class="content-body">
      <!-- row -->
      <div class="container-fluid mt-5">
      <div class="row justify-content-center">
      <div class="col-md-6 col-lg-12 col-xl-12">
        <div class="card">

            <div class="card-header  justify-content-center"><h2>{{ __('Login') }}</h2></div>
            <div class="card-body">
                <form method="POST" action="{{ route('loginuser') }}" enctype="multipart/form-data">
                    @csrf

                
                    <div class="mb-3">
                        <label for="email" class="form-label d-block text-start">{{ __('Mobile') }}</label>
                        <input type="number" id="email" name="mob_number" class="form-control @error('mob_number') is-invalid @enderror" value="{{ old('mob_number') }}" required>
                        @error('mob_number')
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


                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                        <a href="{{ route('register') }}" class="btn btn-link">{{ __('Not have an account? Register') }}</a>
                    </div>
                </form>
            </div>

            </div>
            </div>


    </div>
  </div>
  </div>
  @endsection
