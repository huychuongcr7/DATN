<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.frontend.head')

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        @include('layouts.frontend.header')

        @include('sweetalert::alert')

        @yield('content')

        @include('layouts.frontend.footer')

    </div> <!-- .site-wrap -->

    <a href="javascript:void(0);" class="gototop" style="top: 350px"><span class="icon-angle-double-up"></span></a>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('frontend/js/aos.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('backend/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function($) {
            var engine1 = new Bloodhound({
                remote: {
                    url: '/products/search/name?value=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            var engine2 = new Bloodhound({
                remote: {
                    url: '/products/search/product_code?value=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $(".search-input").typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, [
                {
                    source: engine1.ttAdapter(),
                    name: 'students-name',
                    display: function(data) {
                        return data.name;
                    },
                    templates: {
                        empty: [
                            '<div class="header-title">Tên sản phẩm</div><div class="list-group search-results-dropdown"><div class="list-group-item">Không tìm thấy.</div></div>'
                        ],
                        header: [
                            '<div class="header-title">Tên sản phẩm</div><div class="list-group search-results-dropdown"></div>'
                        ],
                        suggestion: function (data) {
                            return '<a href="/products/' + data.id + '" class="list-group-item" style="">' + data.name + '</a>';
                        }
                    }
                },
                {
                    source: engine2.ttAdapter(),
                    name: 'students-email',
                    display: function(data) {
                        return data.email;
                    },
                    templates: {
                        empty: [
                            '<div class="header-title">Mã sản phẩm</div><div class="list-group search-results-dropdown"><div class="list-group-item">Không tìm thấy.</div></div>'
                        ],
                        header: [
                            '<div class="header-title">Mã sản phẩm</div><div class="list-group search-results-dropdown"></div>'
                        ],
                        suggestion: function (data) {
                            return '<a href="/products/' + data.id + '" class="list-group-item">' + data.product_code + '</a>';
                        }
                    }
                }
            ]);
        });
    </script>

    @yield('inline_scripts')
</body>
</html>
