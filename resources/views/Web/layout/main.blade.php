<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</head>
<body>
    <div class="container-fluid">
        <div class="row">

            {{-- {{-- @include('Web.layout.sidebar') --> --}}

            <main class="col-md-12 ms-sm-auto col-lg-12 px-4">
                @include('Web.layout.header')

                <div class="container mt-5">
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

    @if($errors->any())
        <script>
            var errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += '{{ $error }}\n';
            @endforeach
            toastr.error(errorMessages, 'Validation Errors', { timeOut: 5000 });
        </script>
    @endif
</body>
</html>
