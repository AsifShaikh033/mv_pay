@extends('Web.layout.main')

@section('content')
<div class="content-body">
  <div class="container-fluid">
    <div class="card shadow-lg" style="margin-top:6rem; border-radius: 20px;">
      <div class="card-header bg-primary text-white text-center" style="border-radius: 20px 20px 0 0;">
        <h3>Contact Us</h3>
      </div>
      <div class="card-body p-4">
        <div class="contact-info text-center">

          <div class="company-details">
            <h5 class="text-black"><i class="fa fa-building btn-whatsapp rounded-pill shadow-sm bg-info text-white p-2"></i> Company Name</h5>
            <b class="text-primary">MV PAY</b>

            <a href="https://www.google.com/maps/search/?api=1&query=Balod,+Chhattisgarh,+India" target="_blank" style="text-decoration: none;">
            <h5 class="text-black mt-3"><i class="fa fa-map-marker btn-whatsapp rounded-pill shadow-sm bg-primary text-white p-2"></i> Address</h5>
            </a>
            <b class="text-primary">Balod , block & district - balod , pin code 491226 , state Chhattisgarh, India</b>

            <a href="https://wa.me/7999544712" target="_blank" style="text-decoration: none;">
              <h5 class="text-black mt-3"><i class="fab fa-whatsapp btn-whatsapp rounded-pill shadow-sm bg-success text-white p-2"></i> Call Us</h5>
            </a>
            <span><b class="text-primary">9238711395</b>
            <b class="text-primary">7999544712</b></span>

            <a href="mailto:mvvision.in@gmail.com" target="_blank" style="text-decoration: none;">
            <h5 class="text-black mt-3"><i class="fa fa-envelope btn-whatsapp rounded-pill shadow-sm bg-warning text-white p-2"></i> Email</h5>
            </a>
            <b class="text-primary">mvvision.in@gmail.com</b>


            <a href="https://t.me/7999544712" target="_blank" style="text-decoration: none;">
              <h5 class="text-black mt-3">
                  <i class="fab fa-telegram-plane btn-whatsapp rounded-pill shadow-sm bg-info text-white p-2"  aria-hidden="true"></i> Telegram
              </h5>
          </a>
          <b class="text-primary">7999544712</b>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
