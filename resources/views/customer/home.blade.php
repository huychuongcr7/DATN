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
            <div class="row large-gutters">
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 ">
                    <div class="ftco-media-1">
                        <div class="ftco-media-1-inner">
                            <a href="property-single.html" class="d-inline-block mb-4"><img src="{{ asset('frontend/images/property_1.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                            <div class="ftco-media-details">
                                <h3>HD17 19 Utica Ave.</h3>
                                <p>New York - USA</p>
                                <strong>$20,000,000</strong>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 ">
                    <div class="ftco-media-1">
                        <div class="ftco-media-1-inner">
                            <a href="property-single.html" class="d-inline-block mb-4"><img src="{{ asset('frontend/images/property_2.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                            <div class="ftco-media-details">
                                <h3>HD17 19 Utica Ave.</h3>
                                <p>New York - USA</p>
                                <strong>$20,000,000</strong>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 ">
                    <div class="ftco-media-1">
                        <div class="ftco-media-1-inner">
                            <a href="property-single.html" class="d-inline-block mb-4"><img src="{{ asset('frontend/images/property_3.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                            <div class="ftco-media-details">
                                <h3>HD17 19 Utica Ave.</h3>
                                <p>New York - USA</p>
                                <strong>$20,000,000</strong>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 ">
                    <div class="ftco-media-1">
                        <div class="ftco-media-1-inner">
                            <a href="property-single.html" class="d-inline-block mb-4"><img src="{{ asset('frontend/images/property_1.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                            <div class="ftco-media-details">
                                <h3>HD17 19 Utica Ave.</h3>
                                <p>New York - USA</p>
                                <strong>$20,000,000</strong>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 ">
                    <div class="ftco-media-1">
                        <div class="ftco-media-1-inner">
                            <a href="property-single.html" class="d-inline-block mb-4"><img src="{{ asset('frontend/images/property_2.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                            <div class="ftco-media-details">
                                <h3>HD17 19 Utica Ave.</h3>
                                <p>New York - USA</p>
                                <strong>$20,000,000</strong>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 ">
                    <div class="ftco-media-1">
                        <div class="ftco-media-1-inner">
                            <a href="property-single.html" class="d-inline-block mb-4"><img src="{{ asset('frontend/images/property_3.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                            <div class="ftco-media-details">
                                <h3>HD17 19 Utica Ave.</h3>
                                <p>New York - USA</p>
                                <strong>$20,000,000</strong>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <section class="site-section" id="agents-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-7 text-left">
                    <h2 class="section-title mb-3">Real Estate Agents</h2>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus minima neque tempora reiciendis.</p>
                </div>
            </div>
            <div class="row">


                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="team-member">
                        <figure>
                            <ul class="social">
                                <li><a href="#"><span class="icon-facebook"></span></a></li>
                                <li><a href="#"><span class="icon-twitter"></span></a></li>
                                <li><a href="#"><span class="icon-linkedin"></span></a></li>
                                <li><a href="#"><span class="icon-instagram"></span></a></li>
                            </ul>
                            <img src="{{ asset('frontend/images/person_1.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid">
                        </figure>
                        <div class="p-3 bg-primary">
                            <h3 class="mb-2">Allison Holmes</h3>
                            <span class="position">Real Estate Agent</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="team-member">
                        <figure>
                            <ul class="social">
                                <li><a href="#"><span class="icon-facebook"></span></a></li>
                                <li><a href="#"><span class="icon-twitter"></span></a></li>
                                <li><a href="#"><span class="icon-linkedin"></span></a></li>
                                <li><a href="#"><span class="icon-instagram"></span></a></li>
                            </ul>
                            <img src="{{ asset('frontend/images/person_2.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid">
                        </figure>
                        <div class="p-3 bg-primary">
                            <h3 class="mb-2">Dave Simpson</h3>
                            <span class="position">Real Estate Agent</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="team-member">
                        <figure>
                            <ul class="social">
                                <li><a href="#"><span class="icon-facebook"></span></a></li>
                                <li><a href="#"><span class="icon-twitter"></span></a></li>
                                <li><a href="#"><span class="icon-linkedin"></span></a></li>
                                <li><a href="#"><span class="icon-instagram"></span></a></li>
                            </ul>
                            <img src="{{ asset('frontend/images/person_3.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid">
                        </figure>
                        <div class="p-3 bg-primary">
                            <h3 class="mb-2">Ben Thompson</h3>
                            <span class="position">Real Estate Agent</span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

    <section class="py-5 bg-primary site-section how-it-works" id="howitworks-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="section-title mb-3 text-black">How It Works</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="pr-5 first-step">
                        <span class="text-black">01.</span>
                        <span class="custom-icon flaticon-house text-black"></span>
                        <h3 class="text-black">Find Property.</h3>
                        <p class="text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>

                <div class="col-md-4 text-center">
                    <div class="pr-5 second-step">
                        <span class="text-black">02.</span>
                        <span class="custom-icon flaticon-coin text-black"></span>
                        <h3 class="text-dark">Buy Property.</h3>
                        <p class="text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>

                <div class="col-md-4 text-center">
                    <div class="pr-5">
                        <span class="text-black">03.</span>
                        <span class="custom-icon flaticon-home text-black"></span>
                        <h3 class="text-dark">Outstanding Houses.</h3>
                        <p class="text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section" id="about-section">
        <div class="container">

            <div class="row large-gutters">
                <div class="col-lg-6 mb-5">

                    <div class="owl-carousel slide-one-item with-dots">
                        <div><img src="{{ asset('frontend/images/img_1.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid"></div>
                        <div><img src="{{ asset('frontend/images/img_2.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid"></div>
                        <div><img src="{{ asset('frontend/images/img_3.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid"></div>
                    </div>

                </div>
                <div class="col-lg-6 ml-auto">

                    <h2 class="section-title mb-3">Warehouse Real Estate Template</h2>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <p>Est qui eos quasi ratione nostrum excepturi id recusandae fugit omnis ullam pariatur itaque nisi voluptas impedit  Quo suscipit omnis iste velit maxime.</p>

                    <ul class="list-unstyled ul-check success">
                        <li>Placeat maxime animi minus</li>
                        <li>Dolore qui placeat maxime</li>
                        <li>Consectetur adipisicing</li>
                        <li>Lorem ipsum dolor</li>
                        <li>Placeat molestias animi</li>
                    </ul>

                    <p><a href="#" class="btn btn-primary mr-2 mb-2">Learn More</a></p>

                </div>
            </div>
        </div>
    </section>

    <section class="site-section bg-light" id="services-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title mb-3">Services</h2>
                </div>
            </div>
            <div class="row align-items-stretch">
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
                    <div class="unit-4 d-flex">
                        <div class="unit-4-icon mr-4"><span class="text-primary flaticon-house"></span></div>
                        <div>
                            <h3>Find Property</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                            <p><a href="#">Learn More</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="unit-4 d-flex">
                        <div class="unit-4-icon mr-4"><span class="text-primary flaticon-coin"></span></div>
                        <div>
                            <h3>Buy Property</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                            <p><a href="#">Learn More</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="unit-4 d-flex">
                        <div class="unit-4-icon mr-4"><span class="text-primary flaticon-home"></span></div>
                        <div>
                            <h3>Beautiful Home</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                            <p><a href="#">Learn More</a></p>
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="unit-4 d-flex">
                        <div class="unit-4-icon mr-4"><span class="text-primary flaticon-flat"></span></div>
                        <div>
                            <h3>Buildings &amp; Lands</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                            <p><a href="#">Learn More</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="unit-4 d-flex">
                        <div class="unit-4-icon mr-4"><span class="text-primary flaticon-location"></span></div>
                        <div>
                            <h3>Property Locator</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                            <p><a href="#">Learn More</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="unit-4 d-flex">
                        <div class="unit-4-icon mr-4"><span class="text-primary flaticon-mobile-phone"></span></div>
                        <div>
                            <h3>Mobile Apps</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                            <p><a href="#">Learn More</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="site-section testimonial-wrap" id="testimonials-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title mb-3">Testimonials</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="ftco-testimonial-1">
                        <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                            <img src="{{ asset('frontend/images/person_1.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid mr-3">
                            <div>
                                <h3>Allison Holmes</h3>
                                <span>Customer</span>
                            </div>
                        </div>
                        <div>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="ftco-testimonial-1">
                        <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                            <img src="{{ asset('frontend/images/person_2.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid mr-3">
                            <div>
                                <h3>James Phelps</h3>
                                <span>Customer</span>
                            </div>
                        </div>
                        <div>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="ftco-testimonial-1">
                        <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                            <img src="{{ asset('frontend/images/person_3.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid mr-3">
                            <div>
                                <h3>Nestor Helsin</h3>
                                <span>Customer</span>
                            </div>
                        </div>
                        <div>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="ftco-testimonial-1">
                        <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                            <img src="{{ asset('frontend/images/person_1.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid mr-3">
                            <div>
                                <h3>Allison Holmes</h3>
                                <span>Customer</span>
                            </div>
                        </div>
                        <div>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section" id="news-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title mb-3">News &amp; Events</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                    <div class="h-entry">
                        <a href="single.html"><img src="{{ asset('frontend/images/img_1.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                        <h2 class="font-size-regular"><a href="single.html" class="text-dark">Popular Real Estate Properties for 2019</a></h2>
                        <div class="meta mb-4">Allison Holmes <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="single.html">News</a></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                    <div class="h-entry">
                        <a href="single.html"><img src="{{ asset('frontend/images/img_2.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                        <h2 class="font-size-regular"><a href="single.html" class="text-dark">Popular Real Estate Properties for 2019</a></h2>
                        <div class="meta mb-4">James Phelps <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="single.html">News</a></div>

                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                    <div class="h-entry">
                        <a href="single.html"><img src="{{ asset('frontend/images/img_3.jpg') }}" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                        <h2 class="font-size-regular"><a href="single.html" class="text-dark">Popular Real Estate Properties for 2019</a></h2>
                        <div class="meta mb-4">Allison Holmes <span class="mx-2">&bullet;</span> Jan 18, 2019<span class="mx-2">&bullet;</span> <a href="single.html">News</a></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="site-section bg-light bg-image" id="contact-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title mb-3">Contct Us</h2>
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
        <div id="map-report">
            <div id="wrapper-website">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d37815.55128253548!2d105.85768996293659!3d21.001183254028742!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac6f5492f2d5%3A0x616fa33ba26ab17b!2zMjg4IEdp4bqjaSBQaMOzbmcsIFBoxrDGoW5nIExp4buHdCwgVGhhbmggWHXDom4sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2sus!4v1583766246716!5m2!1svi!2sus" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </section>
@endsection
