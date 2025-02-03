@extends('Web.layout.main')

@section('content')

    <style>
      

        .container {
            max-width: 400px;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

      
        .search-bar {
            margin: 20px 0;
            display: flex;
            align-items: center;
            background: #f4f4f4;
            padding: 10px;
            border-radius: 8px;
        }

        .search-bar input {
            border: none;
            background: transparent;
            flex: 1;
            outline: none;
            padding: 5px;
            font-size: 16px;
        }

        .search-bar i {
            color: #555;
        }

        .biller-list {
            list-style: none;
        }

        .biller-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
            transition: background 0.2s;
        }

        .biller-item:hover {
            background: #f8f8f8;
        }

        .biller-item img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .biller-item span {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
    </style>


<div class="content-body" style="margin-top: 70px;">
    <div class="container">
        <!-- Header -->
        <!-- <div class="header">
            <i class="fas fa-arrow-left"></i>
            <h2>Select Biller</h2>
        </div> -->

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="search" placeholder="Search your biller">
            <i class="fas fa-search"></i>
        </div>

        <!-- Biller List -->
        <ul class="biller-list ps-0" id="billerList">
            <li class="biller-item" data-name="Airtel">
            <img src="{{ asset('assets_web/images/wallet/airtel.png') }}"  style="height;100px;!important" alt="">
                     
                <span>Airtel</span>
            </li>
            <li class="biller-item" data-name="BSNL">
            <img src="{{ asset('assets_web/images/wallet/bsnl.png') }}"  style="height;100px;!important" alt="">
                     
                <span>BSNL</span>
            </li>
            <li class="biller-item" data-name="Jio">
            <img src="{{ asset('assets_web/images/wallet/jio.png') }}"  style="height;100px;!important" alt="">
                     
                <span>Jio</span>
            </li>
          
            <li class="biller-item" data-name="Vi">
            <img src="{{ asset('assets_web/images/wallet/vi.png') }}"  style="height;100px;!important" alt="">
                     
                <span>Vi</span>
            </li>
        </ul>
    </div>
    </div>

    <script>
        // Search Functionality
        document.getElementById('search').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let items = document.querySelectorAll('.biller-item');

            items.forEach(function(item) {
                let text = item.getAttribute('data-name').toLowerCase();
                if (text.includes(filter)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Back button functionality
        document.querySelector('.header i').addEventListener('click', function() {
            alert("Back button clicked");
        });
    </script>
@endsection