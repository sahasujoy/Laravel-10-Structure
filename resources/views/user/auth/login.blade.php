@php
    $configData = \App\Helpers\TemplateHelpers::applClasses();
@endphp
@extends('user/layouts/userFullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
    <div class="auth-wrapper auth-v2">
        <div class="auth-inner row m-0">
            <!-- Brand logo-->
            <a class="brand-logo" href="javascript:void(0);">
                <img src="{{ asset('images/logo/' . env('MAIN_LOGO')) }}" style="width: 180px">
            </a>
            <!-- /Brand logo-->
            <!-- Left Text-->
            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
                    @if($configData['theme'] === 'dark')
                        <img class="img-fluid" src="{{asset('images/pages/login-v2-dark.svg')}}" alt="Login V2" />
                    @else
                        <img class="img-fluid" src="{{asset('images/pages/login-v2.svg')}}" alt="Login V2" />
                    @endif
                </div>
            </div>
            <!-- /Left Text-->
            <!-- Login-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title font-weight-bold mb-1">Welcome to {{ env('APP_NAME') }} &#x1F44B;</h2>
                    <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
                    <span class="text-danger error-text credential_error"></span>

                    <form class="user-login-form mt-2">
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" type="text" name="email" placeholder="john@example.com" aria-describedby="email" autofocus="" tabindex="1" />
                            <span class="text-danger error-text email_err"></span>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" aria-describedby="password" tabindex="2" />
                                <span class="text-danger error-text password_err"></span>
                                <div class="input-group-append">
                                  <span class="input-group-text cursor-pointer">
                                    <i data-feather="eye"></i>
                                  </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="remember-me" type="checkbox" tabindex="3" />
                                <label class="custom-control-label" for="remember-me">Remember Me</label>
                            </div>
                            <a href="{{route('user-forgot-password')}}">
                                <small>Forgot Password?</small>
                            </a>
                        </div>
                        <button type="button" class="btn btn-primary btn-block sign-in-btn" tabindex="4">Sign in</button>
                    </form>
                    <p class="text-center mt-2">
                        <span>New on our platform?</span>
                        <a href="{{route('user-registration-view')}}"><span>&nbsp;Create an account</span></a>
                    </p>
                </div>
            </div>
            <!-- /Login-->
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{asset(mix('js/scripts/pages/user-login.js'))}}"></script>
@endsection
