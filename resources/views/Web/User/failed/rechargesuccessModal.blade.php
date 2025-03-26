@extends('Web.layout.main')

@section('content')

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<title>Hello, world!</title>
<style>
       
       .container_index {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 35px 35px  0px 35px black;
    text-align: center;
    width: 70%;
}
       .features {
           background: #212529;
           color: white;
           padding: 10px;
           border-radius: 5px;
           margin-top: 10px;
       }
       .features ul {
           list-style: none;
           padding: 0;
       }
       .download-btn {
           background: #28a745;
           color: white;
           padding: 10px;
           display: block;
           text-align: center;
           text-decoration: none;
           border-radius: 5px;
       }
       .img-fluid-custom {
           max-height: 150px;
       }
       .change_name {
   text-align: left;
}
         @media (max-width: 576px) {
           .change_name {
   font-size: 10px;
   text-align: left;
}
.container_index {
   width: 100%; 
}
.bordered-text {
   font-size: 25px !important;
   font-weight: 700;

   -webkit-text-stroke: 1px black !important;
}
       }
       
       .border_bottom {
   position: relative;
   width: 100%;
   border-bottom: 2px solid #000;
   margin: 10px;
}

       .border_bottom::before,
       .border_bottom::after {
           content: '';
           position: absolute;
           background-color: #000; 
       }
       .header-text {
    font-weight: 700;
}
    .border_bottom::before {
   bottom: -5px;
   left: 0px;
   width: 2px;
   height: 8px;
}
.website-link {
    display: flex;
    align-items: center;
    gap: 12px;
}
       .border_bottom::after {
           bottom: -5px; 
           right: 0px;  
           width: 2px;  
           height: 8px;
       }
.bordered-text {
   font-size: 35px;
   font-weight: 700;
   color: yellow;
   text-align: left;
   -webkit-text-stroke: 2px black;
}
.content-body{
    min-height:924px!important;
}
   </style>
</head>
<body>
    
<div class="content-body mt-5" >
   <div class="container_index container">
       <div class="row text-center">
       <p class="bordered-text">अब हर बार 200 रुपये तक का</p>
           <div class="col-6">
               <p class="bordered-text">कैशबैक !!</p>
           </div>
           <div class="col-4">
               <img src="{{ asset('assets_web/images/others_services/11.png') }}" class="img-fluid">
           </div>
         
           <div class="col-2">
               <img src="{{ asset('assets_web/images/others_services/5.png') }}" class="img-fluid">
           </div>
       </div>

       <div class="row align-items-center text-center">
           <div class="col-2">
               <img src="{{ asset('assets_web/images/others_services/9.png') }}" class="img-fluid" >
           </div>
           <div class="col-6">
               <h4 class="change_name">Payment of ₹  is successful!</h4>
               <h5 class="mt-2 m-0 change_name">22 Mar, 2025 ! 07:15 PM</h5>
               <h5 class="change_name">Transaction Details</h5>
               <h6 class="change_name">Ref/UTR NO. 132222323</h6>
            </div>
           <div class="col-4">
               <img src="{{ asset('assets_web/images/others_services/phone.png') }}" class="img-fluid" style="max-width: 100%;">
           </div>
       </div>
                  <h6 class="change_name mb-0">Your Transaction has successfully Processed.</h6>
       <div class="row align-items-center text-center">
         <div class="col-6">

          <div class="border_bottom"></div>
           <h6 class="header-text change_name">Let's download the application now</h6>
       <p class="change_name m-0">Unlock the full potential of your finances with our Mobile Banking App—secure, convenient, and packed with features to manage your money anytime, anywhere!</p>
        <div class="website-link">
           <img src="{{ asset('assets_web/images/others_services/browser.png') }}" alt="Website Icon" style="width:30px;height:30px;">
           <div class="change_name fs-12">
           <label for="" class="m-0 p-0">Our Website:</label><br> <a href="https://www.mveasypay.com" target="_blank">www.mveasypay.com</a></div>
       </div>
         </div>
         <div class="col-6">
           <div class="features mt-3">
               <h5 class="change_name">MV EASY PAY Features:</h5>
               <ul class="change_name">
                   <li>✔ Cashback Har Bar</li>
                   <li>✔ Referral Cashback</li>
                   <li>✔ Easy Process</li>
                   <li>✔ No Need to Link Bank A/C</li>
                   <li>✔ Many More Coming</li>
               </ul>
           </div>
       </div>

      
   </div>
   </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
@endsection