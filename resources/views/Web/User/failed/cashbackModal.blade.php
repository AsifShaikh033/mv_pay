
@extends('Web.layout.main')

@section('content')

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
<div class="modal fade" id="cashbackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content rechargeModal">
          <div class='d-flex justify-content-end mb-3'>
              <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal_header">
              <h5 class="modal-title w-100">Recharge has been processed successfully. Transaction ID: {{ $transactionId }}</h5>
          </div>
          <div class="modal-body d-flex justify-content-center text-white">
              <div class="image-container mb-3">
                  <img src="{{ asset('assets_web/images/others_services/cash_remover.png') }}" alt="Recharge Success" class="img-fluid">
                  <p class="thank-you">Thank You For Using MV Pay. Collect your cash from MV Vision.</p>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection