@extends('Web.layout.main')

@section('content')

<style>
    
.boxs {
    position: relative;
    width: 100%;
    height: 750px;
    background: #1c1c1c;
    border-radius: 8px;
    overflow: hidden;
    padding: 10px;
}

.boxs::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
   
    height: 420px;
    background: linear-gradient(0deg, transparent, transparent, #45f3ff, #45f3ff, #45f3ff);
    z-index: 1;
    transform-origin: bottom right;
    animation: animate 6s linear infinite;
}

.boxs::after{
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
   
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

.boxs form{
    position: absolute;
    inset: 4px;
    background: linear-gradient(90deg, #161b5c, #930125);
    padding: 50px 40px;
    border-radius: 8px;
    z-index: 2;
    display: flex;
    flex-direction: column;
}

.boxs form h2{
    color: #fff;
    font-weight: 500;
    text-align: center;
    letter-spacing: 0.1em;
}

.boxs form .inputboxs{
    position: relative;
    width: 300px;
    margin-top: 35px;
}

.boxs form .inputboxs input{
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

.boxs form .inputboxs span{
    position: absolute;
    left: 0;
    padding: 20px 0px 10px;
    pointer-events: none;
    color: #8f8f8f;
    font-size: 1em;
    letter-spacing: 0.05em;
    transition: 0.5s;
}

.boxs form .inputboxs input:valid ~ span,
.boxs form .inputboxs input:focus ~ span {
    color: #fff;
    font-size: 0.75em;
    transform: translateY((-34px));
}

.boxs form .inputboxs i{
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

.boxs form .inputboxs input:valid ~ i,
.boxs form .inputboxs input:focus ~ i {
    height: 44px;
}

.boxs form .links{
    display: flex;
    justify-content: space-between;
}

.boxs form .links a{
    margin: 10px 0;
    font-size: 0.75em;
    color: #8f8f8f;
    text-decoration: none;
}

.boxs form .links a:hover,
.boxs form .links a:nth-child(2){
    color: #fff;
}
.boxs_store{
    color:white;
}

.boxs_store label {
    font-size: 20px;
}
.fancy-heading {
    font-size: 2.5rem; 
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    background: linear-gradient(45deg, #ffcc33, #ffffff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent; /* Gradient text effect */
    text-shadow: 2px 2px 10px rgba(255, 200, 0, 0.8); /* Fancy shadow */
    font-family: 'Poppins', sans-serif;
    margin-bottom: 20px;
    transition: all 0.3s ease-in-out;
}


/* Hover effect */
.fancy-heading:hover {
    text-shadow: 4px 4px 20px rgba(255, 200, 0, 1);
    transform: scale(1.1); /* Slight zoom effect */
}
</style>
<div class="content-body">
<!-- row -->
<div class="container-fluid mt-5">
<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-6 col-lg-12 col-xl-12">
       
           
            <h2 class="fancy-heading">{{ __('Register') }}</h2>
           

            <div class="boxs">
          
          <span class="borderLine"></span>
                <form method="POST" action="{{ route('registeruser') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 boxs_store">
                        <label for="name" class="form-label d-block text-start">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 boxs_store">
                        <label for="email" class="form-label d-block text-start">{{ __('Email') }}</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 boxs_store">
                        <label for="mobile" class="form-label d-block text-start">{{ __('Mobile Number') }}</label>
                        <input type="text" id="mobile" name="mob_number" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mob_number') }}" required>
                        @error('mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-3 boxs_store">
                        <label for="image" class="form-label d-block text-start">{{ __('Profile Image') }}</label>
                        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3 boxs_store">
                        <label for="password" class="form-label d-block text-start">{{ __('Password') }}</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Referral Code -->
                        <div class="mb-3 boxs_store">
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
                    {{-- <div class="mb-3 boxs_store">
                        <label for="password_confirmation" class="form-label d-block text-start">{{ __('Confirm Password') }}</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div> --}}

                    <div class="">
                        <button type="submit" class="btn btn-primary w-100 h-25">{{ __('Register') }}</button>
                        <a href="{{ route('login') }}" class="btn btn-link text-light text-center w-100">{{ __('Already have an account? Login') }}</a>
                    </div>
                </form>
            </div>
        </div>
   
</div>
</div>
</div>
@endsection
