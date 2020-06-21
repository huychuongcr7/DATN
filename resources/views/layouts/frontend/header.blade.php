<header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

    <div class="container">
        <div class="row align-items-center">

            <div class="col-6 col-xl-2">
                <h1 class="mb-0 site-logo m-0 p-0"><a href="{{ route('welcome') }}" class="mb-0">CR7 STORE</a></h1>
            </div>

            <div class="col-12 col-md-6 d-none d-xl-block">
                <nav class="site-navigation position-relative text-left" role="navigation">

                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                        <li><a href="{{ route('welcome') }}" class="nav-link">Trang chủ</a></li>
                        <li><a href="{{ route('products.index') }}" class="nav-link">Sản phẩm</a></li>
                        <li><a href="{{ route('posts.index') }}" class="nav-link">Tin tức</a></li>
                        <li><a href="{{ route('contacts.create') }}" class="nav-link">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-6 col-md-4 d-none d-xl-block">
                <nav class="site-navigation position-relative text-right" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block" style="padding-left: 0">
                        @if (Auth::guard('customer')->check() == 'Guest')
                        <li>
                            <div class="dropdown">
                                <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon icon-user"></i> {{ Auth::guard('customer')->user()->name }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('customers.index') }}">Tài khoản</a>
                                    <a class="dropdown-item" href="{{ route('customers.get_bill') }}">Đơn hàng</a>
                                    <a class="dropdown-item" href="{{ route('customer.logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">Đăng xuất <i class="icon icon-sign-out"></i></a>
                                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="btn btn-default" href="{{ route('carts.index') }}">
                                <i class="icon-shopping-cart"></i> Giỏ hàng
                                @php($countCart = App\Models\Cart::where('customer_id', '=', Auth::guard('customer')->user()->id)->get()->sum('quantity'))
                                <span class="badge badge-light">{{ $countCart }}</span>
                            </a>
                        </li>
                        @else
                            <li><a href="{{ route('customer.login') }}" class="nav-link"><i class="icon icon-sign-out"></i> Đăng nhập</a></li>
                            <li>
                                <a class="btn btn-default" href="{{ route('carts.index') }}">
                                    <i class="icon-shopping-cart"></i> Giỏ hàng
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class="col-12 col-md-12 text-center">
                <form class="typeahead" role="search" style="position: sticky">
                    <input style="width: 500px" type="search" name="q" class="form-control search-input" placeholder="Tìm kiếm..." autocomplete="off">
                </form>
            </div>


            <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white float-right"><span class="icon-menu h3"></span></a></div>

        </div>
    </div>

</header>
