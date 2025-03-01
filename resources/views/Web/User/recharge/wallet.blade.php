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
    padding: 15px 50px;
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
.amount-overlay {
    position: absolute;
    top: 54%;
    left: 54%;
    transform: translate(-50%, -50%);
    background: #31a3d1;
    color: #fff;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 18px;
    font-weight: bold;
}
.amount1-overlay {
    position: absolute;
    top: 54%;
    left: 71%;
    transform: translate(-50%, -50%);
    background: #fd3f61;
    color: #fff;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 18px;
    font-weight: bold;
}
.amount2-overlay {
    position: absolute;
    top: 69%;
    left: 62%;
    transform: translate(-50%, -50%);
    background: #d3d33b;
    color: #fff;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 18px;
    font-weight: bold;
}
.user-balance-overlay {
    position: absolute;
    margin-bottom: 181px;
    left: 71%;
    transform: translate(-50%, -50%);
    background: #111195;
    color: #fff;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 18px;
    font-weight: bold;
}
/* Mobile responsiveness */
@media screen and (max-width: 768px) {
    .amount-overlay, .amount1-overlay, .amount2-overlay {
        font-size: 14px;
        padding: 8px 15px;
    }

    .amount-overlay {
        top: 50%;
        left: 50%;
    }

    .amount1-overlay {
        top: 50%;
        left: 65%;
    }

    .amount2-overlay {
        top: 65%;
        left: 55%;
    }
}

@media screen and (max-width: 480px) {
    .amount-overlay, .amount1-overlay, .amount2-overlay {
        font-size: 12px;
        padding: 6px 10px;
    }

    .amount-overlay {
        top: 56%;
        left: 29%;
    }

    .amount1-overlay {
        top: 56%;
        left: 68%;
    }

    .amount2-overlay {
        top: 74%;
        left: 50%;
    }

    
    .user-balance-overlay {
    /* right: 5%; */
    transform: translate(0, 29%);
    padding: 8px 16px;
    font-size: 12px;
    top: 30%;
    margin-bottom: 100px;
    border-radius: 8px;
    left: 27%;
}

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
                        <div class="user-balance-overlay">User Balance: {{ number_format($userBalance, 2) }}</div>
                    </div>
                    <div class="solid_1">
                        <img src="{{ asset('assets_web/images/wallet/3a.png') }}"  style="width:50%!important; height;100px;!important" alt="">
                        <div class="amount-overlay">{{ number_format($spinWinTotal, 2) }}</div>
                        <img src="{{ asset('assets_web/images/wallet/4a.png') }}"  style="width:50%!important; height;100px;!important" alt="">
                        <div class="amount1-overlay">{{ number_format($referredBalance, 2) }}</div>
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
                        <div class="amount2-overlay">Total: {{ number_format($total, 2) }}</div>
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

