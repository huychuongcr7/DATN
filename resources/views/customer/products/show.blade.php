@extends('layouts.frontend.client')
@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div id="app">
        <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(/frontend/images/grocery.png);" data-aos="fade">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-5 mx-auto mt-lg-5 text-center">
                        <h1>Chi tiết sản phẩm</h1>
                    </div>
                </div>
            </div>

            <a href="#product-details" class="smoothscroll arrow-down"><span class="icon-arrow_downward"></span></a>
        </div>

        <div class="site-section" id="product-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="owl-carousel slide-one-item with-dots">
                            <div><img src="{{ asset($product->image_url) }}" alt="Image" class="img-fluid" style="max-width: 100%"></div>
                        </div>
                    </div>
                    <div class="col-lg-7 pl-lg-5 ml-auto">
                        <div class="mb-5">
                            <form method="post" action="{{ route('carts.store') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <h3 class="text-black mb-4">{{ $product->name }}</h3>
                                <p>Giá sản phẩm: <span class="text-danger">{{ App\Helper\Helper::formatMoney($product->sale_price) }} VNĐ</span></p>
                                <p>Mô tả: {{ $product->description }}</p>
                                @if($product->rating == null)
                                    <p>Đánh giá: <span>Sản phẩm chưa có đánh giá</span></p>
                                @else
                                    <p>Đánh giá:</p>
                                    <div style="padding-bottom: 30px">
                                        <rate-avg
                                            avg="{{ json_encode($product->rating) }}"
                                        ></rate-avg>
                                    </div>
                                @endif
                                <div class="col-lg-7" style="padding-left: 0">
                                    <div class="input-group">
                                        <p>Số lượng: </p>
                                        <span class="input-group-btn" style="margin-left: 20px">
                                            <button type="button" class="quantity-left-minus btn btn-outline-dark btn-number"  data-type="minus" data-field="" style="padding-left: 20px; padding-right: 20px; padding-bottom:8px">
                                                <i class="icon-minus"></i>
                                            </button>
                                        </span>
                                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-right-plus btn btn-outline-dark btn-number" data-type="plus" data-field="" style="padding-left: 20px; padding-right: 20px; padding-bottom:8px">
                                                <i class="icon-plus"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <br>
                                @if ($product->inventory > 0)
                                    <button type="submit" class="btn btn-primary" id="add-to-cart"><i class="icon icon-cart-plus"></i> Thêm Vào Giỏ Hàng</button>
                                @else
                                    <p class="text-danger">Hết hàng</p>
                                    <button class="btn btn-primary" id="add-to-cart" disabled><i class="icon icon-cart-plus"></i> Thêm Vào Giỏ Hàng</button>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="col-lg" style="padding-top:50px">
                        <rating-form
                            product-id="{{ json_encode($product->id) }}"
                            is-buyed="{{ in_array($product->id, $productIds) }}"
                            create-rate="{{ route('rates.store') }}"
                            rates="{{ json_encode($rates) }}"
                        ></rating-form>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section" id="properties-section">
            <div class="container">
                <div class="row mb-5 align-items-center">
                    <div class="col-md-7 text-left">
                        <h2 class="section-title mb-3">Sản phẩm gợi ý</h2>
                    </div>
                    <div class="col-md-5 text-left text-md-right">
                        <div class="custom-nav1">
                            <a href="#" class="custom-prev1">Trước</a><span class="mx-3">/</span><a href="#" class="custom-next1">Tiếp</a>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel nonloop-block-13 mb-5">
                    @foreach($productRecommends as $productRecommend)
                            <div class="ftco-media-1">
                                <div class="ftco-media-1-inner">
                                    <a href="{{ route('products.show', $productRecommend->id) }}" class="d-inline-block mb-4"><img src="{{ asset('storage'.$productRecommend->image_url) }}" class="img-fluid"></a>
                                    <div class="ftco-media-details">
                                        <h3>{{ $productRecommend->name }}</h3>
                                        <rate-avg
                                            avg="{{ json_encode($productRecommend->rating) }}"
                                        ></rate-avg>
                                        <strong>{{ App\Helper\Helper::formatMoney($productRecommend->sale_price) }} VNĐ</strong>
                                        <p>Độ phù hợp: {{ round($productRecommend->similarity * 100, 1) }}%</p>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('inline_scripts')
    <script>
        $(document).ready(function(){
            var quantitiy=0;
            $('.quantity-right-plus').click(function(e){
                e.preventDefault();
                var quantity = parseInt($('#quantity').val());
                $('#quantity').val(quantity + 1);
            });

            $('.quantity-left-minus').click(function(e){
                e.preventDefault();
                var quantity = parseInt($('#quantity').val());
                if(quantity>1){
                    $('#quantity').val(quantity - 1);
                }
            });
            $('#rating').click(function () {
                console.log($(this).val())
            })
        });
    </script>
@endsection
