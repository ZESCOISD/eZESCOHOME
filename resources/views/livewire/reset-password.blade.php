<div>
    <div>
        @push('custom-styles')
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="{{ asset('/css/login.css') }}">
        @endpush
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-none d-lg-block" id="art-div">
                    <div>
                        <img src="/img/login-left-design.png" alt="login-left-design" class="img-responsive" id="art">
                    </div>
                </div> --}}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!--ontop Logo-->
                    <div class="row">
                        <div wire:loading wire:target="resetPassword" class="loading-bar"></div>

                        <div class="col-lg-12 text-center">
                            <div type="button" onclick=" window.location='{{ route('zesco-home') }}'" id="login-home">
                                <i style="font-size: 35px" class="bi bi-house-fill"></i>
                                <p style="font-size: 20px">Home</p>
                            </div>
                        </div>

                        @if ($successMessage)
                            <style>
                                #resetpassword-section {
                                    display: none;
                                }
                            </style>
                            <div class="row">

                                <div
                                    class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">

                                    <div class="card shadow bg-white justify-content-center align-items-center"
                                        id="resetpassworcard">
                                        <div class="card-body text-center">
                                            <div class="text-center">
                                                <img src="/img/Zesco.png" alt="Welcome note" id="card-logo"
                                                    width="190px">
                                            </div>
                                            <div class="alert alert-success">{{ $successMessage }}</div>
                                            <a type="submit" onclick=" window.location='{{ route('login') }}'"
                                                id="forgotPass">
                                                <p class="mt-3">Go To Login Page</p>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="row" id="resetpassword-section">

                        <div
                            class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">



                            <div class="card shadow bg-white justify-content-center align-items-center"
                                id="resetpassworcard">
                                <div class="card-body text-center">
                                    <div class="text-center">
                                        <img src="/img/Zesco.png" alt="Welcome note" id="card-logo" width="190px">
                                    </div>

                                    <form wire:submit.prevent="resetPassword">
                                        <div class="input-group">
                                            <input type="email" class="form-control form-rounded"
                                                wire:model.defer="email" name="email" placeholder="Email" required>

                                        </div>
                                        @error('email')
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
                                            <input type="password" class="form-control form-rounded"
                                                wire:model.defer="password_confirmation" name="password_confirmation"
                                                placeholder="Confirm Password" required>

                                        </div>
                                        @error('password_confirmation')
                                            <span style="color:red; font-size:12px;">{{ $message }}</span>
                                        @enderror

                                        <div class="form-group">

                                            <button class="btn btn-primary form-rounded" type="submit"
                                                name="submit">Reset Password</button>
                                            @if (session()->has('error'))
                                                <div
                                                    style="text-align:left; margin-left:20px; color:red; font-size:13px;">
                                                    {{ session('error') }}</div>
                                                @error('email')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            @endif
                                        </div>
                                        <div>

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
