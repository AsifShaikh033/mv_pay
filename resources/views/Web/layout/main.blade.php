

<!DOCTYPE html>

<html lang="en" class="notranslate" translate="no">

<head>
    
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<meta name="theme-color" content="#42A5F5" />
<meta name="apple-mobile-web-app-status-bar" content="#42A5F5" />
<meta name="mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-title" content="IOS_SPLASH_TEXT" />
<meta name="apple-itunes-app" content="app-id=IOS_APP_ID" />
<meta name="google-play-app" content="app-id=GOOGLE_APP_ID" />
<meta http-equiv="Pragma" content="no-cache" />
<link rel="apple-touch-startup-image" href="../../pwa/App_icon/192x192.png" />
<link href="{{ asset('assets_web/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet" />
<link href="{{ asset('assets_web/vendor/select2/css/select2.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets_web/js/jquery-ui.css')}}" />
<link href="{{ asset('assets_web/css/style.css')}}" rel="stylesheet" />
<link href="{{ asset('assets_web/css/dashboard.css')}}" rel="stylesheet" />
<link href="{{ asset('assets_web/css/serives.css')}}" rel="stylesheet" />
<link href="{{ asset('assets_web/css/StyleSheet2.css')}}" rel="stylesheet" />
<link href="{{ asset('assets_web/css/Loader.css')}}" rel="stylesheet" />
<link href="{{ asset('assets_web/icons/flaticon_1/flaticon_1.css')}}" rel="stylesheet" />
<link href="{{ asset('assets_web/fonts2/flaticon.css')}}" rel="stylesheet" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<title>{{ webConfig('web_title', 'Default Title') }}</title>
<meta name="description" content="{{ webConfig('tagline', 'Default Description') }}">
<link rel="icon" href="{{ asset('storage/' . webConfig('fav_icon', 'default-favicon.ico')) }}" type="image/x-icon">
<!-- Open Graph Meta Tags -->
<meta property="og:title" content="{{ webConfig('web_title', 'Default Title') }}">
<meta property="og:description" content="{{ webConfig('tagline', 'Default Description') }}">
<meta property="og:image" content="{{ asset('storage/' . webConfig('logo', 'default-image.png')) }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">

    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- TOASTER Notify CSS -->
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <style>
        .brand-logo img {
            max-width: calc(100% - 60px);
        }

        .cls_Mobile > span {
            top: 4.4rem;
        }
        .body{
            background: linear-gradient(277deg, #8b005e, #14002e) !important;
            font-family:open sans,sans-serif;
        }
    </style>
    <script type="text/javascript" src="../../../ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
    #loader-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(277deg, #8b005e, #14002e) !important; /* or any background color */
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #loader {
        width: 50%;
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    @media only screen and (max-width: 600px) {
        #loader {
            width: 100%;
        }
    }

    #loader img {
        width: 100%;
        height: auto;
    }

    @keyframes spin {
        0%   { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
</head>
<body class="body">
    <div id="loader-wrapper">
        <div id="loader">
          <img src="{{ asset('assets_web/images/loadernew.gif') }}" alt="Loading..." />
        </div>
    </div>
        
    <div class="container-fluid pb-5 mb-5">
        <div class="row">

            
            <main class="col-md-12 ms-sm-auto col-lg-12 ">
               <!-- @include('Web.layout.sidebar')  -->
                @include('Web.layout.header')

                <div>
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @include('Web.layout.footer')

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}", 'Success', { timeOut: 8000 });
        </script>
    @endif

    @if(session('error'))
        <script>
            toastr.error("{{ session('error') }}", 'Alert', { timeOut: 8000 });
        </script>
    @endif

    @if(session('warning'))
        <script>
            toastr.warning("{{ session('warning') }}", 'Warning', { timeOut: 8000 });
        </script>
    @endif

    @if(session('info'))
        <script>
            toastr.info("{{ session('info') }}", 'Information', { timeOut: 8000 });
        </script>
    @endif

    @if($errors->any())
        <script>
            var errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += '{{ $error }}\n';
            @endforeach
            toastr.error(errorMessages, 'Validation Errors', { timeOut: 8000 });
        </script>
    @endif


    
        <!-- Required vendors -->
        <script type="text/javascript" src="{{ asset('assets_web/vendor/global/global.min.js')}}"></script>

        <script type="text/javascript" src="{{ asset('assets_web/css/ddl/select2/dist/js/select2.min.js')}}"></script>
        <script src="../../../code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{ asset('assets_web/vendor/chart.js/Chart.bundle.min.js')}}"></script>
        <script src="{{ asset('assets_web/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
        <!-- Dashboard 1 -->

        <script src="{{ asset('assets_web/js/custom.min.js')}}"></script>
        <script src="{{ asset('assets_web/js/dlabnav-init.js')}}"></script>
        <script src="{{ asset('assets_web/js/demo.js')}}"></script>
        <script src="{{ asset('assets_web/js/styleSwitcher.js')}}"></script>
        <script src="{{ asset('assets_web/js/Common3860.js?v=')}}1"></script>
        <script src="{{ asset('assets_web/js/Common3860.js?v=1')}}"></script>
        <script src="{{ asset('assets_web/js/customer.js')}}"></script>
        <script type="text/javascript" src="master3860.js?v=1"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                fn_loadselect();
                fn_custmerldata();
               // fn_maintenance();
                //getLocation();
            });
            $(document).on('focus', ':input', function () {
                $(this).attr('autocomplete', 'off');
            });



            
            function LoadTables() {

                fn_loadMenus();

            }

            document.onreadystatechange = function () {
                if (document.readyState === "complete") {

                }
                else {
                    window.onload = function () {
                        LoadTables();
                    }
                };
            };

            function fn_show_popup(id) {
                $("#registration_Login_popup").addClass('active');
            }
            function fn_show_popup_close() {
                $("#registration_Login_popup").removeClass('active');

            }

            function onclick_logOut(evnt) {
                localStorage.removeItem("setauthdata");
                return true;
            }
            function enablePopupMy() {
                fn_show_popup('0')
            }
        </script>
        <div class="glitchButton" style="position: fixed; bottom: 20px; right: 20px;"></div>

</body>
<script>
  window.addEventListener('load', function () {
    const loader = document.getElementById('loader-wrapper');
    if (loader) {
      loader.style.display = 'none';
    }
  });
</script>


</html>
