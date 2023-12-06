
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
                    <h2>Contact</h2>
                    <ol>
                    <li><a href="{{route('ezesco-home')}}">Home</a></li>
                        <li>Contact</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Contact Us Section ======= -->
        <section id="contact-us" class="contact-us">
            <div class="container">

                <div>
                    <iframe style="border:0; width: 100%; height: 270px;"
                            src="https://maps.google.com/maps?q=ZESCO%20HEad%20office&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" allowfullscreen></iframe>
                </div>

                
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

                <div class="row mt-5">

                    <div class="col-lg-4">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>{{$location}}</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>{{$isd_email}}</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>{{$isd_phone}}</p>
                            </div>

                        </div>

                        @if( sizeof($contactGroups) > 0)
                        <div class ="card mt-4">
                        <div class ="card-header">
                        <h4>Contact Groups</h4>
                        </div>
                        <div class ="card-body">
                        @foreach($contactGroups as $contact_group)
                          <p> <b> Name :</b> {{$contact_group->name ?? "--"}} </p> 
                          <p>   <b>  Email :</b>  {{$contact_group->email ?? "--"}}</p> 
                          <p>   <b> Phone : </b> {{$contact_group->phone ?? "--"}}</p>
                          <p>  <b>  Office :</b>  {{$contact_group->office_address ?? "--"}}</p> 
                          <p>  <b>   Location :</b>  {{$contact_group->location ?? "--"}}
                            <hr>
                        @endforeach
                        </div>
                       </div>
                        @endif
                       

                    </div>

                    <div class="col-lg-8 mt-5 mt-lg-0">

                        
                      <!-- contact-form.blade.php -->

        <form wire:submit.prevent="submitForm" class="php-email-form">
            @csrf

            <div class="row">
                            <div class="col-12">
                                <div class="form-group mt-3">
                                    <label class="form-label"> Please select which system or product you want to contact us for.</label>
                                    <select wire:model="selectedProductId" class="form-control mb-4" required>
                                        <option value="">-- Choose --</option>
                                        <option value="isd">In General</option>
                                        <option value="contact_isd">Contact ISD</option>
                                        <option value="contact_service_desk">Contact Service Desk</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}   : {{ $product->name }} </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>


            <div class="row">
                <div class="col-md-6 form-group">
                    <input wire:model.defer="name" type="text" class="form-control" placeholder="Your Name" required>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6 form-group mt-md-0">
                    <input wire:model.defer="email" type="email" class="form-control" placeholder="Your Email" required>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group mt-3">
                <input wire:model.defer="receipient" type="email" class="form-control" placeholder="Receipient" required readonly>
                @error('receipient') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group mt-3">
                <input wire:model.defer="subject" type="text" class="form-control" placeholder="Subject" required>
                @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mt-3">
                <textarea wire:model.defer="message" class="form-control" rows="5" placeholder="Message" required></textarea>
                @error('message') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="my-3">
                <div wire:loading>
                <div class="spinner-border text-primary" role="status">
  <span class="sr-only"></span>
</div>    
Loading...
               </div>

                
                @if($successMessage)
                    <div class="alert alert-success">{{ $successMessage }}</div>
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Send Message</button>
            </div>
        </form>

                    </div>

                </div>

            </div>
        </section><!-- End Contact Us Section -->

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

