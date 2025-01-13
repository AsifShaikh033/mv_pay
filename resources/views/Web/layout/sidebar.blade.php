<div class="dlabnav">
    <div class="dlabnav-scroll">
    
        <ul class="metismenu" id="menu">
            @if(Auth::check()) 
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.logout') }}">Logout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.profile') }}">Profile</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            @endif
        <li>
            <a id="ctl00_lnkServices" href="#">
            <i class="basecolor flaticon-381-user-2"></i>
            <span class="nav-text">Services</span>
            </a>
        </li>
        <li>
            <a>
            <i class="basecolor flaticon-381-user-2"></i>
            <span class="nav-text">My account</span>
            </a>
        </li>
        <li>
            <a>
            <i class="basecolor flaticon-043-menu"></i>
            <span class="nav-text">Payment History</span>
            </a>
        </li>
        <li>
            <a href="{{route('user.privacyAndPolicy')}}">
            <i class="basecolor flaticon-050-info"></i>
            <span class="nav-text">Privacy & Policy</span>
            </a>
        </li>
        <li>
            <a href="{{route('user.termsAndConditions')}}">
            <i class="basecolor flaticon-025-dashboard"></i>
            <span class="nav-text">Terms & Conditions</span>
            </a>
        </li>
        <li>
            <a href="{{route('user.refundAndpolicy')}}">
            <i class="basecolor flaticon-041-graph"></i>
            <span class="nav-text">Refund and policy</span>
            </a>
        </li>
        <li>
            <a href="{{route('user.about')}}">
            <i class="basecolor flaticon-086-star"></i>
            <span class="nav-text">About Us</span>
            </a>
        </li>
        <li>
            <a href="{{route('user.contactUs')}}">
            <i class="basecolor flaticon-381-smartphone-2"></i>
            <span class="nav-text">Contact us</span>
            </a>
        </li>
        </ul>
    </div>
    </div>
    <div class="menu_overlay"></div>
</div>
<div class="div_mobile_next_page">
    <a class="backbtn" id="bckbtn">
        <i class="fa fa-arrow-left"></i>
    </a>
    <a class="backbtn" id="lblMenuName"></a>
</div>