<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recharge Web</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- TOASTER Notify CSS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            {{-- @include('Web.layout.sidebar') <!-- Sidebar Include --> --}}

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
                <!-- Header/Nav -->
                @include('Web.layout.header') <!-- Header Include -->

                <div class="container mt-5">
                    @yield('content') <!-- Content Section -->
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    @include('Web.layout.footer') <!-- Footer Include -->

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-notify@3.1.3/dist/bootstrap-notify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
    <!-- TOASTR JS -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- Toastr Notifications from Session -->
    @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}", 'Success Alert', { timeOut: 5000 });
        </script>
    @endif

    @if(session('error'))
        <script>
            toastr.error("{{ session('error') }}", 'Error Alert', { timeOut: 5000 });
        </script>
    @endif

    @if(session('warning'))
        <script>
            toastr.warning("{{ session('warning') }}", 'Warning Alert', { timeOut: 5000 });
        </script>
    @endif

    @if(session('info'))
        <script>
            toastr.info("{{ session('info') }}", 'Information', { timeOut: 5000 });
        </script>
    @endif

</body>
</html>
