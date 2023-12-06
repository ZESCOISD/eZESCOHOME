
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
                <h2>Zesco Systems</h2>
                <ol>
                    <li><a href="{{route('ezesco-home')}}">Home</a></li>
                    <li>Zesco Systems</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->



    <div id="suggestion-section" class="row text-center">

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

            <div wire:loading wire:target="saveSuggestion" class="loading-bar"></div>
            @if (session()->has('saveSuggestion'))
                <div id="dismiss"
                    class="alert alert-info alert-dismissible mt-3 text-bg-success  p-2 text-center fade show"
                    role="alert" style="border:none; font-size: 12px;">
                    <p class="mt-3">{{ session('saveSuggestion') }}</p>
                    <button style="color:white;" type="button" class="btn-close mt-1" wire:click="closeModal"
                        data-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            @endif
            <div id="suggestion-info-parent" class="col-xl-6 col-lg-6">
                <div id="suggestion-info">

                    <h1> <i id="importance" class="bi bi-ui-checks"></i>Importance Of Your Feedback</h1>
                    <p class="mt-5">

                        We invite you to join our group of change-makers and contribute your thoughts to help shape

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
                                    placeholder="Title Of Suggestion" required>
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




   
 
    <!-- End Event List Section -->

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

