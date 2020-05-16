@extends('layouts.frontend.client')
@section('title', 'Trang chủ')

@section('content')
    <div class="site-block-wrap">
        <div class="owl-carousel with-dots">
            <div class="site-blocks-cover overlay overlay-2" style="background-image: url(frontend/images/hero_1.jpg);" data-aos="fade" id="home-section">


                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-6 mt-lg-5 text-center">
                            <h1 class="text-shadow">Buy &amp; Sell Property Here</h1>
                            <p class="mb-5 text-shadow">Free website template for Real Estate websites by the fine folks at <a href="https://free-template.co/" target="_blank">Free-Template.co</a>  </p>
                            <p><a href="https://free-template.co" target="_blank" class="btn btn-primary px-5 py-3">Get Started</a></p>

                        </div>
                    </div>
                </div>


            </div>

            <div class="site-blocks-cover overlay overlay-2" style="background-image: url(frontend/images/hero_2.jpg);" data-aos="fade" id="home-section">


                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-6 mt-lg-5 text-center">
                            <h1 class="text-shadow">Find Your Perfect Property For Your Home</h1>
                            <p class="mb-5 text-shadow">Free website template for Real Estate websites by the fine folks at <a href="https://free-template.co/" target="_blank">Free-Template.co</a>  </p>
                            <p><a href="https://free-template.co" target="_blank" class="btn btn-primary px-5 py-3">Get Started</a></p>

                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>

    <div class="site-section" id="properties-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h2 class="section-title mb-3">Top sản phẩm bán chạy</h2>
                </div>
            </div>
            <div class="row large-gutters">
                @foreach($productBestSales as $productBestSale)
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-5 ">
                    <div class="ftco-media-1">
                        <div class="ftco-media-1-inner">
                            <a href="{{ route('products.show', $productBestSale['id']) }}" class="d-inline-block mb-4"><img src="{{ asset('storage'.$productBestSale['image_url']) }}" class="img-fluid"></a>
                            <div class="ftco-media-details">
                                <h3>{{ $productBestSale['name'] }}</h3>
                                <strong>{{ App\Helper\Helper::formatMoney($productBestSale['sale_price']) }} VNĐ</strong>
                                <p>Đã bán {{ $productBestSale['sum'] }}</p>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row mb-5">
                <div class="col-md-12 text-center">
                    <h2 class="section-title mb-3">Sản phẩm mới</h2>
                </div>
            </div>
            <div class="row large-gutters">
                @foreach($productNews as $productNew)
                    <div class="col-md-6 col-lg-3 mb-5 mb-lg-5 ">
                        <div class="ftco-media-1">
                            <div class="ftco-media-1-inner">
                                <a href="{{ route('products.show', $productNew->id) }}" class="d-inline-block mb-4"><img src="{{ asset('storage'.$productNew->image_url) }}" class="img-fluid"></a>
                                <div class="ftco-media-details">
                                    <h3>{{ $productNew->name }}</h3>
                                    <p>New York - USA</p>
                                    <strong>{{ App\Helper\Helper::formatMoney($productNew->sale_price) }} VNĐ</strong>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

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
                        <a href="#"><img src="{{ asset('storage'.$post->img_url) }}" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                        <h2 class="font-size-regular"><a href="#" class="text-dark">{{ $post->title }}</a></h2>
                        <div class="meta mb-4">{{ $post->user->name }} <span class="mx-2">&bullet;</span> {{ $post->created_at->format('Y m d') }}<span class="mx-2">&bullet;</span> <a href="#">News</a></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section bg-light bg-image" id="contact-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title mb-3">Liên hệ với chúng tôi</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 mb-5">

                    <form action="#" class="p-5 bg-white">

                        <h2 class="h4 text-black mb-5">Get In Touch</h2>

                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-black" for="fname">First Name</label>
                                <input type="text" id="fname" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="text-black" for="lname">Last Name</label>
                                <input type="text" id="lname" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">

                            <div class="col-md-12">
                                <label class="text-black" for="email">Email</label>
                                <input type="email" id="email" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">

                            <div class="col-md-12">
                                <label class="text-black" for="subject">Subject</label>
                                <input type="subject" id="subject" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="message">Message</label>
                                <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" value="Send Message" class="btn btn-primary btn-md text-white">
                            </div>
                        </div>


                    </form>
                </div>
                <div class="col-md-5">

                    <div class="p-4 mb-3 bg-white">
                        <p class="mb-0 font-weight-bold">Address</p>
                        <p class="mb-4">203 Fake St. Mountain View, San Francisco, California, USA</p>

                        <p class="mb-0 font-weight-bold">Phone</p>
                        <p class="mb-4"><a href="#">+1 232 3235 324</a></p>

                        <p class="mb-0 font-weight-bold">Email Address</p>
                        <p class="mb-0"><a href="#">youremail@domain.com</a></p>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="site-section" id="map-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title mb-3">Google map</h2>
                </div>
            </div>
            <div id="map-report">
                <div id="wrapper-website">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d37815.55128253548!2d105.85768996293659!3d21.001183254028742!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac6f5492f2d5%3A0x616fa33ba26ab17b!2zMjg4IEdp4bqjaSBQaMOzbmcsIFBoxrDGoW5nIExp4buHdCwgVGhhbmggWHXDom4sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2sus!4v1583766246716!5m2!1svi!2sus" width="1110" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection