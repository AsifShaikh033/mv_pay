@extends('Web.layout.main')

@section('content')
<link rel="stylesheet" href="{{ asset('assets_web/css/profile.css') }}">

<div class="content-body">
      <!-- row -->
      <div class="container-fluid mt-5">
      <div class="d-flex row justify-content-center mt-5">
      <div class="col-md-6 col-lg-7 col-xl-7">
        <!-- <div class=" card profile_change mt-5 text-light"> -->
        <h2 class="fancy-heading ">{{ __('Update Account Details') }}</h2>
        <div class="box">
          
          <span class="borderLine"></span>



                <form method="POST" action="{{ route('user.updateprofile') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 box_store text-center">
                        <input type="file" id="image" name="image" class="form-control d-none @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">


                        <label for="image" class="d-inline-block">
                            <img id="profilePreview"
                                src="{{ $data->identity_image ? url('storage/app/public/' . $data->identity_image) : asset('assets_web/images/profile/default.png') }}"
                                alt="Profile Image"
                                class="img-fluid rounded-circle"
                                style="cursor: pointer; width: 120px; height: 120px; object-fit: cover; border: 2px solid #ccc;">
                        </label>

                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 box_store">
                        <label for="name" class="form-label d-block text-start">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"  value="{{$data->name}}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 box_store">
                        <label for="email" class="form-label d-block text-start">{{ __('Email') }}</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$data->email}}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 box_store">
                        <label for="mobile" class="form-label d-block text-start">{{ __('Mobile Number') }}</label>
                        <input type="text" id="mobile" name="mob_number" class="form-control @error('mobile') is-invalid @enderror" value="{{$data->mob_number}}" required>
                        @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="mb-3 box_store">
                        <label for="password" class="form-label d-block text-start">{{ __('Password') }}</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-info w-100 h-100">{{ __('Update') }}</button>
                    </div>
                </form>

        </div>
    </div>
</div>
</div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('profilePreview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
