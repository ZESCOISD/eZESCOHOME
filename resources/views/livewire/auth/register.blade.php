<div>
    <div>
        @push('custom-styles')
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="{{ asset('/css/register.css') }}">
        @endpush
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-none d-lg-block" id="art-div">
                    <div>
                        <img src="/img/login-left-design.png" alt="login-left-design" class="img-responsive"
                            id="art">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <!--ontop Logo-->
                    <div class="row">
                        <div wire:loading wire:target="register" class="loading-bar"></div>

                        <div class="col-lg-12 text-center">
                            <div type="button" onclick=" window.location='{{ route('zesco-home') }}'" id="login-home">
                                <i style="font-size: 35px" class="bi bi-house-fill"></i>
                                <p style="font-size: 20px">Home</p>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div
                            class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">

                            <div class="card shadow bg-white justify-content-center align-items-center" id="card">
                                <div class="card-body text-center">
                                    <div class="text-center">
                                        <img src="/img/Zesco.png" alt="Welcome note" id="card-logo" width="190px">
                                    </div>


                                    @if(session()->has('message'))
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-success alert-block">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <p>{{session()->get('message')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(session()->has('error'))
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-danger alert-block">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <p>{{session()->get('error')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(session()->has('info'))
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-danger alert-block">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <p>{{ $info }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-danger">
                                                    <strong>Yangu!</strong> There were some problems with your input.<br><br>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                    <form wire:submit.prevent="register">



                                        <div class="input-group">
                                            <input type="text" class="form-control form-rounded"
                                                   wire:model.defer="staff_number" name="staff_number" placeholder="Staff No"
                                                   required>
                                        </div>
                                        @error('staff_no')
                                        <span style="color:red; font-size:12px;">{{ $message }}</span>
                                        @enderror

                                        <div class="input-group">
                                            <input type="text" class="form-control form-rounded"
                                                   wire:model.defer="email" name="email" placeholder="Email"
                                                   required>
                                        </div>
                                        @error('email')
                                        <span style="color:red; font-size:12px;">{{ $message }}</span>
                                        @enderror

                                        <div class="input-group">
                                            <input type="text" class="form-control form-rounded"
                                                   wire:model.defer="name" name="name" placeholder="Full Name"
                                                   required>
                                        </div>
                                        @error('name')
                                        <span style="color:red; font-size:12px;">{{ $message }}</span>
                                        @enderror

                                        <div class="input-group">
                                            <input id="password" wire:model.defer="password" type="password"
                                                   class="form-control form-rounded" name="password" placeholder="Password"
                                                   required>
                                        </div>
                                        @error('password')
                                        <span style="color:red; font-size:12px;">{{ $message }}</span>
                                        @enderror

                                        <div class="input-group">
                                            <input id="confirm-password" wire:model.defer="confirm_password" type="confirm_password"
                                                   class="form-control form-rounded" name="confirm-password" placeholder="Confirm Password"
                                                   required>
                                        </div>
                                        @error('confirm-password')
                                        <span style="color:red; font-size:12px;">{{ $message }}</span>
                                        @enderror

                                        <div class="form-group">

                                            <button class="btn btn-primary form-rounded" type="submit"
                                                name="submit">Register</button>
                                            @if (session()->has('error'))
                                                <div
                                                    style="text-align:left; margin-left:20px; color:red; font-size:13px;">
                                                    {{ session('error') }}</div>
                                            @endif
                                        </div>
                                        <div>

                                            <a type="submit"
                                                onclick=" window.location='{{ route('login') }}'"
                                                id="forgotPass">
                                                <p class="mt-3">Have an Account?</p>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>