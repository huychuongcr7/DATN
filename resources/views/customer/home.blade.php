@extends('layouts.frontend.client')
@section('title', 'Trang chủ')

@section('content')
    <div class="owl-carousel with-dots">
        <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(frontend/images/grocery.png);" data-aos="fade" id="home-section">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6 mt-lg-5 text-center">
                        <h1 class="text-shadow">CR7 STORE</h1>
                        <p class="mb-5 text-shadow">Chào mừng bạn đến với cửa hàng của chúng tôi</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(frontend/images/bg_1.jpg);" data-aos="fade" id="home-section">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-6 mt-lg-5 text-center">
                        <h1 class="text-shadow">CR7 STORE</h1>
                        <p class="mb-5 text-shadow">Chào mừng bạn đến với cửa hàng của chúng tôi!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="site-section" id="properties-section">
        <div class="container" id="app">
            <div class="row mb-5">
                <div class="col-md-7 text-left">
                    <h2 class="section-title mb-3">Sản phẩm mới</h2>
                </div>
                <div class="col-md-5 text-left text-md-right">
                    <div class="custom-nav1">
                        <a href="#" class="custom-prev1">Trước</a><span class="mx-3">/</span><a href="#" class="custom-next1">Tiếp</a>
                    </div>
                </div>
            </div>
            <div class="owl-carousel nonloop-block-13 mb-5">
                @foreach($productNews as $productNew)
                    <div class="ftco-media-1">
                        <div class="ftco-media-1-inner">
                            <a href="{{ route('products.show', $productNew->id) }}" class="d-inline-block mb-4"><img src="{{ asset($productNew->image_url) }}" class="img-fluid"></a>
                            <div class="ftco-media-details">
                                <h3>{{ $productNew->name }}</h3>
                                <rate-avg
                                    avg="{{ json_encode($productNew->rating) }}"
                                ></rate-avg>
                                <strong>{{ App\Helper\Helper::formatMoney($productNew->sale_price) }} VNĐ</strong>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <button class="btn btn-primary">Xem thêm</button>
            </div>
            <br>
            <hr>
            <br>
            <div class="row mb-5">
                <div class="col-md-7 text-left">
                    <h2 class="section-title mb-3">Top sản phẩm bán chạy</h2>
                </div>
                <div class="col-md-5 text-left text-md-right">
                    <div class="custom-nav1">
                        <a href="#" class="custom-prev1">Trước</a><span class="mx-3">/</span><a href="#" class="custom-next1">Tiếp</a>
                    </div>
                </div>
            </div>
            <div class="owl-carousel nonloop-block-13 mb-5">
                @foreach($productBestSales as $productBestSale)
                    <div class="ftco-media-1">
                        <div class="ftco-media-1-inner">
                            <a href="{{ route('products.show', $productBestSale['id']) }}" class="d-inline-block mb-4"><img src="{{ asset($productBestSale['image_url']) }}" class="img-fluid"></a>
                            <div class="ftco-media-details">
                                <h3>{{ $productBestSale['name'] }}</h3>
                                <rate-avg
                                    avg="{{ json_encode($productBestSale['rating']) }}"
                                ></rate-avg>
                                <strong>{{ App\Helper\Helper::formatMoney($productBestSale['sale_price']) }} VNĐ</strong>
                                <p>Đã bán {{ $productBestSale['sum'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <button class="btn btn-primary">Xem thêm</button>
            </div>
        </div>
    </section>

    <section class="site-section bg-light" id="news-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title mb-3">Tin tức</h2>
                </div>
            </div>

            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                        <div class="h-entry">
                            <a href="{{ route('posts.show', $post->id) }}"><img src="{{ asset($post->img_url) }}" class="img-fluid"></a>
                            <h2 class="font-size-regular"><a href="#" class="text-dark">{{ $post->title }}</a></h2>
                            <div class="meta mb-4">{{ $post->user->name }}
                                <span class="mx-2">&bullet;</span> {{ $post->created_at->format('Y m d') }}
                                <span class="mx-2">&bullet;</span>
                                <a href="{{ route('posts.show', $post->id) }}">Đọc tiếp <i class="icon-arrow-right"></i></a>
                            </div>
                            <p>{{ substr(strip_tags($post->content), 0, 70)}}{{ strlen(strip_tags($post->content)) > 70 ? '...': ''}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('posts.index') }}" class="btn btn-primary">Xem thêm</a>
            </div>
        </div>
    </section>

    <section class="site-section bg-image" id="contact-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title mb-3">Liên hệ với chúng tôi</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 mb-5">
                    <form method="POST" action="{{ route('contacts.store') }}" class="p-5 bg-white">
                        @csrf
                        <h2 class="h4 text-black mb-5">Thông tin liên hệ</h2>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="name" @error('name') class="text-danger" @enderror>Họ tên <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control @error('name')ui-state-error @enderror" value="{{ old('name') }}">
                                @error('name')
                                <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="email" @error('email') class="text-danger" @enderror>Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control @error('email')ui-state-error @enderror" value="{{ old('email') }}">
                                @error('email')
                                <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="subject" @error('subject') class="text-danger" @enderror>Tiêu đề <span class="text-danger">*</span></label>
                                <input type="text" id="subject" name="subject" class="form-control @error('subject')ui-state-error @enderror" value="{{ old('subject') }}">
                                @error('subject')
                                <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="message" @error('message') class="text-danger" @enderror>Lời nhắn <span class="text-danger">*</span></label>
                                <textarea name="message" id="message" cols="30" rows="7" class="form-control @error('message')ui-state-error @enderror" placeholder="Viết lời nhắn hoặc câu hỏi của bạn tại đây...">{{ old('message') }}</textarea>
                                @error('message')
                                <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Gửi</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5" style="padding-top: 25px">
                    <div class="p-4 mb-3 bg-white text-black" style="font-size: 1.1rem">
                        <p class="mb-0 font-weight-bold">Địa chỉ</p>
                        <p class="mb-4"><i class="flaticon-location"></i> 288A Giải Phóng, Phương Liệt, Thanh Xuân, Hà Nội</p>
                        <p class="mb-0 font-weight-bold">Điện thoại</p>
                        <p class="mb-4"><i class="icon-phone"></i> 0326175823</p>
                        <p class="mb-0 font-weight-bold">Email</p>
                        <p class="mb-0"><i class="icon-contact_mail"></i> daohuychuong97@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section bg-light" id="map-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title mb-3">Google map</h2>
                </div>
            </div>
            <div id="map-report">
                <div id="wrapper-website">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d37815.55128253548!2d105.85768996293659!3d21.001183254028742!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac6f5492f2d5%3A0x616fa33ba26ab17b!2zMjg4IEdp4bqjaSBQaMOzbmcsIFBoxrDGoW5nIExp4buHdCwgVGhhbmggWHXDom4sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2sus!4v1583766246716!5m2!1svi!2sus"
                        width="1110" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
