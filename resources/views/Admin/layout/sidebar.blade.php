

<style>
  .active {
    color: #fff;
    background-color: #106770ad;
}

  </style>
<div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img
              src="{{ asset('storage/' . webConfig('logo')) }}" alt="Logo"
              alt="navbar brand"
                class="navbar-brand"
                height="60" width="90"
              />
            </a>
           
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item ">
                <a
                  data-bs-toggle="collapse"
                  href="#dashboard"
                  class="collapsed"
                  aria-expanded="false"
                >
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="dashboard">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="../demo1/index.html">
                        <span class="sub-item">Dashboard 1</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-section">
                <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
                </span>
                <h4 class="text-section">Components</h4>
              </li>
   <li class="nav-item">  
            <a data-bs-toggle="collapse" href="#base"  
            aria-expanded="{{ Request::routeIs('admin.webconfig.edit')
             || Request::routeIs('admin.banner.list') 
              || Request::routeIs('admin.webhook.list') 
            || Request::routeIs('admin.balance.cashback.list') ? 'true' : 'false' }}">
            <i class="fas fa-layer-group"></i>
            <p>Configuration</p>
            <span class="caret"></span>
          </a>
    <div class="collapse {{ Request::routeIs('admin.webconfig.edit')
     || Request::routeIs('admin.banner.list') 
      || Request::routeIs('admin.webhook.list') ||
      Request::routeIs('admin.balance.cashback.list') ? 'show' : '' }}" id="base">
        <ul class="nav nav-collapse">
              <li>
                  <a href="{{ route('admin.webconfig.edit') }}" class="{{ Request::routeIs('admin.webconfig.edit') ? 'active' : '' }}">
                      <span class="sub-item">Web Configuration</span>
                  </a>
              </li>
              <li>
                  <a href="{{ route('admin.banner.list') }}" class="{{ Request::routeIs('admin.banner.list') ? 'active' : '' }}">
                      <span class="sub-item">Banner</span>
                  </a>
              </li>
              <!-- <li>
                <a href="{{ route('admin.balance.cashback.list') }}" class="{{ Request::routeIs('admin.balance.cashback.list') ? 'active' : '' }}">
               
                  <span class="sub-item">Balance Cashback</span>
                  <span class="badge badge-secondary">1</span>
                </a>
              </li> -->
              <li>
                  <a href="{{ route('admin.utr.list') }}" class="{{ Request::routeIs('admin.utr.list') ? 'active' : '' }}">
                      <span class="sub-item">UTR Number</span>
                  </a>
              </li>
             
              <li>
                  <a href="{{ route('admin.webhook.list') }}" class="{{ Request::routeIs('admin.webhook.list') ? 'active' : '' }}">
                      <span class="sub-item">Webhook</span>
                  </a>
              </li>
          </ul>
      </div>
  </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables" 
                      aria-expanded="{{ Request::routeIs('admin.user.list') ? 'true' : 'false' }}">
                        <i class="fas fa-users"></i>
                        <p>Users</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::routeIs('admin.user.list') ? 'show' : '' }}" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.user.list') }}" class="{{ Request::routeIs('admin.user.list') ? 'active' : '' }}">
                                    <span class="sub-item">User List</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
             
                
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#transaction" 
                      aria-expanded="{{ Request::routeIs('admin.transaction.list')
                      || Request::routeIs('admin.spin.cashback') || Request::routeIs('admin.withdrawal.list')  ? 'true' : 'false' }}">
                      <i class="fas fa-th-list"></i>
                      <p>Transactions</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::routeIs('admin.transaction.list') 
                       || Request::routeIs('admin.spin.cashback') || Request::routeIs('admin.withdrawal.list')? 'show' : '' }}" id="transaction">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.transaction.list') }}" class="{{ Request::routeIs('admin.transaction.list') ? 'active' : '' }}">
                                    <span class="sub-item">Transaction List</span>
                                </a>
                            </li>
                            <li>
                              <a href="{{ route('admin.withdrawal.list') }}" class="{{ Request::routeIs('admin.withdrawal.list') ? 'active' : '' }}">
                                  <span class="sub-item">Withdrawal History</span>
                              </a>
                          </li>
                          <li>
                              <a href="{{ route('admin.spin.cashback') }}" class="{{ Request::routeIs('admin.spin.cashback') ? 'active' : '' }}">
                                  <span class="sub-item">Spin Winners</span>
                              </a>
                          </li>
                        </ul>
                    </div>
                </li>

              
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#leads_generation">
                  <i class="fas fa-th-list"></i>
                  <p>Leads Generation</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="leads_generation">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="{{route('admin.lead_generation.index')}}">
                        <span class="sub-item">Lead list</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
             
             

            </ul>
          </div>
        </div>
      </div>