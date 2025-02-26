@extends('Web.layout.main')

@section('content')

<style>
    .card-img {
    max-width: 100%;
    height: auto;
    object-fit: contain;
}

.whole_container {
    margin-top: 100px !important;
}

/* Basic styling for the input and textarea */
.input-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
    width: 300px;
}

.search-box {
    position: relative;
}

input[type="search"] {
    width: 100%;
    padding: 10px 40px 10px 30px; /* Padding for icons */
    border: 2px solid blue;
    border-radius: 5px;
    font-size: 16px;
    border-radius:15px;
}


/* Position the icons inside the input */
.search-icon, .mic-icon {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: blue;
}

.search-icon {
    left: 10px;
}

.mic-icon {
    right: 10px;
}

/* Focus effect for input and textarea */
input[type="search"]:focus, textarea:focus {
    border-color: darkblue;
    outline: none;
}
.wallet_back {
    margin-bottom: 80px;
}  

.solid {
    padding: 10px;
    display: flex;
    background-image:  url('{{ asset('assets_web/images/wallet/back_1.gif') }}');
    background-size: cover;
    background-position: center;
    align-items: flex-end;
    justify-content: space-between;
}
.solid_1 {
    padding:10px;
    display: flex;
    background-image: url('{{ asset('assets_web/images/wallet/back_2.gif') }}');
    background-size: cover; 
    background-position: center; 
}
.solid_2 {
    padding: 50px;
    background-image:  url('{{ asset('assets_web/images/wallet/back_3.gif') }}');
    background-size: cover;
    background-position: center;
}

@media screen and (max-width: 400px) {
    .content-body .container {
        margin-top: 90px;
    }
}
.budget_img {
    width: 100%;
    background-color: white;
    border: 2px solid blue;
    margin-top: 10px;
    border-radius: 15px;
}

.budget_img img{
    width: 100% !important;
    padding: 50px;
}
</style>

<div class="content-body">

<div class="container whole_container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <!-- First Card -->
            <div class=" wallet_back mb-4">
                <div class="">
                    <div class="solid">
                        <img src="{{ asset('assets_web/images/wallet/1.png') }}"  style="width:50%!important; height;100px;!important" alt="">
                        <img src="{{ asset('assets_web/images/wallet/2.png') }}" style="width: 30%!important;height: 200px;" alt="">
                    </div>
                    <div class="solid_1">
                        <img src="{{ asset('assets_web/images/wallet/3a.png') }}"  style="width:50%!important; height;100px;!important" alt="">
                        <img src="{{ asset('assets_web/images/wallet/4a.png') }}"  style="width:50%!important; height;100px;!important" alt="">
                    </div>
                    <div class="solid_2">
                    
                        <div class="search-box text-center">
                            <!-- <i class="fas fa-search search-icon"></i>
                            <input type="search" id="search" placeholder="Search...">
                            <i class="fas fa-microphone mic-icon"></i> -->
                            <button onclick="window.location='{{route('user.withdrawal')}}'" class="btn btn-primary">Withdrawal</button>
                        </div>
                        <!-- <textarea id="text" cols="30" rows="10" placeholder="Type your text..."></textarea> -->
                        <div class='budget_img'>
                        <img src="{{ asset('assets_web/images/wallet/15.png') }}"   alt="">
                        </div>

                        <!-- <img src="{{ asset('assets_web/images/wallet/7.png') }}" class="card-img" style="width:100px!important; height;100px;!important" alt=""> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





</div>
@endsection

