@extends('Web.layout.main')

@section('content')

<style>
    .service-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

/* Card Styling */
.card {
    width: calc(33.333% - 20px); /* Default width for larger screens */
    border-radius: 10px;
    text-align: center;
    padding: 20px;
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

/* Image Icon */
.other_icon {
    font-size: 3rem;
    margin-bottom: 15px;
}

.other_icon img {
    width: 100px;
    height: 100px;
}

/* Headings */
.card-title {
    font-size: 1.2rem;
    font-weight: bold;
}

.card-text {
    font-size: 1rem;
}

/* Mobile Responsiveness */
@media (max-width: 992px) { 
    .card {
        width: calc(50% - 20px); /* 2 cards per row on tablets */
    }
}

@media (max-width: 768px) {
    .card {
        width: calc(100% - 20px); /* Full width for smaller screens */
    }
}

@media (max-width: 480px) {
    .other_icon {
        font-size: 2rem;
        margin-bottom: 5px;
    }

    .other_icon img {
        width: 80px;
        height: 80px;
    }

    .card-title {
        font-size: 1rem;
    }

    .card-text {
        font-size: 0.9rem;
    }
}

</style>

<div class="content-body">
    <div class="container-fluid">
        <section class="services">
        <h2 class="text-light text-center mt-5">Member Refer List</h2>
            
            @if($users_list->isEmpty())
                <p class="text-center text-white">No Member Refer List found for this report.</p>
            @else
                <div class="service-cards">
                    @foreach($users_list as $recharge)
                        <div class="card" style="cursor: pointer;" onclick="window.location=''">
                            <div class="other_icon">
                                <img src="{{ $recharge->identity_image ? url('storage/app/public/' . $recharge->identity_image) : asset('assets_web/images/profile/default.png') }}" width="100px" height="100px" alt="" style="border-radius: 30px;">
                            </div>
                            <div class="text-center">
                                <p class="card-title mb-1"><strong>Name:</strong> {{ ucfirst($recharge->name) }}</p>
                                <p class="card-text mb-0"><strong>Phone Number:</strong> {{ $recharge->mob_number }}</p>
                                <p class="card-text"><strong>Date:</strong> {{ $recharge->created_at ? $recharge->created_at->format('d-m-y') : 'N/A' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</div>

@endsection
