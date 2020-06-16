@extends('layouts.frontend.client')
@section('inline_css')
    <style>
        a {
            color: #333;
        }

        .header-title {
            padding: 5px 10px;
            background: #dadada;
            font-weight: bold;
            width: 255px;
        }
    </style>
    @endsection
@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(/frontend/images/slider-1.jpg);" data-aos="fade">
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
                        <form class="typeahead" role="search" style="position: sticky">
                            <input style="width: 255px" type="search" name="q" class="form-control search-input" placeholder="Tìm kiếm..." autocomplete="off">
                        </form>
                    </div>

                </div>

                <div class="col-md-9 order-2 order-md-2">
                    <div class="row large-gutters" id="app">
                        @foreach($products->sortByDesc('rating') as $product)
                            @php($rates = App\Models\Rate::where('product_id', $product->id)->get())
                            @php($avg = $rates->avg('rating'))
                        <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 " style="position: relative">
                            <div class="ftco-media-1">
                                <div class="ftco-media-1-inner">
                                    <a href="{{ route('products.show', $product->id) }}" class="d-inline-block mb-4"><img src="{{ asset('storage'.$product->image_url) }}" alt="Image" class="img-fluid"></a>
                                    <div class="ftco-media-details">
                                        <h3>{{ $product->name }}</h3>
                                        <rate-avg
                                            avg="{{ json_encode($avg) }}"
                                        ></rate-avg>
                                        <strong>{{ App\Helper\Helper::formatMoney($product->sale_price) }} VNĐ</strong>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <script src="/js/app.js"></script>

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

@section('inline_scripts')
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
@endsection
