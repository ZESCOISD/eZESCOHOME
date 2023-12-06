
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

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>System How-To</h2>
                    <ol>
                    <li><a href="{{route('ezesco-home')}}">Home</a></li>
                        <li>System How-To</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Event List Section ======= -->
        <section id="event-list" class="event-list">
            <div class="container">

            
            @if (session()->has('success'))
                    <div id="dismiss"
                         class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                         role="alert"  >
                        <p class="mt-3">{{ session('success') }}</p>
                        <button  type="button"
                                class="btn-close mt-1" 
                                data-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif

                @foreach($categories as $category)
                <div class="row">
                    <div class="col-md-12 mt-3 text-center">
                        <div class="card card-header p-2">
                           <span class="text-uppercase text-bold " style="color: rgba(238,156,41,0.91)">{{$category->name}}</span>
                        </div>
                    </div>
                </div>
                    <div class="row">
                    @foreach($products->where('category_id', $category->id) as $product )
                    <div class="col-md-6 d-flex  mt-3">
                        <div class="card " style="min-width: 600px">
                            <div class="card-body" >
                                <h5 class="card-title">{{$product->name ?? "-"}}  <div class="card-img">
                                        <img src="{{$product->icon_link ?? asset('home_template/assets/img/favicon.png')}}" alt="...">
                                    </div> </h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="ratio ratio-16x9">
                                            <iframe width="100%" height="520px"
                                                    src="{{ asset('storage') }}/{{ $product->video }}" title="How to?"
                                                    allowfullscreen>
                                            </iframe>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="fst-italic text-center">{{$products->short_description ?? "--"}}</p>
                                        <p class="card-text">{{$products->long_description ?? "-"}}</p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mt-3" >
                                        <a class="btn btn-sm btn-outline-secondary"  style="color: rgba(238,156,41,0.91)" href="{{$product->manual}}" title="Link to the user manual or user guide for this product">
                                            <i class=" bi bi-file-pdf "></i> Manual
                                        </a>

                                        <a class="btn btn-sm btn-outline-secondary"  style="color: rgba(238,156,41,0.91)" href="{{$product->url}}" title="Link to the Live environment for the product"  wire:click="recordClick({{$product->id}})" >
                                            <i class=" bi bi-cursor "></i> Live
                                        </a>

                                        <a class="btn btn-sm btn-outline-secondary"  style="color: rgba(238,156,41,0.91)" href="{{$product->test_url}}" title="Link to the Test Environment for the product">
                                            <i class=" bi bi-cursor "></i> Test
                                        </a>

                                        <a class="btn btn-sm btn-outline-secondary"  style="color: rgba(238,156,41,0.91)" href="{{$product->tutorial_url}}" title="Tutorial link to the products">
                                            <i class=" bi bi-cursor "></i> Tutorial
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </section><!-- End Event List Section -->

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

