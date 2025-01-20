@extends('Web.layout.main')

@section('content')

<STYLE>
    
      .service-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .other_card {
      
        color: #fff;
        padding: 20px;
        width: calc(33.333% - 20px); /* Default width for larger screens */
        border-radius: 10px;
        text-align: center;
       
        transition: transform 0.3s ease;
    }

    .other_card:hover {
        transform: translateY(-5px);
    }

    .other_icon {
        font-size: 3rem;
        margin-bottom: 15px;
    }

    .other_card h3 {
        font-size: 1.2rem;
    }


    
    /* Additional style tweaks for mobile */
    @media (max-width: 480px) {
        .icon {
            font-size: 2rem;
        }

      
        .other_icon {
    font-size: 1rem;
    margin-bottom: 5px;
}

.other_card h3 {
    font-size: 10px;
}
    }
    
</STYLE>
<div class="content-body">
    <div class="container-fluid ">
       
        <section class="services">
            <h2 class="text-light mb-4">Other Services</h2>
            <div class="service-cards">
              
                <!-- Payment Request -->
                <div class="card other_card" style="cursor: pointer;" onclick="window.location=''">
                    <div class="other_icon">💸</div>
                    <h3>Payment Request</h3>
                </div>

                <!-- Payment Status -->
                <div class="card other_card" style="cursor: pointer;" onclick="window.location=''">
                    <div class="other_icon">🔄</div>
                    <h3>Payment Status</h3>
                </div>

                <!-- Add User -->
                <div class="card other_card" style="cursor: pointer;" onclick="window.location=''">
                    <div class="other_icon">➕</div>
                    <h3>Add User</h3>
                </div>

                <!-- Day Book -->
                <div class="card other_card" style="cursor: pointer;" onclick="window.location=''">
                    <div class="other_icon">📖</div>
                    <h3>Day Book</h3>
                </div>

                <!-- Member List -->
                <div class="card other_card" style="cursor: pointer;" onclick="window.location=''">
                    <div class="other_icon">👥</div>
                    <h3>Member List</h3>
                </div>

                <!-- Commission Report -->
                <div class="card other_card" style="cursor: pointer;" onclick="window.location=''">
                    <div class="other_icon">📊</div>
                    <h3>Commission Report</h3>
                </div>

                <!-- Fund Transaction -->
                <div class="card other_card" style="cursor: pointer;" onclick="window.location=''">
                    <div class="other_icon">💰</div>
                    <h3>Fund Transaction</h3>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection
