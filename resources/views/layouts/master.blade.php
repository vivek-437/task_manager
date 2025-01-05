<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') | Task Manager</title>

    <link rel="shortcut icon" href="images/favicon.png" />
    @include('layouts.head-css')
    @yield('css')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Add Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <!-- Add Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body>
    <div class="container-scroller">
        @include('layouts.topbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.theme')
            @include('layouts.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')

                    @include('layouts.footer')

                </div>
            </div>
        </div>
    </div>
    @include('layouts.vendor-script')
    @yield('script')
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right", // Change position if needed
            "timeOut": "5000", // Display duration
        };

        // Show success, error, or info messages from session flash
        @if (session('success'))
            toastr.success("{{ session('success') }}", 'Success');
        @elseif (session('error'))
            toastr.error("{{ session('error') }}", 'Error');
        @elseif (session('info'))
            toastr.info("{{ session('info') }}", 'Information');
        @endif
    </script>
</body>

</html>
