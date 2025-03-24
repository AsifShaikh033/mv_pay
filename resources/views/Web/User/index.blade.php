@extends('Web.layout.main')

@section('content')
<style>
.scrolling-container {
  width: 100%;
  overflow: hidden;
  white-space: nowrap;
  box-sizing: border-box;
}

.scrolling-text {
  display: inline-block;
  animation: scroll 20s linear infinite;
  font-size: 16px;
  line-height: 1.5;
}

@keyframes scroll {
  0% { transform: translateX(100%); }
  100% { transform: translateX(-100%); }
}

@media (max-width: 500px) {
  .scrolling-text {
    font-size: 14px;
    line-height: 1.2;
  }
}

@media (min-width: 500px) {
  .w-100{
    height:350px !important;
  } 
  }
</style>
<div class="content-body header-margin-top">



    <div class="scrolling-container mb-3">
    <div class="scrolling-text">
    <img id="ctl00_imgCompanyLogo" src="{{ asset('storage/' . (webConfig('logo') ?? '')) }}" onerror="this.src='{{ asset('assets_web/images/mv.jpg') }}'" 
  style="height: 20px;margin-bottom: 8px;"
    alt="Logo"
/>
        <span>Welcome to MV EASY PAY. We are dedicated to give you best service so that you can get good earnings from us. Keep on saving your money by using MV PAY and MV VISION. Stay tuned, keep supporting</span>
       
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

         <!-- Fund wallet Section -->
  <section class="pb-3">
   
   <div class="fund-cards row gap-0">
     <div class="col-6 px-1">

     <div class="card" onclick="window.location.href='{{ route('user.cash.qr_code') }}'" style='cursor:pointer;'>
       <div class="icon">
       <img src="{{ asset('assets_web/images/others_services/add_fund.gif') }}" style="width:100%; height:100%;" alt="">
       </div>
       <h3>Your Wallet</h3>
     </div>
     </div>

     <div class="col-6 px-1">
     <div class="card" onclick="window.location.href='{{ route('user.cash.wallet') }}'" style='cursor:pointer;'>
       <div class="icon">
       <img src="{{ asset('assets_web/images/others_services/ff.gif') }}" style="width:100%; height:100%;" alt="">
       </div>
       <h3>Cash Wallet</h3>
     </div>
     </div>
   </div>
 </section>
        

         <!-- Main Banner -->
  <!-- <section class="hero">
    <div class="hero-content">
      <h1>Recharge, Pay Bills & More</h1>
      <button class="cta-btn">Recharge Now</button>
      <button class="cta-btn">Pay Bills</button>
    </div>
  </section> -->

 
<!-- Add Modal HTML -->
<div class="modal fade" id="rechargeModal" tabindex="-1" aria-labelledby="rechargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="rechargeModalLabel">Select Recharge Option</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center py-4">
        <p class="mb-3 text-muted">Choose your preferred recharge method:</p>
          <div class="d-grid gap-3">
          <button class="btn btn-secondary btn-lg rounded-pill" style="background: linear-gradient(45deg, #00ffd2, #001c44, #0876ff);" onclick="handleRecharge('cyrus')">
                 💳 Recharge Mode 1
            </button>
            <button class="btn btn-primary btn-lg rounded-pill" onclick="handleRecharge('planet')">
                🚀 Recharge Mode 2
            </button>
           
            <!-- <button class="btn btn-secondary btn-lg rounded-pill" onclick="handleRecharge('digitalonline')">
                🌍 Recharge Mode 3
            </button> -->
          </div>
        <!-- <div class="d-grid gap-3">
          <button class="btn btn-primary btn-lg rounded-pill" onclick="window.location.href='{{ route('user.recharge.mobile') }}'">
            🚀 Recharge Mode 1
          </button>
          <button class="btn btn-secondary btn-lg rounded-pill" onclick="window.location.href='{{ route('user.c_recharge.mobile') }}'">
            🌍 Recharge Mode 2
          </button>
        </div> -->
      </div>
    </div>
  </div>
</div>



  <!-- Services Section -->
  <section class="services">

 
    <h2 class="text-light">Popular Services</h2>
    <div class="service-cards row gap-0">
      <div class="col-md-3 col-6 px-1">
      <div class="card " onclick="$('#rechargeModal').modal('show');" style="cursor:pointer;">

          <div class="mb-3"><img src="{{ asset('assets_web/images/dashboard/mobile.png') }}" alt="" width="50"></div> 
          <h6 class="font-bold">Mobile Recharge</h6>
        </div>
    </div>
  <div class="col-md-3 col-6 px-1">
    <div class="card " style="cursor:pointer;" onclick="window.location.href='{{ route('user.recharge.electricity') }}'">
        <div class="mb-3"><img src="{{ asset('assets_web/images/dashboard/electriity.png') }}" alt="" width="50"></div> 
        <h6 class="font-bold">Pay Bills</h6>
      </div>
    </div>
    <div class="col-md-3 col-6 px-1">
      <div class="card " style="cursor:pointer;">
        <div class="mb-3"><img src="{{ asset('assets_web/images/dashboard/cinema.png') }}" alt="" width="50"></div> 
        <h6 class="font-bold">Book Tickets</h6>
      </div>
      </div>
      <div class="col-md-3 col-6 px-1">
      <div class="card " style="cursor:pointer;">
      <div class="mb-3"><img src="{{ asset('assets_web/images/dashboard/shopping.png') }}" alt="" width="50"></div> 
        <h6 class="font-bold">Shop Online</h6>
      </div>
      </div>
    </div>
  </section>

  <section>

 <!-- Recharge Options -->
 <div class="recharge-card services">
    <div class="recharge-services-view mb-3">
      <!-- <span>Loan</span> -->

      <div class="outPop">
        <div class="popUpWord" style="font-size: 20px;">
          Recharge
        </div>
      </div>
      <button class="btn btn-sm mb-0" style="background: linear-gradient(45deg, #00ffd2, #001c44, #0876ff);color: white;">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>

    <div class="options-grid row gap-0">
        <div class="col-md-3 col-6">
          <!-- <div class="recharge-box mb-3 p-2" onclick="window.location.href='{{ route('user.recharge.mobile') }}'"> -->
          <div class="recharge-box mb-3 p-2" onclick="$('#rechargeModal').modal('show');">

          <div class=""><img src="{{ asset('assets_web/images/dashboard/mobile.png') }}" alt="" width="50"></div> 
              <span>Prepaid</span>
          </div>
        </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box mb-3 p-2"  onclick="redirectToRecharge('Mobile Postpaid')">
      <div class=""><img src="{{ asset('assets_web/images/dashboard/postpaid.gif') }}" alt="" width="50"></div> 
        <span>Postpaid</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box mb-3 p-2" onclick="redirectTodth('DTH')">
        <div class=""><img src="{{ asset('assets_web/images/dashboard/dth.png') }}" alt="" width="50"></div> 
        <span>DTH</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Google Play')">
          <div class=""><img src="{{ asset('assets_web/images/dashboard/play_game.png') }}" alt="" width="50"></div>  
        <span>Google Play</span>
      </div>
      </div>
    </div>
</div>


 <!-- Recharge Options -->
 <div class="recharge-card services">
    <div class="recharge-services-view mb-3">
      <!-- <span>Loan</span> -->

      <div class="outPop">
        <div class="popUpWord" style="font-size: 20px;">
          Offline(Manually Payment)
        </div>
      </div>
      <button class="btn btn-sm mb-0" style="background: linear-gradient(45deg, #00ffd2, #001c44, #0876ff);color: white;">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>

    <div class="options-grid row gap-0">
        <div class="col-md-3 col-6">
          <div class="recharge-box mb-3 p-2" onclick="window.location.href='{{ route('user.recharge.electricity',['mode'=2]) }}'">

          <div class=""><img src="{{ asset('assets_web/images/wallet/electricity.png') }}" alt="" width="50"></div> 
              <span>Electricity Offline System(Manual)</span>
          </div>
        </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Mobile Postpaid')">
      <div class=""><img src="{{ asset('assets_web/images/dashboard/mobile.png') }}"  alt="" width="50"></div> 
        <span>Postpaid Offline System(Manual)</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Life Insurance')">	
        <div class=""><img src="{{ asset('assets_web/images/wallet/lic.png') }}" alt="" width="50"></div> 
        <span>LIC Payment Offline System(Manual)</span>
      </div>
      </div>
    </div>
</div>


 <!-- Loan Section -->
  <div class="recharge-card">
    <div class="recharge-services-view mb-3">
    <!-- <span class="flowing-text">Recharge</span> -->
    <div class="outPop">
  <div class="popUpWord" style="font-size: 20px;">
    Bill Payments
  </div>
</div>


      <button class="btn btn-sm mb-0" style="background: linear-gradient(45deg, #00ffd2, #001c44, #0876ff);color: white;">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>



    <div class="options-grid row gap-0">

      <div class="col-md-3 col-6">
        <!-- <div class="recharge-box mb-3 " onclick="window.location.href='{{ route('user.recharge.mobile') }}'"> -->
        <div class="recharge-box mb-3 " onclick="$('#rechargeModal').modal('show');">
        <div class=""><img src="{{ asset('assets_web/images/dashboard/mobile.png') }}" alt="" width="50"></div> 
          <span>Mobile Recharge</span>
        </div>
      </div>

      <div class="col-md-3 col-6">
        <div class="recharge-box mb-3 " onclick="redirectTodth('DTH')">
    
            <div class=""><img src="{{ asset('assets_web/images/dashboard/dth.png') }}" alt="" width="50"></div> 
            <span>DTH Recharge</span>
        </div>
        </div>

      <div class="col-md-3 col-6">
      <div class="recharge-box mb-3 p-2" onclick="window.location.href='{{ route('user.search.pages') }}'">
        <div class=""><img src="{{ asset('assets_web/images/dashboard/data.png') }}" alt="" width="50"></div> 
        <span>Data Pack</span>
      </div>
    </div>
    <div class="col-md-3 col-6">
      <div class="recharge-box mb-3 p-2" onclick="window.location.href='{{ route('user.recharge.electricity') }}'">
        <div class=""><img src="{{ asset('assets_web/images/dashboard/electriity.png') }}" alt="" width="50"></div> 
        <span>Electricity Bill</span>
      </div>
      </div>
      <div class="col-md-3 col-6">
      <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Water')">
      <div class=""><img src="{{ asset('assets_web/images/dashboard/water.png') }}" alt="" width="50"></div> 
      <span>Water Bill</span>
    </div>
  </div>
  <div class="col-md-3 col-6">
    <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('LPG Gas')">
      <div class=""><img src="{{ asset('assets_web/images/dashboard/gas.png') }}" alt="" width="50"></div> 
      <span>Gas Recharge</span>
    </div>
  </div>
  <div class="col-md-3 col-6">
    <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Broadband')">
        <div class=""><img src="{{ asset('assets_web/images/dashboard/broadband.png') }}" alt="" width="50"></div> 
        <span>Broadband Recharge</span>
      </div>
    </div>
    <div class="col-md-3 col-6">
      <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Fastag')">
        <div class=""><img src="{{ asset('assets_web/images/dashboard/fastag.png') }}" alt="" width="50"></div> 
        <span>Fastag Recharge</span>
      </div>
    </div>
    <div class="col-md-3 col-6">
      <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Mobile Postpaid')">
        <div class=""><img src="{{ asset('assets_web/images/dashboard/postpaid.gif') }}" alt="" width="50"></div> 
        <span>Postpaid Bill</span>
      </div>
    </div>
        <div class="col-md-3 col-6">
            <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Cable TV')">
                <div class=""><img src="{{ asset('assets_web/images/dashboard/cable.png') }}" alt="" width="50">
                </div> 
                    <span>Cable TV</span>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('OTT Subscription')">
                <div class=""><img src="{{ asset('assets_web/images/wallet/8.png') }}" alt="" width="50">
                </div> 
                    <span>Ott Subscription</span>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Hospital')">
                <div class=""><img src="{{ asset('assets_web/images/wallet/hospital.png') }}" alt="" width="50">
                </div> 
                    <span>Hospital</span>
            </div>
        </div>
       
    </div>
  </div>

  
  

  <!-- Insurance Section -->
  <div class="recharge-card">
    <div class="recharge-services-view mb-3">
      <!-- <span>Insurance</span> -->
        <div class="outPop">
    <div class="popUpWord" style="font-size: 20px;">
    Financial Services
    </div>
  </div>
  <button class="btn btn-sm mb-0" style="background: linear-gradient(45deg, #00ffd2, #001c44, #0876ff);color: white;">
    View All <i class="fas fa-arrow-right"></i>
  </button>
</div>
<div class="options-grid row gap-0">
  <div class="col-md-3 col-6">
    <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Health Insurance')">
      <div class=""><img src="{{ asset('assets_web/images/dashboard/health.png') }}" alt="" width="50"></div> 
      <span>Health Insurance</span>
    </div>
  </div>
  <div class="col-md-3 col-6">
    <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Life Insurance')">
      <div class=""><img src="{{ asset('assets_web/images/dashboard/life.png') }}" alt="" width="50"></div> 
      <span>Life Insurance</span>
    </div>
  </div>
  <div class="col-md-3 col-6">
    <div class="recharge-box mb-3 p-2" onclick="window.location.href='{{ route('user.search.pages') }}'">
      <div class=""><img src="{{ asset('assets_web/images/dashboard/car-insurance.png') }}" alt="" width="50"></div> 
      <span>Car Insurance</span>
    </div>
  </div>
      <div class="col-md-3 col-6">
        <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Housing Society')">
          <div class=""><img src="{{ asset('assets_web/images/dashboard/home-insurance.png') }}" alt="" width="50"></div> 
          <span>Home Insurance</span>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Loan Repayment')">
          <div class=""><img src="{{ asset('assets_web/images/wallet/6.png') }}" alt="" width="50"></div> 
          <span>Loan Repayment</span>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Education Fees')">
          <div class=""><img src="{{ asset('assets_web/images/wallet/education.png') }}" alt="" width="50"></div> 
          <span>Education Fees</span>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="recharge-box mb-3 p-2" onclick="redirectToRecharge('Municipal Taxes')">
          <div class=""><img src="{{ asset('assets_web/images/wallet/muncipial.png') }}" alt="" width="50"></div> 
          <span>Muninipal Tax</span>
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
function redirectToRecharge(serviceType) {
    window.location.href = "{{ route('user.recharge.bills') }}?serviceType=" + encodeURIComponent(serviceType);
}
function redirectTodth(serviceType) {
    window.location.href = "{{ route('user.dth_first') }}?serviceType=" + encodeURIComponent(serviceType);
}
</script>
<script>
    function handleRecharge(rechargeType) {
        let route;

        if (rechargeType === 'planet') {
            route = '{{ route('user.recharge.mobile') }}' + '?plan_id=1'; 
        } else if(rechargeType === 'digitalonline'){
           
          route = '{{ route('user.recharge.mobile') }}' + '?plan_id=2'; 
       }
         else {
           
            route = '{{ route('user.recharge.mobile') }}';
        }
       window.location.href = route;
    }
</script>

<script>
        function selectOption(option) {
            alert("You have selected " + option);
            // Here you can replace the alert with any functionality like redirecting or opening a form.
        }
     
    function openRechargeModal() {
        var rechargeModal = new bootstrap.Modal(document.getElementById('rechargeModal'));
        rechargeModal.show();
    }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection