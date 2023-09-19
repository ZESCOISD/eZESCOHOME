
@push('custom-styles')

    <!-- Favicons -->
    <link href="{{asset('home_template/assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('home_template/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('home_template/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('home_template/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('home_template/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('home_template/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('home_template/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('home_template/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('home_template/assets/css/style.css')}}" rel="stylesheet">


@endpush

<div>

    <!-- ======= Header ======= -->
    @include('layouts.nav')

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">
                @foreach ($slides as $index => $slide)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}" style="background-image: url( {{ asset('storage') }}/{{ $slide['image'] }} )">
                        <div class="carousel-caption align-content-center">
                            <h1>{{$slide['name']}}</h1>
                            <h3>{{$slide['description']}}</h3>
                        </div>
                    </div>

                @endforeach
            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </section><!-- End Hero -->

    <main id="main">
        <section id="about" class="about" style="margin-top: -10px">
            <div class="container">
                <div class="row content">
                    <div class="section-title">
                        <h2>E-ZESCO HOME</h2>
                        <p>Systems by categories.</p>
                    </div>
                    <div class="recent-photos-slider swiper">
                        <div class="swiper-wrapper align-items-center">
                            @foreach($categories as $category)
                                <div class="swiper-slide  btn-categories  " style="background-color: #{{$category->html ?? "0a53be"}}">
                                    <h5 class="text-center " > {{$category->name ?? "--"}}</h5>
                                    <p class="fst-italic text-center">  {{$category->products->count() ?? "--"}}  @if( $category->products->count() == 1)system @else systems @endif </p>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>

            <div class="container" >
                <div class="row">
                    <div class="col-md-8 col-lg-8 col-sm-12 mt-lg-5">
                        <div class="row content">
                            <div class="section-title" >
                                <h2>Frequently Accessed System</h2>
                                <p style="margin-top: -10px">Most accessed systems by daily link clicks.</p>
                            </div>
                            <div style="margin-top: -10px" >
                                <div class="align-items-center">
                                    @foreach($products as $product)
                                        <div class="btn-categories  " style="background-color: #{{$product->category->html ?? "0a53be"}}">
                                            <h5 class="text-center " > {{$product->name ?? "--"}}</h5>
                                            <p class="fst-italic text-center">  {{$product->number_of_clicks ?? "--"}}  @if( $product->number_of_clicks == 1)system @else systems @endif </p>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12">

                    </div>
                </div>
            </div>

        </section>



            <!-- ======= My & Family Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="section-title">
                    <h2>E-ZESCO HOME</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>



                <div class="row content">
                    <div class="col-lg-6">
                        <img src="assets/img/about.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua.
                        </p>
                        <ul>
                            <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                            <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
                            <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
                        </ul>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                            culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <a href="our-story.html" class="btn-learn-more">Learn More</a>
                    </div>
                </div>

            </div>
        </section><!-- End My & Family Section -->

        <!-- ======= Features Section ======= -->
        <section id="features" class="features">
            <div class="container">

                <div class="row">
                    <div class="col-lg-4 col-md-6 icon-box">
                        <div class="icon"><i class="bi bi-laptop"></i></div>
                        <h4 class="title"><a href="">Lorem ass asdasdsa Ipsum</a></h4>
                        <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box">
                        <div class="icon"><i class="bi bi-bar-chart"></i></div>
                        <h4 class="title"><a href="">Dolor Sitema</a></h4>
                        <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box">
                        <div class="icon"><i class="bi bi-bounding-box"></i></div>
                        <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
                        <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box">
                        <div class="icon"><i class="bi bi-broadcast"></i></div>
                        <h4 class="title"><a href="">Magni Dolores</a></h4>
                        <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box">
                        <div class="icon"><i class="bi bi-camera"></i></div>
                        <h4 class="title"><a href="">Nemo Enim</a></h4>
                        <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box">
                        <div class="icon"><i class="bi bi-diagram-3"></i></div>
                        <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
                        <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
                    </div>
                </div>

            </div>
        </section><!-- End Features Section -->

        <!-- ======= Recent Photos Section ======= -->
        <section id="recent-photos" class="recent-photos">
            <div class="container">

                <div class="section-title">
                    <h2>Recent Photos</h2>
                    <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
                </div>

{{--                <div class="recent-photos-slider swiper">--}}
{{--                    <div class="swiper-wrapper align-items-center">--}}
{{--                        <div class="swiper-slide"><a href="assets/img/recent-photos/recent-photos-1.jpg" class="glightbox"><img src="assets/img/recent-photos/recent-photos-1.jpg" class="img-fluid" alt=""></a></div>--}}
{{--                        <div class="swiper-slide"><a href="assets/img/recent-photos/recent-photos-2.jpg" class="glightbox"><img src="assets/img/recent-photos/recent-photos-2.jpg" class="img-fluid" alt=""></a></div>--}}
{{--                        <div class="swiper-slide"><a href="assets/img/recent-photos/recent-photos-3.jpg" class="glightbox"><img src="assets/img/recent-photos/recent-photos-3.jpg" class="img-fluid" alt=""></a></div>--}}
{{--                        <div class="swiper-slide"><a href="assets/img/recent-photos/recent-photos-4.jpg" class="glightbox"><img src="assets/img/recent-photos/recent-photos-4.jpg" class="img-fluid" alt=""></a></div>--}}
{{--                        <div class="swiper-slide"><a href="assets/img/recent-photos/recent-photos-5.jpg" class="glightbox"><img src="assets/img/recent-photos/recent-photos-5.jpg" class="img-fluid" alt=""></a></div>--}}
{{--                        <div class="swiper-slide"><a href="assets/img/recent-photos/recent-photos-6.jpg" class="glightbox"><img src="assets/img/recent-photos/recent-photos-6.jpg" class="img-fluid" alt=""></a></div>--}}
{{--                        <div class="swiper-slide"><a href="assets/img/recent-photos/recent-photos-7.jpg" class="glightbox"><img src="assets/img/recent-photos/recent-photos-7.jpg" class="img-fluid" alt=""></a></div>--}}
{{--                        <div class="swiper-slide"><a href="assets/img/recent-photos/recent-photos-8.jpg" class="glightbox"><img src="assets/img/recent-photos/recent-photos-8.jpg" class="img-fluid" alt=""></a></div>--}}
{{--                    </div>--}}
{{--                    <div class="swiper-pagination"></div>--}}
{{--                </div>--}}

            </div>
        </section><!-- End Recent Photos Section -->

    </main><!-- End #main -->

    @include('layouts.footer')

</div>

@push('custom-scripts')

    <!-- Vendor JS Files -->
    <script src="{{asset('home_template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('home_template/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('home_template/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('home_template/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('home_template/assets/vendor/php-email-form/validate.js')}}"></script>
    <!-- Template Main JS File -->
    <script src="{{asset('home_template/assets/js/main.js')}}"></script>

@endpush

