@extends('Web.layout.main')

@section('content')
<!-- <link rel="stylesheet" href="{{ asset('assets_web/css/profile.css') }}"> -->
<style>
    
.box {
    position: relative;
    /* width: 100%; */
    height: 550px;
    background: #1c1c1c;
    border-radius: 8px;
    overflow: hidden;
    padding: 10px;
}

.box::before{
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    /* width: 380px; */
    height: 420px;
    background: linear-gradient(0deg, transparent, transparent, #45f3ff, #45f3ff, #45f3ff);
    z-index: 1;
    transform-origin: bottom right;
    animation: animate 6s linear infinite;
}

.box::after{
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    /* width: 380px; */
    height: 420px;
    background: linear-gradient(0deg, transparent, transparent, #45f3ff, #45f3ff, #45f3ff);
    z-index: 1;
    transform-origin: bottom right;
    animation: animate 6s linear infinite;
    animation-delay: -3s;
}

.borderLine::before{
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 380px;
    height: 420px;
    background: linear-gradient(0deg, transparent, transparent, #ff2770, #ff2770, #ff2770);
    z-index: 1;
    transform-origin: bottom right;
    animation: animate 6s linear infinite;
    animation-delay: -1.5s;
}

.borderLine::after
{
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 380px;
    height: 420px;
    background: linear-gradient(0deg, transparent, transparent, #ff2770, #ff2770, #ff2770);
    z-index: 1;
    transform-origin: bottom right;
    animation: animate 6s linear infinite;
    animation-delay: -4.5s;
}


@keyframes animate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
    
}

.box form{
    position: absolute;
    inset: 4px;
    background: #222;
    padding: 50px 40px;
    border-radius: 8px;
    z-index: 2;
    display: flex;
    flex-direction: column;
}

.box form h2{
    color: #fff;
    font-weight: 500;
    text-align: center;
    letter-spacing: 0.1em;
}

.box form .inputBox{
    position: relative;
    width: 300px;
    margin-top: 35px;
}

.box form .inputBox input{
    position: relative;
    width: 100%;
    padding: 20px 10px 10px;
    background: transparent;
    outline: none;
    border: none;
    box-shadow: none;
    color: #23242a;
    font-size: 1em;
    letter-spacing: 0.05em;
    transition: 0.5s;
    z-index: 10;
}

.box form .inputBox span{
    position: absolute;
    left: 0;
    padding: 20px 0px 10px;
    pointer-events: none;
    color: #8f8f8f;
    font-size: 1em;
    letter-spacing: 0.05em;
    transition: 0.5s;
}

.box form .inputBox input:valid ~ span,
.box form .inputBox input:focus ~ span {
    color: #fff;
    font-size: 0.75em;
    transform: translateY((-34px));
}

.box form .inputBox i{
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 2px;
    background: #fff;
    border-radius: 4px;
    overflow: hidden;
    transition: 0.5s;
    pointer-events: none;
}

.box form .inputBox input:valid ~ i,
.box form .inputBox input:focus ~ i {
    height: 44px;
}

.box form .links{
    display: flex;
    justify-content: space-between;
}

.box form .links a{
    margin: 10px 0;
    font-size: 0.75em;
    color: #8f8f8f;
    text-decoration: none;
}

.box form .links a:hover,
.box form .links a:nth-child(2){
    color: #fff;
}

#submit{
    border: none;
    outline: none;
    padding: 9px 25px;
    cursor: pointer;
    font-size: 0.9em;
    border-radius: 4px;
    font-weight: 600;
    width: 100px;
    margin-top: 10px;
}

#submit:active{
    opacity: 0.8;
}



@keyframes borderAnimation {
    0% {
      border-color: #ccc;
    }
    50% {
      border-color: #007bff; /* Change to your desired color */
    }
    100% {
      border-color: #ccc;
    }
  }
  
  #profilePreview {
    animation: borderAnimation 2s linear infinite; /* Adjust the timing as needed */
  }
  
  .profile_change {
      background-image: radial-gradient(circle, #ff088d, #e18cae);
  }
  .head_profile {
      background-image: linear-gradient(to right, #8e2de2, #4a00e0); /* Purple gradient */
      -webkit-background-clip: text;
      color: transparent;
  }
</style>
<div class="content-body">

<div class="container-fluid mt-5">
<div class="d-flex row justify-content-center mt-5">
    <div class="col-md-6 col-lg-7 col-xl-7">
        <!-- <div class=" card profile_change mt-5 text-light"> -->
        <h2 class="fancy-heading ">{{ __('Update Account Details') }}</h2>
        <div class="box">

          <span class="borderLine"></span>



                <form method="POST" action="{{ route('user.updateprofile') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 text-center">
                        <input type="file" id="image" name="image" class="form-control d-none @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">

                        <!-- Default or Uploaded Image -->
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
