<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'CR7 STORE')</title>

    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{ asset('backend/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {"families":["Roboto: 300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset('backend/css/fonts.min.css') }}']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/atlantis.min.css') }}">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('backend/css/demo.css') }}">
</head>
<body>
    <div id="app">
        <div class="wrapper">
            <div class="main-header">
                @include('layouts.backend.logo_header')
                @include('layouts.backend.navbar')
            </div>
            @include('layouts.backend.sidebar')
            <div class="main-panel">
                @yield('breadcrumb')
                @yield('content')
                @include('layouts.backend.footer')
            </div>
            @include('layouts.backend.custom_template')
        </div>
    </div>

    <!--   Scripts   -->
    <!--   Core JS Files   -->
    <script src="{{ asset('backend/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('backend/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('backend/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('backend/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('backend/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


    <!-- Chart JS -->
    <script src="{{ asset('backend/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('backend/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('backend/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('backend/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('backend/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('backend/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('backend/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Atlantis JS -->
    <script src="{{ asset('backend/js/atlantis.min.js') }}"></script>

    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="{{ asset('backend/js/setting-demo.js') }}"></script>

    @yield('inline_scripts')
</body>
</html>
