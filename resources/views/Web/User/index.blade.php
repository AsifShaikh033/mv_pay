@extends('Web.layout.main')

@section('content')
<style>
  .w-100{
    height:350px !important;
  }
</style>
<div class="content-body header-margin-top">



    <div class="scrolling-container mb-3">
    <div class="scrolling-text">
        <span>Welcome to my pay</span>
       
    </div>
</div>


        <div id="carouselExampleInterval pt-2" class="carousel slide mb-4" data-bs-ride="carousel">
              <div class="carousel-inner">
              @foreach ($banners as $index => $banner)
                <div class="carousel-item  p-0 {{ $index == 0 ? 'active' : '' }} w-100" data-bs-interval="10000">
                    <img id="ctl00_imgCompanyLogo" src="{{ asset('storage/' . $banner->image) }}" class="d-block object-fit-cover" alt="Banner {{ $index + 1 }}" />
                </div>
            @endforeach
                </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                  data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                  data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
              </button>
        </div>

        

         <!-- Main Banner -->
  <section class="hero">
    <div class="hero-content">
      <h1>Recharge, Pay Bills & More</h1>
      <button class="cta-btn">Recharge Now</button>
      <button class="cta-btn">Pay Bills</button>
    </div>
  </section>

  <!-- Services Section -->
  <section class="services">
    <h2 class="text-light">Popular Services</h2>
    <div class="service-cards row">
      <div class="col-md-3 col-6">
      <div class="card ">
        <div class="icon">📱</div>
        <h3>Mobile Recharge</h3>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="card ">
        <div class="icon">💡</div>
        <h3>Pay Bills</h3>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="card ">
        <div class="icon">🎬</div>
        <h3>Book Tickets</h3>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="card ">
        <div class="icon">🛍️</div>
        <h3>Shop Online</h3>
      </div>
      </div>
    </div>
  </section>

  <section>

 <!-- Recharge Options -->
 <div class="recharge-card services">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <!-- <span>Loan</span> -->

      <div class="outPop">
        <div class="popUpWord">
          Recharge
        </div>
      </div>
      <button class="btn btn-sm btn-primary mb-0">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>
    <div class="options-grid row">
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Prepaid')">
        <div class="icon">📱</div> 
        <span>Prepaid</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Postpaid')">
        <div class="icon">📞</div> 
        <span>Postpaid</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('DTH')">
        <div class="icon">📡</div> 
        <span>DTH</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Google Play')">
        <div class="icon">🎮</div> 
        <span>Google Play</span>
      </div>
      </div>
    </div>
</div>


 <!-- Loan Section -->
  <div class="recharge-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
    <!-- <span class="flowing-text">Recharge</span> -->
    <div class="outPop">
  <div class="popUpWord">
    Bill Payments
  </div>
</div>


      <button class="btn btn-sm btn-primary mb-0">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>
    <div class="options-grid row">
    <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Mobile Recharge')">
        <span>📱</span>
        <span>Mobile Recharge</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('DTH Recharge')">
        <div class="icon">📺</div>
        <span>DTH Recharge</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Data Pack')">
        <div class="icon">🌐</div>
        <span>Data Pack</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Electricity Bill')">
        <div class="icon">⚡</div>
        <span>Electricity Bill</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Water Bill')">
        <div class="icon">💧</div>
        <span>Water Bill</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Gas Recharge')">
        <div class="icon">🔥</div>
        <span>Gas Recharge</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Broadband Recharge')">
        <div class="icon">🌐</div>
        <span>Broadband Recharge</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Fastag Recharge')">
        <div class="icon">🚗</div>
        <span>Fastag Recharge</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Postpaid Bill')">
        <div class="icon">📞</div>
        <span>Postpaid Bill</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Cable TV')">
        <div class="icon">📺</div>
        <span>Cable TV</span>
      </div>
      </div>
    </div>
  </div>

  
 

  <!-- Insurance Section -->
  <div class="recharge-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <!-- <span>Insurance</span> -->
        <div class="outPop">
    <div class="popUpWord">
    Financial Services
    </div>
  </div>
      <button class="btn btn-sm btn-primary mb-0">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>
    <div class="options-grid row">
    <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Health Insurance')">
        <div class="icon">💊</div>
        <span>Health Insurance</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Life Insurance')">
        <div class="icon">❤️</div>
        <span>Life Insurance</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Car Insurance')">
        <div class="icon">🚗</div>
        <span>Car Insurance</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box" onclick="selectOption('Home Insurance')">
        <div class="icon">🏡</div>
        <span>Home Insurance</span>
      </div>
      </div>
    </div>
  </div>

</section>

  

</div>

<!-- <script>
$(document).ready(function() {
    // Initialize Owl Carousel
    $(".owl-carousel").owlCarousel({
        items: 1,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        loop: true,
        dots: true,
        nav: true,
        navText: ['<', '>'],
    });
});
</script> -->

<script>
        function selectOption(option) {
            alert("You have selected " + option);
            // Here you can replace the alert with any functionality like redirecting or opening a form.
        }
    </script>
@endsection