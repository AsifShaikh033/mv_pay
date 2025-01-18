@extends('Web.layout.main')

@section('content')
<style>
  .carousel-inner .carousel-item img {
    height: 350px;
    object-fit: fill;
}
</style>
<div class="content-body">
  
    <div class="container-fluid py-5">
        <div id="carouselExampleInterval" class="carousel slide mb-4" data-bs-ride="carousel">
              <div class="carousel-inner">
              @foreach ($banners as $index => $banner)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="10000">
                    <img id="ctl00_imgCompanyLogo" src="{{ asset('storage/' . $banner->image) }}" class="d-block " alt="Banner {{ $index + 1 }}" />
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
    <h2>Popular Services</h2>
    <div class="service-cards">
      <div class="card">
        <div class="icon">📱</div>
        <h3>Mobile Recharge</h3>
      </div>
      <div class="card">
        <div class="icon">💡</div>
        <h3>Pay Bills</h3>
      </div>
      <div class="card">
        <div class="icon">🎬</div>
        <h3>Book Tickets</h3>
      </div>
      <div class="card">
        <div class="icon">🛍️</div>
        <h3>Shop Online</h3>
      </div>
    </div>
  </section>

  <section>
  <!-- Recharge Options -->
  <div class="recharge-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <span>Recharge</span>
      <button class="btn btn-sm btn-primary mb-0">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>
    <div class="options-grid">
      <div class="recharge-box" onclick="selectOption('Mobile Recharge')">
        <span>📱</span>
        <span>Mobile Recharge</span>
      </div>
      <div class="recharge-box" onclick="selectOption('DTH Recharge')">
        <div class="icon">📺</div>
        <span>DTH Recharge</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Data Pack')">
        <div class="icon">🌐</div>
        <span>Data Pack</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Electricity Bill')">
        <div class="icon">⚡</div>
        <span>Electricity Bill</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Water Bill')">
        <div class="icon">💧</div>
        <span>Water Bill</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Gas Recharge')">
        <div class="icon">🔥</div>
        <span>Gas Recharge</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Broadband Recharge')">
        <div class="icon">🌐</div>
        <span>Broadband Recharge</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Fastag Recharge')">
        <div class="icon">🚗</div>
        <span>Fastag Recharge</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Postpaid Bill')">
        <div class="icon">📞</div>
        <span>Postpaid Bill</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Cable TV')">
        <div class="icon">📺</div>
        <span>Cable TV</span>
      </div>
    </div>
  </div>

  <!-- Loan Section -->
  <div class="recharge-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <span>Loan</span>
      <button class="btn btn-sm btn-primary mb-0">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>
    <div class="options-grid">
      <div class="recharge-box" onclick="selectOption('Personal Loan')">
        <div class="icon">💵</div>
        <span>Personal Loan</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Home Loan')">
        <div class="icon">🏠</div>
        <span>Home Loan</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Car Loan')">
        <div class="icon">🚗</div>
        <span>Car Loan</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Education Loan')">
        <div class="icon">🎓</div>
        <span>Education Loan</span>
      </div>
    </div>
  </div>

  <!-- Insurance Section -->
  <div class="recharge-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <span>Insurance</span>
      <button class="btn btn-sm btn-primary mb-0">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>
    <div class="options-grid">
      <div class="recharge-box" onclick="selectOption('Health Insurance')">
        <div class="icon">💊</div>
        <span>Health Insurance</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Life Insurance')">
        <div class="icon">❤️</div>
        <span>Life Insurance</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Car Insurance')">
        <div class="icon">🚗</div>
        <span>Car Insurance</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Home Insurance')">
        <div class="icon">🏡</div>
        <span>Home Insurance</span>
      </div>
    </div>
  </div>

  <!-- Wealth Management Section -->
  <div class="recharge-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <span>Wealth Management</span>
      <button class="btn btn-sm btn-primary mb-0">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>
    <div class="options-grid">
      <div class="recharge-box" onclick="selectOption('Investments')">
        <div class="icon">📈</div>
        <span>Investments</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Mutual Funds')">
        <div class="icon">💹</div>
        <span>Mutual Funds</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Retirement Planning')">
        <div class="icon">🛋️</div>
        <span>Retirement Planning</span>
      </div>
    </div>
  </div>

  <!-- Travel Section -->
  <div class="recharge-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <span>Travel</span>
      <button class="btn btn-sm btn-primary mb-0">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>
    <div class="options-grid">
      <div class="recharge-box" onclick="selectOption('Flight Booking')">
        <div class="icon">✈️</div>
        <span>Flight Booking</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Hotel Booking')">
        <div class="icon">🏨</div>
        <span>Hotel Booking</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Tour Packages')">
        <div class="icon">🌍</div>
        <span>Tour Packages</span>
      </div>
    </div>
  </div>

  <!-- Transit & Food Section -->
  <div class="recharge-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <span>Transit & Food</span>
      <button class="btn btn-sm btn-primary mb-0">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>
    <div class="options-grid">
      <div class="recharge-box" onclick="selectOption('Public Transit')">
        <div class="icon">🚇</div>
        <span>Public Transit</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Food Delivery')">
        <div class="icon">🍕</div>
        <span>Food Delivery</span>
      </div>
    </div>
  </div>

  <!-- Purchases Section -->
  <div class="recharge-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <span>Purchases</span>
      <button class="btn btn-sm btn-primary mb-0">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>
    <div class="options-grid">
      <div class="recharge-box" onclick="selectOption('Online Shopping')">
        <div class="icon">🛒</div>
        <span>Online Shopping</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Gift Cards')">
        <div class="icon">🎁</div>
        <span>Gift Cards</span>
      </div>
    </div>
  </div>

  <!-- Sponsored Links Section -->
  <div class="recharge-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <span>Sponsored Links</span>
      <button class="btn btn-sm btn-primary mb-0">
        View All <i class="fas fa-arrow-right"></i>
      </button>
    </div>
    <div class="options-grid">
      <div class="recharge-box" onclick="selectOption('Ad 1')">
        <div class="icon">📢</div>
        <span>Sponsored Ad 1</span>
      </div>
      <div class="recharge-box" onclick="selectOption('Ad 2')">
        <div class="icon">📢</div>
        <span>Sponsored Ad 2</span>
      </div>
    </div>
  </div>
</section>

  

       
    </div>
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