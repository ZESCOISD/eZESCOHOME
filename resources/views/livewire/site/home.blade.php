@push('custom-styles')

    <!-- Favicons -->
    <link href="{{asset('home_template/assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('home_template/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}"
                         style="background-image: url( {{ asset('storage') }}/{{ $slide['image'] }} )">
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
                        <p>Welcome to E-ZESCO, your comprehensive platform for accessing a wide range of sophisticated in-house developed systems seamlessly integrated in one place.</p>
                   
                   
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
                   
                    </div>
                    <div id="categoryCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($categories->chunk(5) as $key => $chunk)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach($chunk as $category)
                                            <div class=" col-2  btn-categories m-3  "
                                                 style="background-color: #{{$category->html ?? "0a53be"}}">
                                                <a href="javascript:void(0)"
                                                   wire:click="searchByCategory({{$category->id}})">
                                                    <h5 class="text-center "> {{$category->name ?? "--"}}</h5>
                                                    <p class="fst-italic text-center">  {{$category->products->count() ?? "--"}}  @if( $category->products->count() == 1)
                                                            system
                                                        @else
                                                            systems
                                                        @endif </p>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="row">

                            <div class="col-lg-3 col-sm-6">
                                <a class="btn btn-sm btn-outline-secondary rounded-2" href="#categoryCarousel"
                                   role="link"
                                   data-slide="prev">
                                    <div class="row">
                                        <div class="col-4">
                                            <span class="carousel-control-prev-icon " aria-hidden="true"></span>
                                        </div>
                                        <div class="col-5 text-center mt-1">
                                            <span class="sr-only text-danger ">Prev</span>
                                        </div>
                                    </div>
                                </a>
                                <a class="btn btn-sm btn-outline-secondary  " href="#categoryCarousel" role="link"
                                   data-bs-slide="next">
                                    <div class="row">
                                        <div class="col-4">
                                            <span class="carousel-control-next-icon  " aria-hidden="true"></span>
                                        </div>
                                        <div class="col-5 text-center mt-1">
                                            <span class="sr-only  text-danger  ">Next</span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-8 col-sm-6">
                                <div class="input-group mb-3">
                                    <input type="text"  wire:model="search_term"  wire:keydown.debounce.300ms="searchByTerm"  class="form-control"
                                           placeholder="Search system by name or category..." aria-label="Search"
                                           aria-describedby="searchButton">
                                    <div class="input-group-append">
                            <span wire:loading class="input-group-text">
                                <div class="spinner-border text-success" role="status"></div>
                            </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-lg-7 col-sm-12 mt-lg-5">
                        <div class="row content">
                            <div class="section-title">
                                <h2>Frequently Accessed System</h2>
                                <p style="margin-top: -10px">Most accessed systems by daily link clicks.</p>
                            </div>
                            <div style="margin-top: -10px">
                                <div class="align-items-center">
                                    @foreach($frequent_products as $product)
                                        <a href="javascript:void(0)" wire:click="recordClick({{$product->id}})">
                                            <div class="btn-categories  "
                                                 style="background-color: #{{$product->category->html ?? "0a53be"}}">
                                                <h5 class="text-center "> {{$product->name ?? "--"}}</h5>
                                                <p class="fst-italic text-center">  {{$product->number_of_clicks ?? "--"}}  @if( $product->number_of_clicks == 1)
                                                        click
                                                    @else
                                                        clicks
                                                    @endif </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-5 col-sm-12 mt-lg-5">
                        @if($selected_category_id )
                            <div class="row content">
                                <div class="section-title">
                                    <h2>Systems By Category</h2>
                                    <p style="margin-top: -10px">List of all systems under {{$my_category->name ??'--'}}
                                        .</p>
                                </div>
                                <div style="margin-top: -10px">
                                    <div class="align-items-center">

                                        <div class="container">
                                            <div class="row">
                                                <!-- <div class="col-lg-6 col-sm-12 "><b>Product</b></div>
                                                <div class="col-lg-6 col-sm-12 "><b>Product</b></div> -->
                                            </div>
                                            <hr>
                                            <div class="row">
                                                @forelse($ezesco_products_by_cat as $key => $product_by)
                                                    <div class="col-lg-6 col-sm-12">
                                                        <a href="javascript:void(0)"
                                                           wire:click="recordClick({{$product_by->id}})">
                                                            {{ $key + 1 }}:
                                                            @if(  $product_by['heart_beat']  == "on")
                                                            &#128994;
                                                            @else
                                                            &#128992;
                                                            @endif
                                                            
                                                            {{ $product_by['name'] }} <img
                                                                src="{{ $product_by['icon_url'] }}" alt=" "
                                                                class="img-fluid">
                                                        </a>
                                                        <hr>
                                                    </div>
                                                @empty
                                                    <div class="col-lg-12 col-sm-12">
                                                        No items under this Category
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>

                                    </div>
                                    <div class="swiper-pagination">
{{--                                        {{$ezesco_products_by_cat->links()}}--}}
                                    </div>
                                </div>
                            </div>
                        @elseif($this->search_term)
                            <div class="row content">
                                <div class="section-title">
                                    <h2>Search Results</h2>
                                    <p style="margin-top: -10px">List of all systems containing
                                        <b><i>'{{$this->search_term}}'</i></b> search term.</p>
                                </div>
                                <div style="margin-top: -10px">
                                    <div class="align-items-center">

                                        <div class="container">
                                            <div class="row">
                                                <!-- <div class="col-lg-6 col-sm-12 "><b>Product</b></div>
                                                <div class="col-lg-6 col-sm-12 "><b>Product</b></div> -->
                                            </div>
                                            <hr>
                                            <div class="row">
                                                @forelse($ezesco_products_by_cat as $key => $product_by)
                                                    <div class="col-lg-6 col-sm-12">
                                                        <a href="javascript:void(0)"
                                                           wire:click="recordClick({{$product_by->id}})">
                                                            {{ $key + 1 }}:
                                                            
                                                            @if(  $product_by['heart_beat']  == "on")
                                                            &#128994;
                                                            @else
                                                            &#128992;
                                                            @endif

                                                            {{ $product_by['name'] }} <img
                                                                src="{{ $product_by['icon_url'] }}" alt=" "
                                                                class="img-fluid">
                                                        </a>
                                                        <hr>
                                                    </div>
                                                @empty
                                                    <div class="col-lg-12 col-sm-12">
                                                        No items under this Category
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>

                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        @else
                            <div class="row content">
                                <div class="section-title">
                                    <h2>All Systems</h2>
                                    <p style="margin-top: -10px">List of all systems.</p>
                                </div>
                                <div style="margin-top: -10px">
                                    <div class="align-items-center">

                                        <div class="container">
                                            <div class="row">
                                                <!-- <div class="col-lg-6 col-sm-12 "><b>Product</b></div>
                                                <div class="col-lg-6 col-sm-12 "><b>Product</b></div> -->
                                            </div>
                                            <hr>
                                            <div class="row">
                                                @forelse($ezesco_products as $key => $product)
                                                    <div class="col-lg-6 col-sm-12">
                                                        <a href="javascript:void(0)"
                                                           wire:click="recordClick({{$product->id}})">
                                                        
                                                            {{ $key + 1 }}:  
                                                    
                                                            @if(  $product['heart_beat']  == "on")
                                                            &#128994;
                                                            @else
                                                            &#128992;
                                                            @endif
                                                            {{ $product['name'] }} <img
                                                                src="{{ $product['icon_url'] }}" alt=" "
                                                                class="img-fluid">
                                                        </a>
                                                        <hr>
                                                    </div>
                                                @empty
                                                    <div class="col-lg-12 col-sm-12">
                                                        No Items found
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>

                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </section>


        <!-- ======= My & Family Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="section-title">
                    <h2>IN-HOUSE SYSTEMS</h2>
                    <p>Know more about ZESCO's in-house system's. Click the link below to get started..</p>
                    <a href="{{ route('ezesco-home.learn.more', 0) }}" class="btn-learn-more">Learn More</a>
                </div>


                

                <div class="row content">
                    <div class="col-lg-6">
                    <div class="card mt-lg-3">
    <div class="card-header text-center text-success">
        <a href="#" class="float-right">
            @if (count($more_notices) > 1)
                <!-- View all -->
            @endif
        </a>
        <h4 class="ml-3">
            <i id="upcoming-events-icon" class="bi bi-calendar-event-fill text-center"></i> Notices
        </h4>
    </div>
    <div class="card-body">
        @if ($more_notices->isEmpty())
            <div id="notice-data" class="text-center">
                <h5 class="mt-4 text-secondary">No new notices found.</h5>
            </div>
        @elseif ($more_notices->isNotEmpty())
            @foreach ($more_notices as $more_notice)
                <div class="mt-4">
                    <h4 class="font-weight-bold">{{ $more_notice->notice_name }}</h4>
                    <p>{{ $more_notice->description }}</p>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="font-weight-bold">From {{ $more_notice->department }}</div>
                        <p>By {{ $more_notice->staff_title }} | {{ $more_notice->staff_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right">
                            <div class="font-weight-bold">Date and Time</div>
                            <p>
                                {{ $more_notice->start_date }}
                                {{ \Carbon\Carbon::parse($more_notice->start_date)->format('H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
<hr>
            @endforeach

            <div class="row">
            <div class="d-flex justify-content-center">
            {{$more_notices->links()}}
            </div>
            </div>
        @endif
    </div>

</div>


<div class="card mt-lg-3">
    <div class="card-header text-center text-success">
        <a href="#" class="float-right">
        @if (count($upcoming_events) > 1)
                <!-- View all -->
            @endif
        </a>
        <h4 class="ml-3">
            <i id="upcoming-events-icon" class="bi bi-calendar-event-fill text-center"></i> Upcoming Events
        </h4>
    </div>
    <div class="card-body">
        @if ($upcoming_events->isEmpty())
            <div id="notice-data" class="text-center">
                <h5 class="mt-4 text-secondary">No upcoming events found.</h5>
            </div>
        @elseif ($upcoming_events->isNotEmpty())
            @foreach ($upcoming_events as $event)
                <div class="mt-4">
                    <h4 class="font-weight-bold">{{ $event->event_name }}</h4>
                    <p>{{ $event->event_description }}</p>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="font-weight-bold">From {{ $event->venue }}</div>
                        <p>Fee K{{ $event->fee }}</p>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right">
                            <div class="font-weight-bold">Date and Time</div>
                            <p>
                                {{ $event->date }}
                                {{ \Carbon\Carbon::parse($event->time)->format('H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
<hr>
            @endforeach
            <div class="row">
            <div class="d-flex justify-content-center">
            {{$upcoming_events->links()}}
            </div>
            </div>
           
        @endif
    </div>

</div>

                        
                    </div>

                    <div class="col-lg-6 pt-4 pt-lg-0">

                        <ul>
                            <li> <i class="ri-check-double-line"></i>E-ZESCO, designed to streamline your experience and processes and provide easy access to the tools and resources you need.</li>
                            <li> <i class="ri-check-double-line"></i>Explore a diverse set of systems and services tailored to meet your specific needs. By providing you with integrated solutions, we're dedicated to providing you with a seamless experience that enhances your workflow and productivity.</li>
                            <li> <i class="ri-check-double-line"></i>This platform brings together a suite of developed solutions, making it convenient and efficient for you to manage various aspects of your operations.</li>
                            <li> <i class="ri-check-double-line"></i>Join us on this journey towards a more efficient and connected future. Explore the wide array of features and discover how E-ZESCO can revolutionize the way you work.</li>
                        </ul>
                        <p>From streamlined processes to powerful analytics, E-ZESCO empowers you with the tools you need to excel in your endeavors.</p>

                        <a href="{{ route('ezesco-home.learn.more', 0 ) }}" class="btn-learn-more">Learn More</a>
                        <a  href="" class="btn-learn-more"   data-bs-toggle="modal" data-bs-target="#suggestionModal"
                            title=" Suggest areas of system improvement to enhance and make ZESCO system's better "
                            >
                            Product Suggestion Box
                        </a>
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
                        <h4 class="title"><a href="">Strategic Solutions</a></h4>
                        <p class="description">Providing well-thought-out and effective approaches to problems.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box">
                        <div class="icon"><i class="bi bi-bar-chart"></i></div>
                        <h4 class="title"><a href="">Getaway</a></h4>
                        <p>Your gateway to a unified platform for accessing a range of developed systems, all conveniently located in one place.</p>

                    </div>
                    <div class="col-lg-4 col-md-6 icon-box">
                        <div class="icon"><i class="bi bi-bounding-box"></i></div>
                        <h4 class="title"><a href="">Performance-Driven</a></h4>
                        <p class="description">Focusing on achieving and exceeding performance goals and targets.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box">
                        <div class="icon"><i class="bi bi-broadcast"></i></div>
                        <h4 class="title"><a href="">Continuous improvement</a></h4>
                        <p class="description">Committing to ongoing learning, growth, and refinement of processes and practices.</p>
                    </div>
{{--                    <div class="col-lg-4 col-md-6 icon-box">--}}
{{--                        <div class="icon"><i class="bi bi-camera"></i></div>--}}
{{--                        <h4 class="title"><a href="">Nemo Enim</a></h4>--}}
{{--                        <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis--}}
{{--                            praesentium voluptatum deleniti atque</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 col-md-6 icon-box">--}}
{{--                        <div class="icon"><i class="bi bi-diagram-3"></i></div>--}}
{{--                        <h4 class="title"><a href="">Eiusmod Tempor</a></h4>--}}
{{--                        <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero--}}
{{--                            tempore, cum soluta nobis est eligendi</p>--}}
{{--                    </div>--}}
                </div>

            </div>
        </section><!-- End Features Section -->


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


    <script>
        $(document).ready(function () {
            $('#categoryCarousel').carousel({
                interval: 2000 // Set the interval in milliseconds (in this example, 2 seconds)
            });
        });
    </script>

@endpush

