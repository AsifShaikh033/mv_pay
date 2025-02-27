@extends('Web.layout.main')
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

    .btn:hover {
      background: #ff6b6b;
    }

    .title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .card {
      margin-top: 6rem;
      border-radius: 15px;
      background-color:red;
      background: linear-gradient(90deg, rgba(255, 29, 159, 1) 0%, rgb(60 2 62) 51%, rgb(41 29 255) 76%) !important;
      background: linear-gradient(to right, #6a11cb, #2575fc);
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
      width: 80%;
      max-width: 500px;
      text-align: center;
      padding: 2rem;
      color: white;
    }

    .card-header {
      font-family: 'Roboto', sans-serif;
      font-weight: bold;
      font-size: 24px;
      margin-bottom: 1rem;
    }

    .contact-info {
      text-align: left;
      font-size: 16px;
      line-height: 1.5;
    }

    .company-details h4 {
      color: #1e90ff;
      font-size: 30px;
    }

    .company-details a {
      text-decoration: none;
      color: inherit;
    }

    .company-details p {
      font-size: 16px;
      color: white;
    }

    .company-details i {
      font-size: 30px;
      margin-right: 10px;
    }
    .support {
    border: 6px solid deepskyblue;
    border-radius: 30px;
    padding: 4px;
    color: white !important;
    display: inline;
}
.img_size{
  width:250px;
  height:250px;
}
.img_size_1{
  width:250px;
  height:350px;
}
.small_img{
  width:50px;
  height:50px;
}

@media (max-width: 500px) {
  .img_size {
    width: 150px;
    height: 150px;
  }

  .img_size_1 {
    height: 250px; 
  }

  .small_img {
    width: 40px; 
    height: 40px;
  }
}
  </style>
@section('content')
  <div class="content-body">
    <div class="container-fluid mt-5 pt-5 d-flex justify-content-center">
      <div class="card shadow-lg animated fadeIn w-75 p-0">
        <!-- <div class="card-header">
          <h3 class="mb-0">MV Pay Support</h3>
        </div> -->
        <div class="card-body gradient_color">
        <h3 class="mb-0 support">MV Pay Support</h3>
          <div class="d-flex justify-content-center align-items-center">
              <div >
                <div>
                  <img src="{{ asset('assets_web/images/others_services/r_2.png') }}" alt="Service Image" class="img_size" >
                </div>
                <div> 
                  <img src="{{ asset('assets_web/images/others_services/r_4.png') }}" alt="Service Image" class="img_size" >
                </div>
              </div>
            <div>
            <img src="{{ asset('assets_web/images/others_services/r_3.png') }}" alt="Service Image" class="small_img">
            <img src="{{ asset('assets_web/images/others_services/4.gif') }}" alt="Service Image"class="img_size_1" >
            </div>
          
          </div>
          <div class="container">
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="support-item">
                <i class="fa fa-envelope icon mb-0 bg-danger fs-4 btn-whatsapp rounded-circle shadow-sm bg-success text-white p-3"></i>
                <a href="mailto:mvvision.in@gmail.com">
                  <button class="btn btn-outline-light btn-sm badge">CLICK HERE</button>
                </a>
              </div>
              <div class="support-item">
                <a href="https://wa.me/7999544712" target="_blank" style="text-decoration: none;">
                <i class="fab fa-whatsapp fs-4 mb-0 icon btn-whatsapp rounded-circle shadow-sm bg-success text-white p-3"></i> 
                <button class="btn btn-outline-light btn-sm badge">CLICK HERE</button>
                  <!-- <h5 class="text-white">
                    <i class="fab fa-whatsapp fs-4 btn-whatsapp rounded-circle shadow-sm bg-success text-white p-3"></i> 
                    Call Us
                  </h5> -->
                </a>
              </div>
              <div class="support-item">
                <i class="fa fa-play fs-4 icon btn-whatsapp bg-danger mb-0 rounded-circle shadow-sm bg-success text-white p-3"></i>
                <a href="https://t.me/7999544712">
                  <button class="btn btn-outline-light btn-sm badge">CLICK HERE</button>
                </a>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="support-item">
                <img class='icon mb-0' src="{{ asset('assets_web/images/others_services/r_1.png') }}" alt="Service Image" width="50px" height="50px">
                <a href="tel:+9238711395">
                  <button class="btn btn-outline-light btn-sm badge">CLICK HERE</button>
                </a>
              </div>
              <div class="support-item">
              <i class="fab fa-telegram-plane icon fs-4  mb-0 btn-whatsapp rounded-circle shadow-sm bg-info text-white p-3"></i> 
                <a href="https://t.me/7999544712" target="_blank" style="text-decoration: none;">
                <button class="btn btn-outline-light btn-sm badge">CLICK HERE</button>
                  <!-- <h5 class="text-white">
                    <i class="fab fa-telegram-plane btn-whatsapp rounded-circle shadow-sm bg-info text-white p-3"></i> 
                    Telegram
                  </h5> -->
                </a>
              </div>
              <div class="support-item">
                <i class="fa fa-user  fs-4 icon mb-0 btn-whatsapp rounded-circle shadow-sm bg-success text-white p-3"></i>
                <button class="btn btn-outline-light btn-sm badge">CLICK HERE</button>
              </div>
            </div>
          </div>
        </div>
         
        </div>
      </div>
    </div>
  </div>
@endsection
