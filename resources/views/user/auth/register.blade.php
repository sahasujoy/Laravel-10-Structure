@php
    $configData = \App\Helpers\TemplateHelpers::applClasses();
@endphp
@extends('user/layouts/userFullLayoutMaster')

@section('title', 'Register')

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
                        <img class="img-fluid" src="{{asset('images/pages/register-v2-dark.svg')}}" alt="Register"/>
                    @else
                        <img class="img-fluid" src="{{asset('images/pages/register-v2.svg')}}" alt="Register"/>
                    @endif
                </div>
            </div>
            <!-- /Left Text-->
            <!-- Register-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title font-weight-bold mb-1">Adventure starts here 🚀</h2>
                    <p class="card-text mb-2">Make your app management easy and fun!</p>
                    <form class="user-register-form mt-2" action="{{route('admin-registration-store')}}" method="POST">
                        @csrf
                        <input class="form-control hidden" id="type" type="text" name="type" value="2"/>
                        <div class="form-group">
                            <label class="form-label" for="name">First Name</label>
                            <input class="form-control" id="first_name" type="text" name="first_name"
                                   placeholder="John" aria-describedby="first_name" autofocus=""
                                   tabindex="1"/>
                            <span class="text-danger error-text first_name_err"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="name">Last Name</label>
                            <input class="form-control" id="last_name" type="text" name="last_name"
                                   placeholder="Doe" aria-describedby="last_name" autofocus=""
                                   tabindex="1"/>
                            <span class="text-danger error-text last_name_err"></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" id="email" type="text" name="email"
                                   placeholder="john@example.com" aria-describedby="email" tabindex="2"/>
                            <span class="text-danger error-text email_err"></span>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label class="form-label" for="phone">Phone</label>--}}
{{--                            <input class="form-control" id="phone" type="text" name="phone"--}}
{{--                                   placeholder="" aria-describedby="phone" tabindex="2"/>--}}
{{--                            <span class="text-danger error-text phone_err"></span>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="form-label" for="password">Password</label>--}}
{{--                            <div class="input-group input-group-merge form-password-toggle">--}}
{{--                                <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" aria-describedby="password" tabindex="3" />--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <span class="input-group-text cursor-pointer">--}}
{{--                                      <i data-feather="eye"></i>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <span class="text-danger error-text password_err"></span>--}}
{{--                        </div>--}}
                        <button type="submit" class="btn btn-primary btn-block sign-up" tabindex="5">Sign up</button>
                    </form>
                    <p class="text-center mt-2">
                        <span>Already have an account?</span>
                        <a href="{{route('user-login-view')}}"><span>&nbsp;Sign in instead</span></a>
                    </p>
                </div>
            </div>
            <!-- /Register-->
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{asset('js/scripts/pages/user-register.js')}}"></script>
@endsection
