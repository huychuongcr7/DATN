@extends('layouts.frontend.client')
@section('title', 'Giỏ hàng')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(/frontend/images/slider-1.jpg);" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-5 mx-auto mt-lg-5 text-center">
                    <h1>giỏ hàng</h1>
                </div>
            </div>
        </div>

        <a href="#properties-section" class="smoothscroll arrow-down"><span class="icon-arrow_downward"></span></a>
    </div>

    <div class="site-section" id="properties-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h2 class="section-title mb-3">giỏ hàng</h2>
                </div>
            </div>
        </div>
        <div class="container">
            @if($products)
                <div id="app">
                    <cart-form
                        all-products="{{ json_encode($products) }}"
                        delete-url="{{ route('carts.destroy', '%productId') }}"
                        href="{{ route('products.show', ['id' => '%id%']) }}"
                        update-url="{{ route('carts.update', '%productId') }}"
                        create-bill="{{ route('customers.create_bill') }}"
                        welcome="{{ route('welcome') }}"
                    ></cart-form>
                </div>
                <script src="/js/app.js"></script>
            @else
                <div class="text-center">
                    <h3 class="text-black">Không có sản phẩm nào trong giỏ hàng</h3>
                    <a class="btn btn-primary" href ="{{ route('welcome') }}"> Mua ngay</a>
                </div>
            @endif
        </div>
    </div>

@endsection
