@extends('Web.layout.main')

@section('content')
<style>
    @media (max-width: 767px) {
        .mobile-h-25 {
            height: 25% !important;
        }

    }
</style>
<style>
      .large-content img {
        width: 100% !important;
}
.large-content h3 {
    font-size: 40px;
    font-weight: bold;
}
.large-content h1 {
    font-size: 36px;
    font-weight: bold;
}
        
        /* Main section */
        .snow {
            margin-bottom:20px;
    display: flex;
    /* align-items: center; */
    justify-content: center;
    padding: 20px;
    border-radius: 10px;
    background: linear-gradient(to right, black, blue);
    text-align: center;
}

        /* Trophy section */
        .shows img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }


        .d-flex {
            flex-direction: column !important;
        }

        .card-text {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .justify-content-between {
            justify-content-center !important;
        }
    }

    .snow {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        border-radius: 10px;
        background: linear-gradient(to right, black, blue);
        text-align: center;
    }


      
        .trophy {
    width: 50%;
    /* height: 50%; */
}
        .showss img{
            width:30%;
           
        }

        @media (max-width: 400px) {
            .showss img {
                    width: 30%;
                }
                .showss h2 a {
                    font-size: 15px;
                }        
            .showss h3 {
                font-size: 13px;
            }
            .showss p {
    font-size: 10px;
    margin: 0px;
}
            .showss h1 {
                font-size: 20px !important;
                margin:0px;
            }
            .large-content h1 {
                font-size: 36px !important;
                font-weight: bold !important;
            }

    }
  

    .showss {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .showss h2 {
        font-size: 24px;
        font-weight: bold;
       
    }

    .showss h1 {
        font-size: 40px;
        font-weight: bold;
        color: #FFD700;
    }


    .showss a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

    .trophy {
        width: 50%;
        /* height: 50%; */
    }
</style>

<div class="content-body">
<div class="container py-4">
    <h2 class="text-light text-center mb-4 mt-5">{{ $reportTitle }}</h2>

    <div class="container">
    <div class="snow">
            <img src="{{ asset('assets_web/images/others_services/trophy.png') }}" class="trophy" alt="Trophy">

            <div class="showss">


                <img src="{{ asset('assets_web/images/others_services/spin.png') }}" alt="Spin Wheel">
                <h2>
                    <a href="https://mvvision.in/student/spin-mv-pay" target="_blank">
                        Click here
                    </a>
                </h2>
                <p>
                    <a href="https://mvvision.in/student/spin-mv-pay" target="_blank">
                        https://mvvision.in/student/spin-mv-pay
                    </a>
                </p>

                <h3>You have received</h3>
                <h1>Spin Cashback</h1>
            </div>
        </div>
    @if($transactions->isEmpty())
       
        @else
        @foreach($transactions as $index => $transaction)
        <div class="snow">
            <img src="{{ asset('assets_web/images/others_services/trophy.png') }}" class="trophy" alt="Trophy">

            <div class="showss">
                @if($index === 0)
                    <!-- <h2>
                        <a href="https://mvvision.in/student/spin-mv-pay" target="_blank">
                            Click here
                        </a>
                    </h2>
                    <p>
                        <a href="https://mvvision.in/student/spin-mv-pay" target="_blank">
                            https://mvvision.in/student/spin-mv-pay
                        </a>
                    </p> -->
                @endif

                <div class="">
                    <img src="{{ asset('assets_web/images/others_services/spin.png') }}" alt="Spin Wheel" style="width:100%">
                    <h3>You have received</h3>
                    <h1>₹{{ $transaction->amount }}</h1>
                </div>
            </div>
        </div>
    @endforeach

        @endif

    </div>
</div>


     
    </div>
</div>
<script>
    function copyLink() {
        const link = document.getElementById('spin-link').getAttribute('href');
        navigator.clipboard.writeText(link)
            .then(() => {
                const message = document.getElementById('copy-message');
                message.style.display = 'inline';
                setTimeout(() => {
                    message.style.display = 'none';
                }, 2000);
            })
            .catch(err => console.error('Failed to copy link:', err));
    }
</script>
@endsection