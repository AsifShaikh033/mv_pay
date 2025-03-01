@extends('Web.layout.main')
<style>
  .animated {
    animation-duration: 1.5s;
    animation-fill-mode: both;
  }
  .fadeIn {
    animation-name: fadeIn;
  }
  @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }

  .support-container {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .support-item {
    display: flex;
    align-items: center;
    margin: 10px 0;
  }

  .icon {
    font-size: 40px;
    margin-right: 10px;
    cursor: pointer;
    height: 50px;
    width: 50px;
  
  }
  .card .icon {
    margin-bottom:0px!important;
}

  .btn {
    background: #ff4c4c;
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s ease;
  }

  .btn:hover { background: #ff6b6b; }

  .card {
    margin-top: 6rem;
    border-radius: 15px;
    background: linear-gradient(to right, #6a11cb, #2575fc);
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    width: 80%;
    max-width: 500px;
    text-align: center;
    padding: 2rem;
    color: white;
  }

  .support {
    border: 6px solid deepskyblue;
    border-radius: 30px;
    padding: 4px;
    color: white !important;
    display: block;
    /* width: 100%; */
    margin: 0px 60px;
}

  .img_size { width: 100%; }
  .img_size_1 { width: 100%; }
  .small_img { width: 50px;  }

  @media (max-width: 500px) {
    /* .img_size { height: 150px; }
    .img_size_1 { height: 250px; } */
    .small_img { height: 40px; }
    .btn { padding: 5px 10px; font-size: 12px; }
    button.btn.btn-outline-light.badge {
    font-size: 8px!important;
}
  }

  .display_flex {
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
@section('content')
<div class="content-body">
  <div class="container-fluid mt-5 pt-5 d-flex justify-content-center">
    <div class="card w-100 h-100 shadow-lg animated fadeIn p-3">
      <h3 class="mb-0 support">MV Pay Support</h3>
      <div class="display_flex">
        <div>
          <img src="{{ asset('assets_web/images/others_services/r_2.png') }}" alt="Service Image" class="img_size">
          <img src="{{ asset('assets_web/images/others_services/r_4.png') }}" alt="Service Image" class="img_size">
        </div>
        <div>
          <img src="{{ asset('assets_web/images/others_services/r_3.png') }}" alt="Service Image" class="small_img float-end">
          <img src="{{ asset('assets_web/images/others_services/ghj.png') }}" alt="Service Image" class="img_size_1">
        </div>
      </div>
      <div class="container mt-0">
        <div class="row">
          <div class="col-6">
            <div class="support-item">
              <img class='icon' src="{{ asset('assets_web/images/others_services/s_2.png') }}" alt="Email">
              <a href="mailto:mvvision.in@gmail.com"><button class="btn btn-outline-light badge mb-0">CLICK HERE</button></a>
            </div>
            <div class="support-item">
              <img class='icon' src="{{ asset('assets_web/images/others_services/s_3.png') }}" alt="WhatsApp">
              <a href="https://wa.me/7999544712" target="_blank"><button class="btn btn-outline-light badge mb-0">CLICK HERE</button></a>
            </div>
            <div class="support-item">
              <img class='icon' src="{{ asset('assets_web/images/others_services/s_1.png') }}" alt="Telegram">
              <a href="https://t.me/7999544712"><button class="btn btn-outline-light badge mb-0">CLICK HERE</button></a>
            </div>
          </div>
          <div class="col-6">
            <div class="support-item">
              <img class='icon' src="{{ asset('assets_web/images/others_services/r_1.png') }}" alt="Call">
              <a href="tel:+9238711395"><button class="btn btn-outline-light badge mb-0">CLICK HERE</button></a>
            </div>
            <div class="support-item">
              <img class='icon' src="{{ asset('assets_web/images/others_services/s_4.png') }}" alt="Telegram">
              <a href="https://t.me/7999544712" target="_blank"><button class="btn btn-outline-light badge mb-0">CLICK HERE</button></a>
            </div>
            <div class="support-item">
              <img class='icon' src="{{ asset('assets_web/images/others_services/s_5.png') }}" alt="Support">
              <button class="btn btn-outline-light badge mb-0">CLICK HERE</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
