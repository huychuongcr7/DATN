@extends('layouts.frontend.client')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(/frontend/images/grocery.png);" data-aos="fade">
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
                <div class="col-md-3 order-1 order-md-1">
                    <div class="mb-5">
                        <h3 class="text-black mb-4 h5 font-family-2"><i class="icon icon-filter"></i>Bộ lọc tìm kiếm</h3>
                        <form action="{{ route('products.index') }}" method="get">
                            <div class="form-group">
                                <div class="select-wrap">
                                    <span class="icon icon-keyboard_arrow_down"></span>
                                    <select class="form-control px-3" name="order_by_price">
                                        <option value="">Giá</option>
                                        <option value="asc" @if ('asc' == request('order_by_price'))selected="selected"@endif>Giá: từ thấp đến cao</option>
                                        <option value="desc" @if ('desc' == request('order_by_price'))selected="selected"@endif>Giá: từ cao đến thấp</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="select-wrap">
                                    <span class="icon icon-keyboard_arrow_down"></span>
                                    <select class="form-control px-3" name="category_id">
                                        <option value="">Danh mục sản phẩm</option>
                                        @foreach($categories as $key => $category)
                                            <option value="{{ $key }}"
                                                    @if ($key == request('category_id'))
                                                    selected="selected"
                                                @endif
                                            >{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Lọc</button>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="col-md-9 order-2 order-md-2">
                    <div class="row large-gutters" id="app">
                        @foreach($products as $product)
                        <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 " style="position: relative">
                            <div class="ftco-media-1">
                                <div class="ftco-media-1-inner">
                                    <a href="{{ route('products.show', $product->id) }}" class="d-inline-block mb-4"><img src="{{ asset($product->image_url) }}" alt="Image" class="img-fluid"></a>
                                    <div class="ftco-media-details">
                                        <h3>{{ $product->name }}</h3>
                                        <rate-avg
                                            avg="{{ json_encode($product->rating) }}"
                                        ></rate-avg>
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
                    <div>{{ $products->appends(request()->input())->links() }}</div>
                </div>
            </div>
        </div>
    </div>

@endsection
