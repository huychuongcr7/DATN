@extends('layouts.frontend.client')
@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(/frontend/images/hero_1.jpg);" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-5 mx-auto mt-lg-5 text-center">
                    <h1>DANH SÁCH SẢN PHẨM</h1>
                </div>
            </div>
        </div>

        <a href="#product-listings" class="smoothscroll arrow-down"><span class="icon-arrow_downward"></span></a>
    </div>

    <div class="site-section" id="product-listings">
        <div class="container">

            <div class="row">
                <div class="col-md-3 order-1 order-md-2">
                    <div class="mb-5">
                        <h3 class="text-black mb-4 h5 font-family-2"><i class="icon icon-filter"></i>Bộ lọc tìm kiếm</h3>
                        <form action="{{ route('products.index') }}" method="get">
                            <div class="form-group">
                                <div class="select-wrap">
                                    <span class="icon icon-keyboard_arrow_down"></span>
                                    <select class="form-control px-3" name="order_by_price">
                                        <option value="">Giá</option>
                                        <option value="asc">Giá: từ thấp đến cao</option>
                                        <option value="desc">Giá: từ cao đến thấp</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="select-wrap">
                                    <span class="icon icon-keyboard_arrow_down"></span>
                                    <select class="form-control px-3">
                                        <option value="">1 Bath, 1 Bedroom</option>
                                        <option value="">2 Bath, 2 Bedroom</option>
                                        <option value="">3+ Bath, 3+ Bedroom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="select-wrap">
                                    <span class="icon icon-keyboard_arrow_down"></span>
                                    <select class="form-control px-3">
                                        <option value="">For Sale</option>
                                        <option value="">For Rent</option>
                                        <option value="">For Lease</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-5">
                                <h3 class="text-black mb-4 h5 font-family-2">Filter by Price</h3>
                                <div id="slider-range" class="border-primary"></div>
                                <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Lọc</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-md-9 order-2 order-md-1">
                    <div class="row large-gutters">
                        @foreach($products as $product)
                        <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 ">
                            <div class="ftco-media-1">
                                <div class="ftco-media-1-inner">
                                    <a href="{{ route('products.show', $product->id) }}" class="d-inline-block mb-4"><img src="{{ asset('storage'.$product->image_url) }}" alt="Image" class="img-fluid"></a>
                                    <div class="ftco-media-details">
                                        <h3>{{ $product->name }}</h3>
                                        <p>New York - USA</p>
                                        <strong>{{ App\Helper\Helper::formatMoney($product->sale_price) }} VNĐ</strong>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-9">
                    <div class="pagination-lg">{{ $products->appends(request()->input())->links() }}</div>
                </div>
            </div>
        </div>
    </div>

@endsection
