@extends('layouts.app')

@section('content')
@push('custom-styles')
<link rel="stylesheet" href="{{ asset('/css/login.css') }}">
@endpush
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div wire:loading wire:target="login" class="loading-bar"></div>

                <div class="col-lg-12 text-center">
                   <div type="button" onclick=" window.location='{{ route('ezesco-home') }}'" id="login-home">
                    <i style="font-size: 35px" class="bi bi-house-fill"></i>
                    <p style="font-size: 20px">Home</p>
                   </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center">
                    <div class="card shadow bg-white justify-content-center align-items-center" id="card">
                        <div class="card-body text-center">
                            <div class="text-center mt-4">
                            <img src="/img/Zesco.png" alt="Welcome note" id="card-logo" width="190px">
                            </div>
                            
                            <form wire:submit.prevent="forgotPassword">
                              <div class="input-group">
                                <input type="email" class="form-control form-rounded" wire:model.defer="email" name="email" placeholder="Email" required>
                              
                              </div>
                              @error('email') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror
                              {{-- <div class="input-group">
                              <input id="password" wire:model.defer="password" type="password" class="form-control form-rounded" name="password" placeholder="Password" required>
                             
                              </div>
                              @error('password') <span style="color:red; font-size:12px;">{{ $message }}</span> @enderror --}}
                              
                              <div class="form-group">
                               
                              <button class="btn btn-primary form-rounded" type="submit" name="submit">Send Password Reset</button>
                              @if (session()->has('error'))
                              <div style="text-align:left; margin-left:20px; color:red; font-size:13px;">{{ session('error') }}</div>
                              @endif
                              </div>
                              <div>
                             
                              <a type="submit" onclick=" window.location='{{ route('login') }}'" id="forgotPass"><p class="mt-3">Login</p></a>
                              </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
