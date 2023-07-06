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

        <nav wire:ignore class="navbar navbar-inverse navbar-fixed-top">

            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">
                        <a onclick=" window.location='{{ route('ezesco-home') }}'">
                            <img src="/img/Zesco.png" alt="" width="125" height="50"
                                class="d-inline-block align-text-top"></a>
                    </a>
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


        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex justify-content-center align-items-center">
            <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
                <h1>eZesco<br></h1>
                <h2>Learn about all Zesco systems and how best they can serve you.</h2>
            </div>
        </section><!-- End Hero -->


        <div class="section-header mb-4">
            <h2 class="text-center mb-4" id="get-started">LEARN MORE ABOUT EZESCO SYSTEMS</h2>

        </div>


        <div class="text-center mt-5">
            {{-- <form wire:submit.prevent="search"> --}}

            {{-- @csrf --}}
            <input type="text" wire:model="searchQuery" placeholder="Search for system..." id="search" required>
            <button type="submit" class="btn btn-primary" id="search-btn">Search</button>
            {{-- </form> --}}

        </div>

        <!-- ======= Our Services Section ======= -->
        <section id="services-list" class="services-list">
            <div class="container" data-aos="fade-up">


                <section id="popular-courses" class="courses">
                    <div class="container" data-aos="fade-up">

                        <div class="row mb-3" data-aos="zoom-in" data-aos-delay="100">
                            @forelse ($getProducts as $products)
                                <div id="learn-more-system-card" class="col-lg-4 col-md-6 d-flex align-items-stretch">
                                    <div class="course-item">
                                        {{-- <img src="/img/home-bg-img.jpg" class="img-fluid" alt="..."> --}}
                                        <video width="320" height="260" poster="/img/home-bg-img.jpg" controls>
                                            <source src="/videos/default.mp4" type="video/mp4">
                                            {{-- <source src="movie.ogg" type="video/ogg"> --}}
                                            Your browser does not support the video tag.
                                        </video>
                                        {{-- <img class="cover-image" src="/img/home-bg-img.jpg" alt="Cover Image"> --}}
                                        <div class="course-content">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h4 type="button" data-toggle="modal" data-target="#learnMoreModal"
                                                    href="#learnMoreModal" data-toggle="modal"
                                                    data-target="#learnMoreModal"
                                                    wire:click="showMore({{ $products->product_id }})">
                                                    Learn more</h4>

                                            </div>
                                            <h3>{{ $products->name }}</h3>
                                            <p>{{ $products->short_description }}</p>
                                            <p id="view-icon" style="display: inline;">View user manual</p><i
                                                onclick="viewPDF()" type="button" style="color: black; margin-top:4px;"
                                                class="bi bi-eye-fill"></i>
                                            <br>
                                            <p id="download-icon" style="display: inline;">Download user manual
                                            </p><i onclick="downloadPDF()" type="button"
                                                style="color: black; margin-top:4px;"
                                                class="bi bi-cloud-arrow-down-fill"></i>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center" colspan="16">
                                    <p>No records found</p>
                                </div>
                            @endforelse
                        </div>
                        <div id="pdfOverlay" onclick="closePDF()"></div>
                        <div id="pdfContainer">
                            <embed src="/documents/how-to.pdf" type="application/pdf">
                            <button onclick="closePDF()">Close</button>
                        </div>
                        <div class="clearfix">
                            {{-- <p>Show More</p> --}}
                            <div id="links" class="">
                                {{ $getProducts->links() }}
                            </div>
                        </div>

                        <div wire:ignore.self class="modal fade" id="learnMoreModal" tabindex="-1" role="dialog"
                            aria-labelledby="learnMoreModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 50%;"
                                role="document">
                                <div class="modal-content">
                                    <div style="background-color:white;" class="modal-header">
                                        <h1 style="font-size: 25px" class="modal-title" id="learnMoreModalLabel">
                                            {{ $name }}</h1>
                                        <button id="modal-close" type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body" id="modal-body">

                                        <h5>About</h5>
                                        <p wire:model.defer='name'>{{ $long_description }}</p>

                                        <h5>Active Since {{ $name }}</h5>
                                        <p wire:model.defer='name'>{{ $date_launched }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

        </section>
        <!-- End Our Services Section -->




        <div id="suggestion-section" class="row text-center">
            <div id="suggestion-info-parent" class="col-xl-6 col-lg-6">
                <div id="suggestion-info">

                    <h1> <i id="importance" class="bi bi-ui-checks"></i>Importance Of Your Feedback</h1>
                    <p class="mt-5">
                        Expressing your opinions and sharing your suggestions has never been easier.
                        We invite you to join our group of change-makers and contribute your thoughts to help shape
                        the
                        the company.We believe that every idea has the potential to be a game-changer. By utilizing our
                        online
                        suggestion box, you gain a platform that amplifies your voice and ensures your input reaches the
                        decision-makers who can turn your suggestions into reality.
                    </p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 d-flex content-align-center align-items-center text-center">
                <div id="suggestion-card" class="card shadow p-4">
                    <h3 class="mb-2 text-start">Product Suggestion Box</h3>
                    <p class="text-start">Suggest areas of system improvement to enhance and make Zesco system's better
                    </p>
                    <form wire:submit.prevent="saveSuggestion">
                        @csrf
                        <div class="row gy-4">

                            <div class="col-md-6" class="form-control">
                                <input type="text" class="form-control" wire:model.defer="subject"
                                    placeholder="Suggestion subject" required>
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="form-control" wire:model.defer="system_name"
                                    placeholder="System name" required>
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="message" wire:model.defer="suggestion" rows="6" placeholder="Suggest"
                                    required></textarea>
                            </div>

                            {{-- <button class="btn" type="submit">Submit Message</button> --}}


                            <div class="modal-footer mt-3 text-center" id="modal-footer">
                                <button style="background-color: #1bad6c" type="submit"
                                    class="btn btn-danger">Submit Message</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- End Counts Section -->

        <!-- Footer -->
        <footer class="page-footer font-small blue">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3"> Copyright © 2022-2025
                Designed by Innovation and System Development Division - ICT © ZESCO Limited... All rights
                reserved.
                {{-- <a href="/"> MDBootstrap.com</a> --}}
            </div>
            <!-- Copyright -->

        </footer>
        <!-- Footer -->



    </body>


    @livewireScripts
    @yield('scripts')


    @push('custom-scripts')
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    @endpush



    </body>
</div>
