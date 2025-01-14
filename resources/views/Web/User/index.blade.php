@extends('Web.layout.main')

@section('content')
<style>
  /* General Styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  line-height: 1.6;
  background-color: #f4f4f4;
}

a {
  text-decoration: none;
  color: inherit;
}

/* Header */
header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background-color: #003d5b;
  color: white;
}

header .logo {
  font-size: 24px;
  font-weight: bold;
}

header .search-bar input {
  padding: 10px;
  width: 250px;
  border-radius: 5px;
  border: 1px solid #ddd;
}

header .auth-links button {
  margin-left: 15px;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

header .login-btn {
  background-color: #ffffff;
  color: #003d5b;
}

header .signup-btn {
  background-color: #ff3d00;
  color: white;
}

/* Hero Section */
.hero {
  background-color: #ff3d00;
  color: white;
  padding: 50px;
  text-align: center;
}

.hero h1 {
  font-size: 36px;
  margin-bottom: 20px;
}

.hero .cta-btn {
  background-color: white;
  color: #ff3d00;
  padding: 10px 20px;
  font-size: 18px;
  border-radius: 5px;
  margin: 10px;
  border: none;
  cursor: pointer;
}

.hero .cta-btn:hover {
  background-color: #e6e6e6;
}

/* Services Section */
.services {
  padding: 40px;
  text-align: center;
}

.services h2 {
  font-size: 28px;
  margin-bottom: 20px;
}

.service-cards {
  display: flex;
  justify-content: center;
  gap: 20px;
}

.card {
  background-color: white;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  width: 200px;
  text-align: center;
  transition: transform 0.3s ease-in-out;
}

.card:hover {
  transform: translateY(-10px);
}

.card .icon {
  font-size: 40px;
  margin-bottom: 20px;
}

.card h3 {
  font-size: 20px;
  color: #003d5b;
}

/* Footer Section */
footer {
  background-color: #003d5b;
  color: white;
  padding: 30px;
  text-align: center;
}

.footer-links a {
  margin: 0 15px;
  color: white;
}

.footer-links a:hover {
  text-decoration: underline;
}

.social-media a {
  margin: 0 10px;
  color: white;
}

</style>
<div class="content-body">
  
    <div class="container py-5">
      <h1 class="text-center text-white">Dashboard</h1>
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                      <img id="ctl00_imgCompanyLogo" src="{{ asset('assets_web/images/slider/r_1.png') }}" class="d-block w-100"   />
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                      <img id="ctl00_imgCompanyLogo" src="{{ asset('assets_web/images/slider/r_1.png') }}" class="d-block w-100"   />
                    </div>
                    <div class="carousel-item">
                      <img id="ctl00_imgCompanyLogo" src="{{ asset('assets_web/images/slider/r_1.png') }}" class="d-block w-100"   />
                    </div>
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
@endsection