
@push('custom-styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush

@extends('layouts.app')

@section('content')
 <div> 
<head>
    @livewireStyles
</head>
<body id="index-body">
    

    {{-- <div wire:ignore id="splash-screen">
            <img src="/img/zesco-gif.gif" alt="splash screen">
        </div> --}}
    <div wire:loading wire:target="search" class="loading-bar" style="margin: 0;"></div>

    <nav class="navbar navbar-inverse navbar-fixed-top">

        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <a onclick=" window.location='{{ route('ezesco-home') }}'">
                        <img src="/img/Zesco.png" alt="" width="125" height="50"
                            class="d-inline-block align-text-top"></a>
                </a>
            </div>

            <div>
                <form wire:submit.prevent="search">

                    @csrf
                    <input type="text" wire:model.defer="searchQuery" placeholder="Search for system..."
                        id="search" required>
                    <button type="submit" class="btn btn-primary" id="search-btn">Search</button>
                </form>

            </div>

            <ul class="nav navbar-nav navbar-right navbar-item text-center">

                <li>
                    <i class="bi bi-pass-fill text-center"></i><br>
                    <a href="{{ route('ezesco-systems') }}"> How to?</a>
                </li>

                <li>
                    <i class="bi bi-person-lines-fill text-center"></i><br>
                    <a href="#"> About us</a>
                </li>

                <li>
                    <i class="bi bi-menu-up"></i><br>
                    <a href="#"> Contact</a>
                </li>
                <li>
                    <i class="bi bi-box-arrow-in-right"></i><br>
                    <a href="{{ route('login') }}"> Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="text-center" id="home-text">
        Welcome to eZESCO Dashboard
    </div>

    @if ($searchedProduct)
    <div id="search-bar" class="row">

        <div class="col-md-12 mx-auto d-flex justify-content-center align-items-center">

            <div>
                    <div class="card card-animated" id="search-cards">
                        <a id="searchedcard-link" class="card-link" href="{{ $searchedProduct->product_url }}"
                            wire:click="incrementClicks({{ $searchedProduct->product_id }})"
                            data-product-id="{{ $searchedProduct->product_id }}">
                            <div class="card-body" id="searched-card-body">

                                <p id="searchedcard-card-text" class="card-text mt-4">
                                    {{ $searchedProduct->product_name }}</p>
                            </div>
                        </a>

                    </div>
                @elseif($searchQuery !== null && $searchedProduct === null)
                    <div class="card card-animated" id="search-cards">
                        <a class="card-link">
                            <div class="card-body" id="index-card-body">

                                <p id="index-card-text" class="card-text mt-4 bg-danger">No results
                                    found</p>
                            </div>
                        </a>

                    </div>
                @else
                    <div>
                        <style>
                            #search-cards {
                                display: none;
                            }
                        </style>
                    </div>
               
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">

                    @foreach ($slides as $index => $image)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
                            class="{{ $index === 0 ? 'active' : '' }}">
                        </li>
                    @endforeach
                </ol>
                <div class="carousel-inner">

                    @foreach ($slides as $index => $image)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage') }}/{{ $image['image'] }}" class="d-block w-100"
                                alt="carousel image">
                        </div>
                    @endforeach


                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

    <section id="counts" class="counts section-bg text-center">
        <div class="container text-center">

            <div class="row counters text-center">
                <div class="col-lg-2 col-4 text-center">
                    @if($cost_savings == 0)
                    <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1"
                        class="purecounter">
                       
                        loading..</span>

                    @elseif($cost_savings >999 && $cost_savings <= 999999)
                    <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1"
                        class="purecounter"> ${{ substr($cost_savings, 0, -3) }}K+</span>

                    @elseif($cost_savings > 999999 && $cost_savings <= 999999999)
                    <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1"
                        class="purecounter"> ${{substr($cost_savings, 0, -6)}}M+</span>
                    
                   @elseif($cost_savings > 999999999 && $cost_savings <= 999999999999) <span data-purecounter-start="0"
                        data-purecounter-end="1232" data-purecounter-duration="1" class="purecounter"> ${{substr($cost_savings, 0, -9)}}B+</span>

                    @elseif($cost_savings > 999999999999) <span data-purecounter-start="0"
                        data-purecounter-end="1232" data-purecounter-duration="1" class="purecounter"> ${{substr($cost_savings, 0, -12)}}T+</span>
                    
                    @endif
                    <p>System's Cost Savings</p>
                </div>

                <div class="col-lg-2 col-4 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1"
                        class="purecounter">{{$active_systems}}</span>
                    <p>Active System's</p>
                </div>

                <div class="col-lg-2 col-4 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1"
                        class="purecounter">{{$in_production}}</span>
                    <p>System's In Production</p>
                </div>

                <div class="col-lg-2 col-4 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="64" data-purecounter-duration="1"
                        class="purecounter">{{$total_categories}}</span>
                    <p>System Categories</p>
                </div>

                <div class="col-lg-2 col-4 text-center">
                    <span data-purecounter-start="0" data-purecounter-end="42" data-purecounter-duration="1"
                        class="purecounter">12,000+</span>
                    <p>System User's</p>
                </div>
            </div>

        </div>
    </section>
    <div wire:loading wire:target="showResult" class="loading-bar"></div>

    <div class="row">
            <div id="notice-div" class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div id="important-notice" class="card shadow mb-1 bg-body rounded">
                    <div id="notice-div" class="card-body">
                        <div class="text-center">
                            <i id="important-notice-icon" class="bi bi-envelope-fill text-center"></i>
                        </div>
                        <h3 id="important-notice-header" class="card-title mt-2 mb-4 text-center">Important Notice
                        </h3>
                        <div class="card-text">
                            @if ($more_notices->isEmpty())
                                <div id="notice-data" class="text-center">
                                    <h5 style="color: grey;" class="mt-5">No Notices Found.</h5>

                                </div>
                            @elseif ($more_notices->isNotEmpty())
                                @foreach ($more_notices as $notice)
                                    <div id="notice-data" class="text-left">
                                        <h4>{{ $notice->notice_name }}</h4>
                                        <p>{{ $notice->description }}</p>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-xl-6">
                                            <div id="notice-data" class="text-start">
                                                <h5>From {{ $notice->staff_title }}</h5>
                                                <p> {{ $notice->staff_name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="text-center">
                                                <h5>Department</h5>
                                                <p> {{ $notice->department }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- {{ $more_notices->links() }} --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>


        <div id="category-panel" class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 text-center">
            <div class="row">
                @if ($showCategories->isEmpty())
                    <h2 style="margin-top:400px; font-size:50px; color: rgb(179, 175, 175)">No System Data
                        Available Yet.</h2>
                @else
                    <div wire:ignore class="col-xl-12 col-lg-12 col-md-12 text-center">
                        <h3 class="mt-2">Categories</h3>
                        <div class="text-center" id="elem">
                            <div class="dropdown text-center">
                                @foreach ($showCategories as $showCategory)
                                    <div class="dropdown-list">

                                        <div class="dropdown mt-3">

                                            <div id="dropdown" class="card shadow p-3 mb-5" type="button"
                                                wire:click="showResult({{ $showCategory->category_id }})">
                                                <div class="card-body">
                                                    {{ $showCategory->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                @endif
                @if ($getProducts->isEmpty())
                @else
                    <div class="row">
                        <h3 class="mb-3">Frequently Accessed Systems</h3>

                        @foreach ($getProducts as $getProduct)
                            <div id="frequently-accessed-system" class="col-lg-3 col-md-3 text-center">

                                <div class="card shadow p-3 text-center" type="button"
                                    onclick=" window.location='{{ $getProduct->product_url }}'"
                                    wire:click="incrementClicks({{ $getProduct->product_id }})">
                                    {{-- {{ $getProduct->name }} --}}
                                    <div class="card-body">

                                        <i id="system-icon" class="bi bi-bar-chart-fill"></i>
                                    </div>
                                </div>
                                <p type="button" onclick=" window.location='{{ $getProduct->product_url }}'"
                                    class="card-title mt-2 mb-4"
                                    wire:click="incrementClicks({{ $getProduct->product_id }})">
                                    {{ $getProduct->name }}
                                </p>

                            </div>
                        @endforeach
                        <div id="clickedCategorySection" class="row d-flex justify-content-center align-items-center">

                            @foreach ($getSelectedProducts as $getSelectedProduct)
                                @if (
                                    !empty($getSelectedProduct->product_id) ||
                                        !empty($getSelectedProducts->number_of_clicks) ||
                                        !empty($getSelectedProducts->product_name) ||
                                        (!empty($getSelectedProducts->product_url) && $getSelectedProduct != null))
                                    <div
                                        class="col-xl-3 col-lg-3 col-md-4 col-sm-12 d-flex justify-content-center align-items-center">
                                        <div class="card category-card-animated flex-column" id="categoryCards">
                                            <a class="card-link" href="{{ $getSelectedProduct->product_url }}"
                                                wire:click="incrementClicks({{ $getSelectedProduct->product_id }})">
                                                <div class="card-body" id="categoryCards-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <h4 class="card-title" id="categoryCards-title">
                                                                {{ $getSelectedProduct->number_of_clicks }}</h4>
                                                            <p id="categoryCards-text" class="card-text mt-2">
                                                                {{ $getSelectedProduct->product_name }}</p>
                                                        </div>
                                                    </div>

                                                </div>
                                                <style>
                                                    #search-cards {
                                                        display: none;
                                                    }

                                                    #frequently-accessed-system {
                                                        display: none;
                                                    }
                                                </style>
                                            </a>
                                        </div>
                                    </div>
                                @elseif (
                                    !empty($getSelectedProduct->product_id) ||
                                        !empty($getSelectedProducts->number_of_clicks) ||
                                        !empty($getSelectedProducts->product_name) ||
                                        (!empty($getSelectedProducts->product_url) && $getSelectedProduct == null))
                                    <div
                                        class="col-xl-3 col-lg-3 col-md-4 col-sm-12 d-flex justify-content-center align-items-center">
                                        <div class="card category-card-animated flex-column" id="categoryCards">

                                            <div class="card-body" id="categoryCards-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h4 class="card-title" id="categoryCards-title">
                                                            Results</h4>
                                                        <p id="categoryCards-text" class="card-text mt-2">
                                                            No Systems Are Available For This System Yet</p>
                                                    </div>
                                                </div>

                                            </div>
                                            <style>
                                                #search-cards {
                                                    display: none;
                                                }

                                                #frequently-accessed-system {
                                                    display: none;
                                                }
                                            </style>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div id="upcoming-events-div" class="col-lg-4">
            <div id="upcoming-events" class="card shadow p-3 bg-body rounded">
                <div class="card-body text-center">
                    <i  id="upcoming-events-icon" class="bi bi-chat-square-text text-center">
                    </i>
                    <h5 id="upcoming-events-head" class="card-title text-center">Upcoming Events</h5>
                    @if ($upcoming_events->isEmpty())
                        <div id="notice-data" class="text-center">
                            <h5 style="color: grey;" class="mt-5">No Upcoming Events Found.</h5>
                        </div>
                    @elseif ($upcoming_events->isNotEmpty())
                        @foreach ($upcoming_events as $event)
                            <div class="text-start">
                                <h4 class="mt-4">{{ $event->event_name }}</h4>
                                <p>{{ $event->event_description }}</p>
                            </div>
                            <div class="row mt-5">
                                <div class="col-xl-6">
                                    <div class="text-start">
                                        <h5>From {{ $event->venue }}</h5>
                                        <p>Fee K{{ $event->fee }}</p>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="text-end">
                                        <h5>Date and Time</h5>
                                        <p> {{ $event->date }}  {{ $event->time }}</p> <p> </p>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="more-about-zesco" class="row">

        <div class="col-lg-12">
          
            <section id="about" class="about">



                <div class="container" data-aos="fade-up" data-aos-delay="100">

                    <div class="row align-items-xl-center gy-5">

                        <div class="col-xl-5 content">
                            <h2>More About Zesco Systems</h2>
                            <p>Know more about Zesco's in-house system's. Click the link below
                                to get started.
                            </p>
                            <a href="{{ route('ezesco-systems') }}" class="read-more"><span>Learn More</span><i
                                    class="bi bi-arrow-right" style="color: #d3882b"></i></a>
                        </div>

                        <div id="about-section" class="col-xl-7">
                            <div class="row gy-4 icon-boxes">

                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                                    <div class="icon-box">
                                        <i class="bi bi-buildings"></i>
                                        <h3>Getway</h3>
                                        <p>eZesco is the getway to other system's you wish to access</p>
                                    </div>
                                </div> 

                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                    <div class="icon-box">
                                        <i class="bi bi-clipboard-pulse"></i>
                                        <h3>Strategic Solutions</h3>
                                        <p>Providing well-thought-out and effective approaches to problems.</p>
                                    </div>
                                </div> 

                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                    <div class="icon-box">
                                        <i class="bi bi-command"></i>
                                        <h3>Performance-Driven</h3>
                                        <p> Focusing on achieving and exceeding performance goals and targets.</p>
                                    </div>
                                </div> 

                                <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                                    <div class="icon-box">
                                        <i class="bi bi-graph-up-arrow"></i>
                                        <h3>Continuous improvement</h3>
                                        <p> Committing to ongoing learning, growth, and refinement of processes and
                                            practices.</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </section>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row">
            <div id="hr-top"
                class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
            </div>
        </div>
      
        <div class="row">
            <div id="hr-bottom"
                class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center">
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                @foreach ($getSelectedProducts as $getSelectedProduct)
                    @if (!empty($getSelectedProduct->category_name))
                        <h3 class="mt-3 category-card-animated" id="text-category-name">
                            {{ $getSelectedProduct->category_name }}</h3>
                    @else
                        <h3 class="mt-3" id="text-category-name"></h3>
                    @endif

                    @if (!empty($getSelectedProduct->category_name))
                    @break
                @endif
            @endforeach
        </div>
     </div>
    </div>
   
    @if ($ezesco_products->isEmpty())
    @else
        <div id="zesco-systems" class="container">
            <div class="section-title">
                <h2 class="text-center">eZesco Systems</h2>
            </div>

            <section class="customer-logos slider">

                @foreach ($ezesco_products as $product)
                    @if ($product->icon_link == null)
        
                    @else
                       
                        <div class="text-center"
                            style=" margin:10px; border:solid #d3882b 1px; padding:15px;">
                            <div class="slide text-center">
                                <div class="text-center">
                                    <img class="text-center" src="{{ asset('storage') }}/{{ $product->icon_link }}"
                                        style="margin-left:59px; width: 40px; height:40px;" alt="system">
                                </div>
                               
                            </div>
                            <h6>{{ $product->name }}</h6>
                        </div>
                    @endif
                @endforeach
            </section>


        </div>
    @endif

  
    @if ($faqs->isEmpty())
    @else
        <section id="faq" class="faq">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

                        <div class="content px-xl-5">

                            <h3><span style="color: #d3882b;">Frequently Asked </span><strong
                                    style="color: #d3882b;">Questions</strong>
                            </h3>
                            <p>
                                Get answers from the frequently asked question's
                            </p>

                        </div>

                    </div>

                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        @foreach ($faqs as $faq)
                            <div class="faq-container">
                                <div class="faq-item faq-active">
                                    <h3><span>{{ $faq->question }}</span></h3>
                                    <div class="faq-content">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->
                            </div>
                        @endforeach


                    </div>
                </div>

            </div>

        </section><!-- End Faq Section -->
    @endif

    <footer class="page-footer font-small blue">
        <div class="footer-copyright text-center py-3"> Copyright © 2022-2025
            Designed by Innovation and System Development Division - ICT © ZESCO Limited... All rights
            reserved.
        </div>
    </footer>
  
       @livewireScripts
    @yield('scripts')


        @push('custom-scripts')

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        {{-- <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        @endpush

</body>
</div>
@endsection