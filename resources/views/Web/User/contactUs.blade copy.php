@extends('Web.layout.main')
@section('styles')
  <style>
    /* Animation for the card */
    .animated {
      animation-duration: 1.5s;
      animation-fill-mode: both;
    }
    .fadeIn {
      animation-name: fadeIn;
    }
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
  </style>
@endsection
@section('content')
<div class="content-body">
  <div class="container-fluid">
    <div class="card shadow-lg animated fadeIn" style="margin-top:6rem; border-radius: 15px; background: linear-gradient(to right, #6a11cb, #2575fc);">
      <div class="card-header bg-transparent text-white text-center" style="border-radius: 15px 15px 0 0;">
        <h3 class="mb-0" style="font-family: 'Roboto', sans-serif; font-weight: bold;">Contact Us</h3>
      </div>
      <div class="card-body p-4">
        <div class="contact-info" style="text-align: left;">
          <div class="company-details">
            <h5 class="text-white mb-2">
              <i class="fa fa-building btn-whatsapp rounded-circle shadow-sm bg-info text-white p-3"></i> 
              Company Name
            </h5>
            <h4 class="text-primary">MV PAY</h4>

            <a href="https://www.google.com/maps/search/?api=1&query=Balod,+Chhattisgarh,+India" target="_blank" style="text-decoration: none;">
              <h5 class="text-white mt-4 mb-2">
                <i class="fa fa-map-marker btn-whatsapp rounded-circle shadow-sm bg-primary text-white p-3"></i> 
                Address
              </h5>
            </a>
            <p class="text-white" style="font-size: 16px; line-height: 1.5;">Balod, block & district - Balod, pin code 491226, state Chhattisgarh, India</p>

            <a href="https://wa.me/7999544712" target="_blank" style="text-decoration: none;">
              <h5 class="text-white mt-4 mb-2">
                <i class="fab fa-whatsapp btn-whatsapp rounded-circle shadow-sm bg-success text-white p-3"></i> 
                Call Us
              </h5>
            </a>
            <p class="text-white" style="font-size: 16px;">
              <b>9238711395</b> | <b>7999544712</b>
            </p>

            <a href="mailto:mvvision.in@gmail.com" target="_blank" style="text-decoration: none;">
              <h5 class="text-white mt-4 mb-2">
                <i class="fa fa-envelope btn-whatsapp rounded-circle shadow-sm bg-warning text-white p-3"></i> 
                Email
              </h5>
            </a>
            <p class="text-white" style="font-size: 16px;">
              <b>mvvision.in@gmail.com</b>
            </p>

            <a href="https://t.me/7999544712" target="_blank" style="text-decoration: none;">
              <h5 class="text-white mt-4 mb-2">
                <i class="fab fa-telegram-plane btn-whatsapp rounded-circle shadow-sm bg-info text-white p-3"></i> 
                Telegram
              </h5>
            </a>
            <p class="text-white" style="font-size: 16px;">
              <b>7999544712</b>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


