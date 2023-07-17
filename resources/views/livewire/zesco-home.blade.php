<head>
    @push('custom-styles')
   
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="assets/bootstrap/bootstrap.css"> --}}
    <link href="assets/css/home.css" rel="stylesheet">
   
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">  --}}
    @endpush
</head>

<div>
    <body>

        <div class="container-fluid">
            <div class="wrapper container-fluid">
                <div class="box container-fluid">
                    <div class="row row-offcanvas row-offcanvas-left">
            
            
                        <!-- main right col -->
                        <div class="column col-lg-12 col-md-12 col-sm-12 col-xs-11" id="main">
            
                            <!-- top nav -->
                            <div class="navbar navbar-blue navbar-static-top" style="margin-left: -15px;">
                                <div class="navbar-header">
                                    <button class="navbar-toggle" type="button" data-toggle="collapse"
                                        data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a href="{{ route('ezesco-home') }}" class="navbar-brand logo">
                                        <img src="/img/Zesco.png" alt="" width="125" height="50"
                                            class="d-inline-block align-text-top"></a>
                                </div>

                                {{-- <div>
                                    <form wire:submit.prevent="search">
                                
                                        @csrf
                                        <input type="text" wire:model.defer="searchQuery" placeholder="Search for system..." id="search" required>
                                        <button type="submit" class="btn btn-primary" id="search-btn">Search</button>
                                    </form>
                                
                                </div> --}}
                                <nav class="collapse navbar-collapse" role="navigation">

                                    <ul id="search-bar" class="nav navbar-nav navbar-center text-center">
                                        <li>
                                            <div>
                                                <form wire:submit.prevent="search">
                                            
                                                    @csrf
                                                    <input type="text" wire:model.defer="searchQuery" placeholder="Search for system..." id="search" required>
                                                    <button type="submit" class="btn btn-primary" id="search-btn">Search</button>
                                                </form>
                                            
                                            </div>
                                        </li>
                                        
                                    </ul>
                                    <ul class="nav navbar-nav navbar-right">
                                    
                                        <li>
                                            
                                            <a href="{{ route('ezesco-systems') }}"><i class="bi bi-pass-fill text-center"></i><br> How to?</a>
                                        </li>
            
                                        <li>
                                            
                                            <a href="#"> <i class="bi bi-person-lines-fill text-center"></i><br>About us</a>
                                        </li>
            
                                        <li>
                                            
                                            <a href="#"><i class="bi bi-menu-up"></i><br> Contact</a>
                                        </li>
                                        <li>
                                           
                                            <a href="{{ route('login') }}"><i id="i-login" class="bi bi-box-arrow-in-right"></i><br> Login</a>
                                        </li>
                                    </ul>
                                </nav>
                                <div class="text-center" id="home-text">
                                    Welcome to eZESCO Dashboard
                                </div>
                            </div>
                            <!-- /top nav -->
            
                            <section>
                                {{-- <div class="container-fluid"> --}}
                                    {{-- <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12"> --}}
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
                                                    <img src="{{ asset('storage') }}/{{ $image['image'] }}" class="d-block w-100" alt="carousel image">
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
                                    {{-- </div> --}}
                                {{-- </div> --}}
                            </section>
                           
            
                            <section id="counts" class="counts section-bg text-center">
                                <div class="container text-center">
            
                                    <div class="row counters text-center">
                                        <div class="col-lg-3 col-3 text-center">
                                    @if($cost_savings == 0)
                                    <span  class="purecounter">
    
                                        loading..</span>
    
                                    @elseif($cost_savings >999 && $cost_savings <= 999999) <span 
                                        class="purecounter"> ${{ substr($cost_savings, 0, -3) }}K+</span>
    
                                    @elseif($cost_savings > 999999 && $cost_savings <= 999999999) <span
                                         class="purecounter"> ${{substr($cost_savings, 0,
                                        -6)}}M+</span>

                                    @elseif($cost_savings > 999999999 && $cost_savings <= 999999999999) <span
                                         class="purecounter"> ${{substr($cost_savings, 0,
                                        -9)}}B+</span>

                                        @elseif($cost_savings > 999999999999) <span 
                                            class="purecounter"> ${{substr($cost_savings, 0, -12)}}T+</span>

                                        @endif
                                        <p class="text-center">System's Cost Savings</p>
                                        </div>
            
                                        <div class="col-lg-3 col-4 text-center">
                                            <span  class="purecounter text-center">{{$active_systems}}</span>
                                            <p class="text-center">Active System's</p>
                                        </div>
            
                                        <div class="col-lg-3 col-4 text-center">
                                            <span  class="purecounter">{{$in_production}}</span>
                                            <p class="text-center">System's In Production</p>
                                        </div>
            
                                        <div class="col-lg-3 col-4 text-center">
                                            <span  class="purecounter">{{$total_categories}}</span>
                                            <p class="text-center">System Categories</p>
                                        </div>
            
                                    </div>
            
                                </div>
                            </section>
            
                            <div class="padding">
                                <div class="full col-sm-9">
            
                                    <!-- content -->
                                    <div class="row">
            
                                        <!-- main col left -->
                                        <div class="col-sm-5">
            
                                            <div class="panel panel-default">
                                                <div class="panel-heading text-center"><a href="#" class="pull-right">View all</a>
                                                    <h4 style="margin-left: 15px; "><i style="margin-left: 15px;" id="important-notice-icon" class="bi bi-envelope-fill text-center"></i><br>
                                                        Important Notice
                                                    </h4>
                                                </div>
                                                <div class="panel-body">
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

                                            <div class="panel panel-default">
                                                <div class="panel-heading text-center"><a href="#" class="pull-right">View all</a>
                                                    <h4 style="margin-left: 15px;"><i style="margin-left: 15px;" id="upcoming-events-icon" class="bi bi-calendar-event-fill text-center">
                                                    </i><Br> Upcoming Events</h4>
                                                </div>
                                                <div class="panel-body">
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
                                                                <p> {{ $event->date }} {{ $event->time }}</p>
                                                                <p> </p>
                                                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
            
            
                                            <div class="panel panel-default">
                                                <div class="panel-heading text-center">
                                                    <h4><i id="quote-icon" class="bi bi-chat-square-quote-fill"></i><br>Quote Of the Day</h4>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="flex-grow-1 ms-4 ps-3">
                                                        <figure>
                                                            <blockquote class="blockquote mb-4">
                                                                <p>
                                                                    <i id="bi-quote" class="bi bi-quote"></i>
                                                                    <span class="font-italic">Success is the result of hard work, 
                                                                        determination, and a relentless pursuit of excellence. Embrace challenges, stay
                                                                    focused, and let your unwavering commitment be the driving force behind your journey to greatness.</span>
                                                                </p>
                                                            </blockquote>
                                                            <figcaption class="blockquote-footer text-right">
                                                               - Colin Powell 
                                                            </figcaption>
                                                        </figure>
                                                    </div>
                                              </div>
                                            </div>
            
            
            
                                        </div>
            
                                        <!-- main col right -->
                                        <div class="col-sm-7">
            
                                            <div class="panel panel-default shadow">
                                                <div class="panel-heading text-center">
                                                    <h4>eZESCO Categories</h4>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="grid-container">
            
            
                                                        <main class="grid-item main">
                                                            <div class="items">
                                                                <div type="button"
                                                                    onclick=" window.location='{{ route('ezesco-home') }}'"
                                                                    class="item item1"></div>
                                                                <div class="item item2"></div>
                                                                <div class="item item3"></div>
                                                                <div class="item item4"></div>
                                                                <div class="item item5"></div>
                                                                <div class="item item6"></div>
                                                                <div class="item item7"></div>
                                                                <div class="item item8"></div>
                                                                <div class="item item9"></div>
                                                                <div class="item item10"></div>
                                                            </div>
            
                                                        </main>
            
                                                    </div>
                                                    <hr>
                                                    Access your preferred application by simply clicking the category
                                                    it belongs to. You can also drag and scroll left or right to
                                                    check for other application categories.
                                                </div>
                                            </div>

                                               
                                            <div class="panel panel-default">
                                                <div class="panel-heading text-center">
                                                    <h4>Frequently Accessed eZESCO Applications</h4>
                                                </div>
                                                <div class="panel-body">
                                                        @if ($getProducts->isEmpty())

                                                        @else
                                                        <div class="row text-center">
                                                           @foreach ($getProducts as $getProduct)
                                                           
                                                            <div id="frequently-accessed-system" class="col-lg-2 col-md-2 text-center">
                                                            
                                                                <div class="text-center" type="button" onclick=" window.location='{{ $getProduct->product_url }}'"
                                                                    wire:click="incrementClicks({{ $getProduct->product_id }})">
                                                                    <i id="system-icon" class="bi bi-bar-chart-fill"></i>
                                                                </div>
                                                                <p id="system-name" type="button" onclick=" window.location='{{ $getProduct->product_url }}'" class="text-center"
                                                                    wire:click="incrementClicks({{ $getProduct->product_id }})">
                                                                    {{ $getProduct->name }}
                                                                </p>
                                                            
                                                            </div>
                                                           
                                                            
                                                            @endforeach
                                                            </div>
                                                              <div id="clickedCategorySection" class="row d-flex justify-content-center align-items-center">
                                                            
                                                                @foreach ($getSelectedProducts as $getSelectedProduct)
                                                                @if (
                                                                !empty($getSelectedProduct->product_id) ||
                                                                !empty($getSelectedProducts->number_of_clicks) ||
                                                                !empty($getSelectedProducts->product_name) ||
                                                                (!empty($getSelectedProducts->product_url) && $getSelectedProduct != null))
                                                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 d-flex justify-content-center align-items-center">
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
                                                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 d-flex justify-content-center align-items-center">
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
                                                        @endif
                                                    <hr>
            
                                                </div>
                                            </div>
            
                                        </div>
                                    </div>
                                    <!--/row-->
                                        <div id="more-about-zesco" class="row">
                                        
                                            <div class="col-lg-12">
                                        
                                                <section id="about" class="about">
                                        
                                        
                                        
                                                    <div class="container" data-aos="fade-up" data-aos-delay="100">
                                        
                                                        <div class="row align-items-xl-center gy-5">
                                        
                                                            <div class="col-xl-5 content">
                                                                <h2>More About Zesco Applications</h2>
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

                                        @if ($ezesco_products->isEmpty())
                                        @else
                                        <div id="zesco-systems" class="container">
                                            <div class="section-title">
                                                <h2 class="text-center">eZESCO Applications</h2>
                                            </div>
                                        
                                            <section class="customer-logos slider">
                                        
                                                @foreach ($ezesco_products as $product)
                                                @if ($product->icon_link == null)
                                        
                                                @else
                                        
                                                <div class="text-center" style=" margin:10px; border:solid #d3882b 1px; padding:15px;">
                                                    <div class="slide text-center">
                                                        <div class="text-center">
                                                            <img class="text-center" src="{{ asset('storage') }}/{{ $product->icon_link }}"
                                                                style="margin-left:50px; width: 40px; height:40px;" alt="system">
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
                                                            <p class="text-left">
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
                    
                             
                                        <footer class="page-footer  font-small blue">
                                            <div id="footer-text" class="footer-copyright text-center"> Copyright © 2022-2025
                                                Designed by Innovation and System Development Division - ICT © ZESCO Limited... All rights
                                                reserved.
                                            </div>
                                        </footer>
                               
                              
            
                                    
            
                                </div><!-- /col-9 -->
                            </div><!-- /padding -->
                        </div>
                        <!-- /main -->
            
                    </div>
                </div>
            </div>
        </div>
       
    
    
    

        @livewireScripts
        @yield('scripts')
        
        
        @push('custom-scripts')
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        

        <script>
            $(document).ready(function() {
                $('[data-toggle=offcanvas]').click(function() {
                $(this).toggleClass('visible-xs text-center');
                $(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
                $('.row-offcanvas').toggleClass('active');
                $('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
                $('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
                $('#btnShow').toggle();
                });
                });
        </script>
        
        @endpush
    
    </body>
</div>
