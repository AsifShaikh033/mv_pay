@extends('Web.layout.main')

@section('content')
<style>
    .icon img {
    width: 100%;
    height: 100%;
}
</style>
<!-- Banner Slider Section -->
<div id="bannerSlider" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php echo '<pre>'; print_r($banners);die;?>
        @foreach($banners as $index => $banner)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/'.$banner->image) }}" class="d-block w-100" alt="{{ $banner->title }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $banner->title }}</h5>
                    <p>{{ $banner->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- About Us Section -->
<section class="about-us mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>About Us</h2>
                <p>
                    Welcome to Recharge Web, your one-stop solution for all recharge and payment needs. 
                    We provide seamless services to ensure your experience is effortless and enjoyable.
                </p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('assets/img/mvpay/logo_light.svg') }}" class="img-fluid rounded" alt="About Us">
            </div>
        </div>
    </div>
</section>

<!-- Card Offers Section -->
<section class="offers mt-5">
    <div class="container">
        <h2 class="text-center mb-4">Exclusive Offers</h2>
        <div class="row">
            @foreach($offers as $offer)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ asset('assets/img/mvpay/logo_light.svg') }}" class="card-img-top" alt="{{ $offer->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $offer->title }}</h5>
                            <p class="card-text">{{ $offer->description }}</p>
                            <a href="{{ $offer->link }}" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
