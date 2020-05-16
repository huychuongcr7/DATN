@extends('layouts.frontend.client')
@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(/frontend/images/hero_1.jpg);" data-aos="fade">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-5 mx-auto mt-lg-5 text-center">
                    <h1>HD17 19 Utica Ave, New York, USA</h1>
                    <p class="mb-5"><strong class="text-white">$2,000,000</strong></p>

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
                        <div><img src="{{ asset('storage'.$product->image_url) }}" alt="Image" class="img-fluid" style="max-width: 100%"></div>
                    </div>
                </div>
                <div class="col-lg-7 pl-lg-5 ml-auto">
                    <div class="mb-5">
                        <form method="post" action="{{ route('cart.store') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <h3 class="text-black mb-4">{{ $product->name }}</h3>
                            <p>Giá sản phẩm: <span class="text-danger">{{ App\Helper\Helper::formatMoney($product->sale_price) }} VNĐ</span></p>
                            <p>Mô tả: {{ $product->description }}</p>
                            <div class="col-lg-7" style="padding-left: 0">
                                <div class="input-group">
                                    <p>Số lượng: </p>
                                    <span class="input-group-btn" style="margin-left: 20px">
                                        <button type="button" class="quantity-left-minus btn btn-default btn-number"  data-type="minus" data-field="" style="padding-left: 20px; padding-right: 20px; padding-bottom:8px">
                                            <i class="icon-minus"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-default btn-number" data-type="plus" data-field="" style="padding-left: 20px; padding-right: 20px; padding-bottom:8px">
                                            <i class="icon-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <br>
                            <p><button type="submit" class="btn btn-primary" id="add-to-cart"><i class="icon icon-cart-plus"></i> Thêm Vào Giỏ Hàng</button></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section" id="properties-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 text-left">
                    <h2 class="section-title mb-3">Sản phẩm liên quan</h2>
                </div>
            </div>
            <div class="row large-gutters">
                @foreach($productOthers as $productOther)
                    <div class="col-md-6 col-lg-3 mb-5 mb-lg-5 ">
                        <div class="ftco-media-1">
                            <div class="ftco-media-1-inner">
                                <a href="{{ route('products.show', $productOther->id) }}" class="d-inline-block mb-4"><img src="{{ asset('storage'.$productOther->image_url) }}" class="img-fluid"></a>
                                <div class="ftco-media-details">
                                    <h3>{{ $productOther->name }}</h3>
                                    <p>New York - USA</p>
                                    <strong>{{ App\Helper\Helper::formatMoney($productOther->sale_price) }} VNĐ</strong>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
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
            $('#add-to-cart').click(function(e) {
                swal("Sản phẩm đã được thêm vào giỏ hàng!", {
                    icon : "success",
                    buttons: {
                        confirm: {
                            className : 'btn btn-success'
                        }
                    },
                });
            });
        });
    </script>
@endsection
