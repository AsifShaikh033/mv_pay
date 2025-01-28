@extends('Web.layout.main')

@section('content')
<div class="content-body">
<!-- row -->
<div class="container-fluid mt-5">
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class=" card mt-5">
            <div class="card-header  justify-content-center"><h2>{{ __('Profile') }}</h2></div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('user.updateprofile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label d-block text-start">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name" class="form-control"  autofocus value="{{$data->name}}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label d-block text-start">{{ __('Email') }}</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$data->email}}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label d-block text-start">{{ __('Mobile Number') }}</label>
                        <input type="text" id="mobile" name="mob_number" class="form-control @error('mobile') is-invalid @enderror" value="{{$data->mob_number}}" required>
                        @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label d-block text-start">{{ __('Profile Image') }}</label>
                        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @if($data->identity_image)
                                        <img src="{{ asset('storage/' . $data->identity_image) }}" alt="Logo" class="img-fluid" height="120px" width="120px"/>
                                        @endif
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label d-block text-start">{{ __('Password') }}</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
