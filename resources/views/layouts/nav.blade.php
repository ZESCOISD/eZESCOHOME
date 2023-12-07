<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="{{ route('ezesco-home') }}" class="logo">
            <img src="/img/Zesco.png" alt="" class="img-fluid">
        </a>
        <form class="form-inline my-2 my-lg-0">
            <div class="input-group">
                <input wire:model="nav_search"  wire:keydown.debounce.300ms="navSearch"
                       class="form-control" type="search" placeholder="Search system" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-outline-success ml-1" type="submit">
                        <i class="bi bi-search"></i>
                        <span wire:loading>
                            ...
                        </span>
                    </button>
                </div>
            </div>
        </form>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="active" href="{{ route('ezesco-home') }}">Home</a></li>
                <li><a href="{{route('ezesco-home.how.to')}}">How To</a></li>
                <li><a href="{{route('ezesco-home.contact.us')}}">Contact Us</a></li>
                <li class="dropdown"><a href="#"><span>Systems By Categories</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        @foreach($categories as $category)
                        <li class="dropdown"><a href="#"><span>{{$category->name }} ({{$category->products->count() }})</span>  <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                @foreach($category->products as $product)
                                <li>  <a href="javascript:void(0)" wire:click="recordClick({{$product->id}})" >
                                     
                                @if(  $product['heart_beat']  == "on")
                                                            &#128994;
                                                            @else
                                                            &#128992;
                                                            @endif
                                {{$product->name ?? "--"}}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1 "></i>  Login</a>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>

    @if( sizeof($search_results ?? []) > 0)
    <div class="container  d-flex align-items-center justify-content-between">
        <div class="row text-center mt-2">
            <div class="col">
                <h6>Search Results</h6>
                <div class="d-flex">
                    @foreach($search_results as $result)
                        <div class="p-2 text-lowercase">
                            <a href="javascript:void(0)" wire:click="recordClick({{$result->id}})" >
                           
                            @if(  $result['heart_beat']  == "on")
                                                            &#128994;
                                                            @else
                                                            &#128992;
                                                            @endif
                            {{ $result->name }}
                                </a> | </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
        @endif

</header><!-- End Header -->
