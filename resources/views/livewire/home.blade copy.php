@push('custom-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush

<div>

    <head>
        <title>eszesco home</title>
        @livewireStyles

    </head>

    <body id="index-body">
        {{--
        <div wire:ignore id="splash-screen">
            <img src="/img/zesco-gif.gif" alt="splash screen">
        </div> --}}
        <nav wire:ignore class="navbar navbar-inverse navbar-fixed-top">

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

        <div class="container-fluid">
            <div wire:loading wire:target="search" class="loading-bar"></div>
            <div wire:loading wire:target="showResult" class="loading-bar"></div>

            <div id="search-bar" class="row">

                <div class="col-md-12 mx-auto d-flex justify-content-center align-items-center">

                    <div>

                        @if ($searchedProduct)
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

                                        <p id="index-card-text" class="card-text mt-4 bg-danger">No results found</p>
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
                        @endif
                    </div>
                </div>

            </div>
            <div class="row">
                <div id="hr-top"
                    class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                    <hr>
                </div>
            </div>
            <div wire:ignore class="row text-center">
                <div id="category-panel"
                    class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center">

                    <div id="elem">
                        <div class="dropdown">
                            @foreach ($showCategories as $showCategory)
                                <div class="dropdown-list">

                                    <div class="dropdown">

                                        <button id="dropdown" class="btn btn-secondary" type="button"
                                            wire:click="showResult({{ $showCategory->category_id }})">
                                            {{ $showCategory->name }}
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="hr-bottom"
                    class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center">
                    <hr>
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
                            </style>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach


        </div>


        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                <h2 id="text-frequently-accessed">Frequently Accessed</h2>
            </div>
        </div>
        <div id="clickedCategorySection" class="row d-flex justify-content-center align-items-center">

            @foreach ($getProducts as $getProduct)
                <div
                    class="col-xl-3 col-lg-3 col-md-4s col-sm-6 col-sm-12 d-flex justify-content-center align-items-center">
                    <div class="card" id="index-cards">
                        <a>
                            <div class="card-body" id="index-card-body">
                                <div class="row">
                                    <div class="col-9">

                                        <h3>{{ $getProduct->name }} </h3>

                                        <h4 class="card-title" id="index-card-title"> Visits Today
                                            {{ $getProduct->clicks }}
                                        </h4>
                                    </div>
                                    <div class="col-3 mt-2">
                                        <i id="system-icon" class="bi bi-bar-chart-fill"></i>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="card-footer text-center">
                            <div type="button" class="card-link"
                                onclick=" window.location='{{ $getProduct->product_url }}'"
                                wire:click="incrementClicks({{ $getProduct->product_id }})">
                                <p id="index-card-text" class="card-text">Visit page</p>
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach


        </div>

        <!-- Footer -->
        <footer class="page-footer font-small blue">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3"> Copyright © 2022-2025
                Designed by Innovation and System Development Division - ICT © ZESCO Limited... All rights reserved.
                {{-- <a href="/"> MDBootstrap.com</a> --}}
            </div>
            <!-- Copyright -->

        </footer>
        <!-- Footer -->
    </div>


    @livewireScripts
    @yield('scripts')


    @push('custom-scripts')
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    @endpush



</body>
</div>
