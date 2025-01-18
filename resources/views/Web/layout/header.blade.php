<div id="main-wrapper">
  <div class="mainpage">
    <div class="nav-header">
      <div class="nav-control">
        <div class="hamburger">
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </div>
      </div>
      <a class="brand-logo">
      <img 
    id="ctl00_imgCompanyLogo" 
    src="{{ asset('storage/' . (webConfig('logo') ?? '')) }}" 
    onerror="this.src='{{ asset('assets_web/images/mv.jpg') }}'" 
   style="border-width:0px;width: 100px;height: 50px;"
    alt="Logo"
/>

        <!-- <img id="ctl00_imgCompanyLogo" src="{{ asset('storage/' . webConfig('logo', 'default-image.png')) }}{{ asset('assets_web/images/mv.jpg')}}" style="border-width:0px;width: 100px;height: 50px;"/> -->
      </a>
    </div>
    <div class="header">
      <div class="header-content">
        <nav class="navbar navbar-expand">
          <div class="collapse navbar-collapse justify-content-between">
            <div class="header-left">
              <div class="dashboard_bar"> MV Pay </div>
            </div>
            <ul class="navbar-nav header-right">
              <li class="nav-item">
                <div class="input-group search-area">
                  <input type="text" class="form-control" placeholder="Search here...">
                  <span class="input-group-text">
                    <a href="javascript:void(0)">
                      <i class="flaticon-381-search-2"></i>
                    </a>
                  </span>
                </div>
              </li>
              <li class="nav-item"></li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <div class="div_mobile_next_page">
      <a class="backbtn" id="bckbtn">
        <i class="fa fa-arrow-left"></i>
      </a>
      <a class="backbtn" id="lblMenuName"></a>
    </div>
    <div class="dlabnav">
    <div class="dlabnav-scroll">
    
        <ul class="metismenu" id="menu">
            @if(!Auth::check())  

            <li>
                  <a id="ctl00_lnkServices" href="{{ route('login') }}">
                  <i class="basecolor flaticon-381-user-2"></i>
                  <span class="nav-text">Login</span>
                  </a>
              </li>
            
              <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">
               <i class="basecolor flaticon-043-menu"></i>
                    <span class="nav-text">Register</span>
                  </a>
              </li> 
            @endif
        <li>
            <a id="ctl00_lnkServices" href="{{ route('index') }}">
            <i class="basecolor flaticon-381-user-2"></i>
            <span class="nav-text">Dashboard</span>
            </a>
        </li>
            @if(Auth::check())  
            <li>
                <a href="{{ route('user.profile') }}">
                <i class="basecolor flaticon-381-user-2"></i>
                <span class="nav-text">My account</span>
                </a>
          </li>
          @endif
        <!-- <li>
            <a id="ctl00_lnkServices" href="#">
            <i class="basecolor flaticon-381-user-2"></i>
            <span class="nav-text">Services</span>
            </a>
        </li>
       
        <li>
            <a>
            <i class="basecolor flaticon-043-menu"></i>
            <span class="nav-text">Payment History</span>
            </a>
        </li> -->
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
        @if(Auth::check())  
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.logout') }}">
                <i class="basecolor flaticon-043-menu"></i>
                  <span class="nav-text">Logout</span>
                </a>
            </li>
          @endif
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