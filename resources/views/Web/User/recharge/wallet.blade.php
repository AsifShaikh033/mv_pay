@extends('Web.layout.main')

@section('content')

<style>
    .card-img {
    max-width: 100%;
    height: auto;
    object-fit: contain;
}

.whole_container{
    margin-top:100px;
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
}

textarea {
    border: 2px solid blue;
    border-radius: 5px;
    padding: 10px;
    font-size: 16px;
    width: 100%;
    margin-top: 10px;
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
    background-image: url('{{ asset('assets_web/images/wallet/8.jpg') }}');
    background-size: cover; 
    background-position: center; 
   
}


</style>

<div class="content-body">

<div class="container whole_container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <!-- First Card -->
            <div class="card wallet_back mb-4">
                <div class="card-body">
                    <div class="container">
                        <img src="{{ asset('assets_web/images/wallet/1.png') }}" class="card-img" style="width:100px!important; height;100px;!important" alt="">
                        <img src="{{ asset('assets_web/images/wallet/2.png') }}" class="card-img" style="width:100px!important; height;100px;!important" alt="">
                    </div>
                    <div class="container">
                        <img src="{{ asset('assets_web/images/wallet/3.png') }}" class="card-img" style="width:100px!important; height;100px;!important" alt="">
                        <img src="{{ asset('assets_web/images/wallet/4.png') }}" class="card-img" style="width:100px!important; height;100px;!important" alt="">
                    </div>
                    <div class="container">
                    
                        <div class="search-box">
                            <i class="fas fa-search search-icon"></i>
                            <input type="search" id="search" placeholder="Search...">
                            <i class="fas fa-microphone mic-icon"></i>
                        </div>
                        <textarea id="text" cols="30" rows="10" placeholder="Type your text..."></textarea>
                

                        <!-- <img src="{{ asset('assets_web/images/wallet/7.png') }}" class="card-img" style="width:100px!important; height;100px;!important" alt=""> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





</div>
@endsection

