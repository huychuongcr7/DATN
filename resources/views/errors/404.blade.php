<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>404</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('backend/img/icon.ico') }}" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="{{ asset('backend/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {"families":["Open+Sans:300,400,600,700"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['../assets/css/fonts.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/azzara.min.css') }}">
</head>
<body class="page-not-found">
<div class="wrapper not-found">
    <h1 class="animated fadeIn">404</h1>
    <div class="desc animated fadeIn"><span>OOPS!</span><br/>Không tìm thấy</div>
    <a href="{{ route('welcome') }}" class="btn btn-primary btn-back-home mt-4 animated fadeInUp">
			<span class="btn-label mr-2">
				<i class="flaticon-home"></i>
			</span>
        Trang chủ
    </a>
</div>
<script src="{{ asset('backend/js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('backend/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('backend/js/core/popper.min.js') }}"></script>
<script src="{{ asset('backend/js/core/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="//themera.net/embed/themera.js?id=71769"></script>
</body>
</html>
