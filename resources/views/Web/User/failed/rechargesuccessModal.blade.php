@extends('Web.layout.main')

@section('content')

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  
    <style>
        .rechargeModal {
            background: linear-gradient(135deg, #000, #001aff);
            /* color: #fff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 0; */
        }
        .modal_header {
    background: #fff;
    color: #000;
    border: 2px solid red;
    padding: 10px 10px;
    border-radius: 25px;
    box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
    margin: 0 29px;
}
        .image-container img {
            width: 100%;
            height: auto;
        }
      
        .thank-you {
            font-size: 1rem;
        }
        @media (max-width: 576px) {
            .modal-content {
                padding: 1rem;
            }
          
            .thank-you {
                font-size: 0.9rem;
            }
        }
    </style>



<div class="content-body mt-5">
    <div class="container choose_plan-container mt-5">
<!-- Modal -->
<!-- <div class="modal fade " id="cashbackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
<div>
  <div class="modal-dialog">
    <div class="modal-content rechargeModal">
    <div class='d-flex justify-content-end mb-3'>
        <!-- <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button> -->
    </div>
      <div class="modal_header">
      <h5 class="modal-title w-100" id="rechargeModalLabel">Recharge Of {{$transaction->amount}} has
      been proceed successfully.</h5>
       
      </div>
      <div class="modal-body d-flex justify-content-center text-white">
                    <div class="image-container mb-3">
                    <img src="{{ asset('assets_web/images/others_services/cash.png') }}" alt="Recharge Failed" class="img-fluid">
                    <p class="thank-you text-black">Thank  You For Using  MV Pay.
                    collect your cash from mv vision.</p>
                    </div>
                   
        </div>
    </div>
  </div>
</div>
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    @endsection