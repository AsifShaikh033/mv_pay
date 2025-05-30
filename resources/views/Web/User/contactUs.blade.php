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
.img_size_1 {
    width: 180px;
}
  }

  @media (max-width: 340px) {
    .img_size_1 {
    width: 100%;
}
  }
  @media (max-width: 480px) {
    .card h3 {
        font-size: 12px !important;
        margin-bottom: 0px;
    }
}

  .display_flex {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .icons {
    border-radius: 50%;
    margin-right: 10px;
    font-size: 30px;
    padding: 9px;
    background-color: red;
    display: flex;
    align-items: center;
    justify-content: center;
}
.play-circle {
    display: inline-block;
    padding: 10px;
    background-color: orangered;
    border-radius: 50%;
    color: white;
    margin-right: 10px;
    font-size: 24px;
    text-align: center;
    line-height: 1;
}



</style>

@section('content')
<div class="content-body">
  <div class="container-fluid mt-5 pt-5 d-flex justify-content-center">
    <div class="card w-100 h-100 shadow-lg animated fadeIn p-3">
      <h3 class="mb-0 support">MV EASY PAY Support</h3>
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
            <i class="fa fa-envelope icons"></i>


              <!-- <img class='icon' src="{{ asset('assets_web/images/others_services/s_2.png') }}" alt="Email"> -->
              <a href="mailto:mvvision.in@gmail.com"><button class="btn btn-outline-light badge mb-0">CLICK HERE</button></a>
            </div>
            <div class="support-item">
            <i class="fa-brands fa-whatsapp icons bg-success"></i>
              <!-- <img class='icon' src="{{ asset('assets_web/images/others_services/s_3.png') }}" alt="WhatsApp"> -->
              <a href="https://wa.me/7999544712" target="_blank"><button class="btn btn-outline-light badge mb-0">CLICK HERE</button></a>
            </div>
            <div class="support-item">
            <i class="fa fa-play play-circle"></i>

              <!-- <img class='icon' src="{{ asset('assets_web/images/others_services/s_1.png') }}" alt="Telegram"> -->
              <a href="https://youtube.com/playlist?list=PLB1D5jO_Dxly72go5HEOq07pvrkS1Torb&si=q0xNTXM8tE18O3sb"  target="_blank"><button class="btn btn-outline-light badge mb-0">CLICK HERE</button></a>
            </div>
          </div>
          <div class="col-6">
            <div class="support-item">
              <img class='icon' src="{{ asset('assets_web/images/others_services/r_1.png') }}" alt="Call">
              <a href="tel:+919238711395"><button class="btn btn-outline-light badge mb-0">CLICK HERE</button></a>
            </div>
            
            <div class="support-item">
            <i class='fab fa-telegram-plane' style="font-size:48px;color:skyblue;margin-right: 10px;"></i>

              <!-- <img class='icon' src="{{ asset('assets_web/images/others_services/s_4.png') }}" alt="Telegram"> -->
              <a href="https://t.me/7999544712" target="_blank"><button class="btn btn-outline-light badge mb-0">CLICK HERE</button></a>
            </div>
            <div class="support-item">
            <!-- <i class="fab fa-google-drive icons"></i> -->
            <i class="fa fa-envelope-open icons bg-info"></i>


           


              <!-- <img class='icon' src="{{ asset('assets_web/images/others_services/s_5.png') }}" alt="Support"> -->
              <a href="https://whatsapp.com/channel/0029VaxyuAsKwqSSTKeVGt3C" target="_blank"><button class="btn btn-outline-light badge mb-0">CLICK HERE</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
