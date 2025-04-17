<style>
  @keyframes navGradientAnimation {
    0% { background: linear-gradient(90deg, rgb(0, 250, 255) 0%, rgb(0, 255, 234) 50%, rgb(0, 253, 255) 100%); }
    25% { background: linear-gradient(90deg, rgb(0, 200, 255) 0%, rgb(0, 235, 250) 50%, rgb(0, 220, 255) 100%); }
    50% { background: linear-gradient(90deg, rgb(0, 180, 255) 0%, rgb(0, 215, 250) 50%, rgb(0, 200, 255) 100%); }
    75% { background: linear-gradient(90deg, rgb(0, 230, 255) 0%, rgb(0, 255, 240) 50%, rgb(0, 250, 255) 100%); }
    100% { background: linear-gradient(90deg, rgb(0, 250, 255) 0%, rgb(0, 255, 234) 50%, rgb(0, 253, 255) 100%); }
}

.dlabnav {
    
    padding-bottom: 0;
    height: calc(100% - 0px);
   
    padding-top: 0;
    z-index: 6;
    animation: navGradientAnimation 4s infinite ease-in-out;
    background-size: 400% 400%; /* Enhances smooth gradient blending */
    transition: all 0.2s ease;
    box-shadow: 0px 15px 30px 0px rgba(0, 0, 0, 0.02);
}

@media (max-width: 500px) {

  .dlabnav {
  top:3.9rem;
  }
}

.dash_changes {
    font-size: 24px;
    font-weight: bold;
    color: white;
    background: linear-gradient(to bottom, #1919ff, darkred);
    border: 2px solid gold;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
    cursor: pointer;
    position: relative;
    margin-bottom: 10px;
}

.dash_changes::before, .dash_changes::after {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    border-top: 20px solid transparent;
    border-bottom: 20px solid transparent;
}

.dash_changes::before {
    left: -20px; /* Place the triangle to the left */
    border-right: 20px solid gold; /* Triangle on the left */
    top: 50%;
    transform: translateY(-50%);
}

.dash_changes::after {
    right: -20px; /* Place the triangle to the right */
    border-left: 20px solid gold; /* Triangle on the right */
    top: 50%;
    transform: translateY(-50%);
}

        .dashboard {
    /* background: linear-gradient(to bottom, blue, darkblue); */
    background: linear-gradient(to bottom, #1919ff, darkred);
    margin-bottom: 10px;
    border:2px solid gold;
}

        .logout {
            /* background: none; */
            background: linear-gradient(to bottom, #1919ff, darkred);
            color: gold;
            border: 2px solid gold;
            margin-bottom: 10px;
        }
        .dash_changes:hover {
            transform: scale(1.05);
        }

</style>
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
      <a class="brand-logo ">
      <img id="ctl00_imgCompanyLogo" src="{{ asset('storage/' . (webConfig('logo') ?? '')) }}" onerror="this.src='{{ asset('assets_web/images/mv.jpg') }}'" 
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
              <div class="dashboard_bar"> MV Easy Pay </div>
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
          
            
        <li>
            <a id="ctl00_lnkServices" class="dashboard" href="{{ route('index') }}">
            <i class="basecolor fa-solid fa-gauge"></i>
            <span class="nav-text">Dashboard</span>
            </a>
        </li>
        @if(!Auth::check())  
          
          <li>
                <a id="ctl00_lnkServices" class='dash_changes' href="{{ route('login') }}">
                <i class="basecolor flaticon-381-user-2"></i>
                <span class="nav-text">Login</span>
                </a>
            </li>
          
            <li class="nav-item">
            <a class="nav-link dash_changes"  href="{{ route('register') }}">
             <i class="basecolor flaticon-043-menu"></i>
                  <span class="nav-text">Register</span>
                </a>
            </li> 
          @endif
            @if(Auth::check())  
            <li>
                <a class="dash_changes" href="{{ route('user.profile') }}">
                <i class="basecolor flaticon-user"></i>
                <span class="nav-text">My account</span>
                </a>
          </li>

          <li >
            <a class="dash_changes"  href="{{route('user.others')}}">
                <i class="basecolor flaticon-381-more"></i> 
                <span class="nav-text">Others</span>
                </a>
             
            </li>

            <li >
              <a class="dash_changes"  href="{{route('user.add.pin')}}">

                  <i class="basecolor fa-solid fa-thumbtack"></i> 

                  <span class="nav-text">Set Pin</span>

                  </a>
               
              </li>

            <li >
            <a class="dash_changes" href="{{route('user.reports')}}">
            <i class="basecolor flaticon-381-list-1"></i>
                  <span class="nav-text">Reports</span>
                  </a>
            </li>

          @endif
        <!-- <li>
            <a id="ctl00_lnkServices" href="#">
            <i class="basecolor flaticon-381-user-2"></i>
            <span class="nav-text">Services</span>
            </a>
        </li>
        -->
        <li>
            <a class="dash_changes" href="{{route('user.privacyAndPolicy')}}">
            <i class="basecolor flaticon-050-info"></i>
            <span class="nav-text">Privacy & Policy</span>
            </a>
        </li>
        <li>
            <a class="dash_changes" href="{{route('user.termsAndConditions')}}">
            <i class="basecolor flaticon-025-dashboard"></i>
            <span class="nav-text">Terms & Conditions</span>
            </a>
        </li>
        <li>
            <a class="dash_changes" href="{{route('user.refundAndpolicy')}}">
            <i class="basecolor flaticon-041-graph"></i>
            <span class="nav-text">Refund and policy</span>
            </a>
        </li>
        <li>
            <a class="dash_changes" href="{{route('user.about')}}">
            <i class="basecolor flaticon-086-star"></i>
            <span class="nav-text">About Us</span>
            </a>
        </li>
        <li>
            <a class="dash_changes" href="{{route('user.contactUs')}}">
            <i class="basecolor flaticon-381-smartphone-2"></i>
            <span class="nav-text">Contact us</span>
            </a>
        </li>
        @if(Auth::check())  
            <li class="">
            <a class="logout" href="{{route('user.logout')}}">
            <i class="basecolor fa fa-sign-out"></i>
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
    <a href='' class="backbtn" id="bckbtn">
    <img id="ctl00_imgCompanyLogo" src="{{ asset('storage/' . (webConfig('logo') ?? '')) }}" onerror="this.src='{{ asset('assets_web/images/mv.jpg') }}'" 
  style="border-width:0px;width: 100%;height: 35px;"
    alt="Logo"
/>
    </a>
    <a class="backbtn" id="lblMenuName"></a>
</div>