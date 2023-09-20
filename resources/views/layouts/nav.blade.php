<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

{{--        <h1 class="logo"> --}}
{{--            <a href="{{ route('zesco-home') }}" class="navbar-brand logo">--}}
{{--                <img src="/img/Zesco.png" alt="" width="125" height="50"--}}
{{--                     class="d-inline-block align-text-top"></a>--}}
{{--        </h1>--}}
        <a href="{{ route('ezesco-home') }}" class="logo">
            <img src="/img/Zesco.png" alt="" class="img-fluid">
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="active" href="{{ route('ezesco-home') }}">Home</a></li>
                <li><a href="{{route('ezesco-home.learn.more')}}">How To</a></li>
                <li><a href="{{route('ezesco-home.contact.us')}}">Contact Us</a></li>
                <li class="dropdown"><a href="#"><span>Systems By Categories</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        @foreach($categories as $category)
                        <li class="dropdown"><a href="#"><span>{{$category->name }} ({{$category->products->count() }})</span>  <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                @foreach($category->products as $product)
                                <li>  <a href="javascript:void(0)" wire:click="recordClick({{$product->id}})" >
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
</header><!-- End Header -->
