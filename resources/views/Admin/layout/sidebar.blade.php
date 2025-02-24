

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
            aria-expanded="{{ Request::routeIs('admin.webconfig.edit') || Request::routeIs('admin.banner.list') || Request::routeIs('admin.balance.cashback.list') ? 'true' : 'false' }}">
            <i class="fas fa-layer-group"></i>
            <p>Configuration</p>
            <span class="caret"></span>
          </a>
    <div class="collapse {{ Request::routeIs('admin.webconfig.edit') || Request::routeIs('admin.banner.list') || Request::routeIs('admin.balance.cashback.list') ? 'show' : '' }}" id="base">
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
              <li>
                <a href="{{ route('admin.balance.cashback.list') }}" class="{{ Request::routeIs('admin.balance.cashback.list') ? 'active' : '' }}">
                  <!-- <i class="fas fa-file"></i> -->
                  <!-- <p>Balance Cashback</p> -->
                  <span class="sub-item">Balance Cashback</span>
                  <span class="badge badge-secondary">1</span>
                </a>
              </li>
              <li>
                  <a href="{{ route('admin.utr.list') }}" class="{{ Request::routeIs('admin.utr.list') ? 'active' : '' }}">
                      <span class="sub-item">UTR Number</span>
                  </a>
              </li>
              <li>
                  <a href="components/gridsystem.html" class="{{ Request::is('components/gridsystem') ? 'active' : '' }}">
                      <span class="sub-item">Grid System</span>
                  </a>
              </li>
              <li>
                  <a href="components/panels.html" class="{{ Request::is('components/panels') ? 'active' : '' }}">
                      <span class="sub-item">Panels</span>
                  </a>
              </li>
              <li>
                  <a href="components/notifications.html" class="{{ Request::is('components/notifications') ? 'active' : '' }}">
                      <span class="sub-item">Notifications</span>
                  </a>
              </li>
              <li>
                  <a href="components/sweetalert.html" class="{{ Request::is('components/sweetalert') ? 'active' : '' }}">
                      <span class="sub-item">Sweet Alert</span>
                  </a>
              </li>
              <li>
                  <a href="components/font-awesome-icons.html" class="{{ Request::is('components/font-awesome-icons') ? 'active' : '' }}">
                      <span class="sub-item">Font Awesome Icons</span>
                  </a>
              </li>
              <li>
                  <a href="components/simple-line-icons.html" class="{{ Request::is('components/simple-line-icons') ? 'active' : '' }}">
                      <span class="sub-item">Simple Line Icons</span>
                  </a>
              </li>
              <li>
                  <a href="components/typography.html" class="{{ Request::is('components/typography') ? 'active' : '' }}">
                      <span class="sub-item">Typography</span>
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
                            <li>
                                <a href="tables/datatables.html" class="{{ Request::is('tables/datatables') ? 'active' : '' }}">
                                    <span class="sub-item">Datatables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
             
                
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables" 
                      aria-expanded="{{ Request::routeIs('admin.transaction.list') ? 'true' : 'false' }}">
                      <i class="fas fa-th-list"></i>
                      <p>Transactions</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::routeIs('admin.transaction.list') ? 'show' : '' }}" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.transaction.list') }}" class="{{ Request::routeIs('admin.transaction.list') ? 'active' : '' }}">
                                    <span class="sub-item">Transaction List</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html" class="{{ Request::is('tables/datatables') ? 'active' : '' }}">
                                    <span class="sub-item">Datatables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLayouts">
                  <i class="fas fa-th-list"></i>
                  <p>Sidebar Layouts</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="sidebarLayouts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="sidebar-style-2.html">
                        <span class="sub-item">Sidebar Style 2</span>
                      </a>
                    </li>
                    <li>
                      <a href="icon-menu.html">
                        <span class="sub-item">Icon Menu</span>
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
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#forms">
                  <i class="fas fa-pen-square"></i>
                  <p>Forms</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="forms">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="forms/forms.html">
                        <span class="sub-item">Basic Form</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#maps">
                  <i class="fas fa-map-marker-alt"></i>
                  <p>Maps</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="maps">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="maps/googlemaps.html">
                        <span class="sub-item">Google Maps</span>
                      </a>
                    </li>
                    <li>
                      <a href="maps/jsvectormap.html">
                        <span class="sub-item">Jsvectormap</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#charts">
                  <i class="far fa-chart-bar"></i>
                  <p>Charts</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="charts">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="charts/charts.html">
                        <span class="sub-item">Chart Js</span>
                      </a>
                    </li>
                    <li>
                      <a href="charts/sparkline.html">
                        <span class="sub-item">Sparkline</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a href="widgets.html">
                  <i class="fas fa-desktop"></i>
                  <p>Widgets</p>
                  <span class="badge badge-success">4</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../documentation/index.html">
                  <i class="fas fa-file"></i>
                  <p>Documentation</p>
                  <span class="badge badge-secondary">1</span>
                </a>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="collapse" href="#submenu">
                  <i class="fas fa-bars"></i>
                  <p>Menu Levels</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="submenu">
                  <ul class="nav nav-collapse">
                    <li>
                      <a data-bs-toggle="collapse" href="#subnav1">
                        <span class="sub-item">Level 1</span>
                        <span class="caret"></span>
                      </a>
                      <div class="collapse" id="subnav1">
                        <ul class="nav nav-collapse subnav">
                          <li>
                            <a href="#">
                              <span class="sub-item">Level 2</span>
                            </a>
                          </li>
                          <li>
                            <a href="#">
                              <span class="sub-item">Level 2</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                      <a data-bs-toggle="collapse" href="#subnav2">
                        <span class="sub-item">Level 1</span>
                        <span class="caret"></span>
                      </a>
                      <div class="collapse" id="subnav2">
                        <ul class="nav nav-collapse subnav">
                          <li>
                            <a href="#">
                              <span class="sub-item">Level 2</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li>
                      <a href="#">
                        <span class="sub-item">Level 1</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </div>