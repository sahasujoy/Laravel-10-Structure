@php
    $configData = \App\Helpers\TemplateHelpers::applClasses();
@endphp
@extends('admin/layouts/adminFullLayoutMaster')

@section('title', 'Reset Password')

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
                        <img src="{{asset('images/pages/reset-password-v2-dark.svg')}}" class="img-fluid"
                             alt="Register V2"/>
                    @else
                        <img src="{{asset('images/pages/reset-password-v2.svg')}}" class="img-fluid" alt="Register V2"/>
                    @endif
                </div>
            </div>
            <!-- /Left Text-->
            <!-- Reset password-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    @if ($success)
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span class="p-4"> <strong>{{ $success }}</strong> </span>
                        </div>
                    @endif

                    <h2 class="card-title font-weight-bold mb-1">Reset Password 🔒</h2>
                    <p class="card-text mb-2">Your new password must be different from previously used passwords</p>
                    <span class="text-danger error-text token_validate_error"></span>
                    <form class="auth-reset-password-form mt-2" action="/auth/login-v2" method="POST">
                        <input class="hidden" name="email" value="{{$email}}">
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="reset-password-new">Otp</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="token_code" type="text"
                                       name="token_code"
                                       aria-describedby="reset-password-new" autofocus="" tabindex="1"/>
                            </div>
                            <span class="text-danger error-text token_code_err"></span>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="new_password">New Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="new_password" type="password"
                                       name="new_password" placeholder="············"
                                       aria-describedby="new_password" autofocus="" tabindex="1"/>
                                <div class="input-group-append">
                                  <span class="input-group-text cursor-pointer">
                                    <i data-feather="eye"></i>
                                  </span>
                                </div>
                            </div>
                            <span class="text-danger error-text new_password_err"></span>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="reset-password-confirm">Confirm Password</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control form-control-merge" id="password_confirmation"
                                       type="password" name="password_confirmation" placeholder="············"
                                       aria-describedby="password_confirmation" tabindex="2"/>
                                <div class="input-group-append">
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>
                            </div>
                            <span class="text-danger error-text password_confirmation_err"></span>
                        </div>
                        <button class="btn btn-primary btn-block reset-password-btn" tabindex="3">Set New Password</button>
                    </form>
                    <p class="text-center mt-2">
                        <a href="{{route('admin-login-view')}}">
                            <i data-feather="chevron-left"></i> Back to login
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Reset password-->
        </div>
    </div>
@endsection

@section('page-script')
     <script src="{{asset(mix('js/scripts/pages/admin-auth-reset-password/admin-auth-reset-password.js'))}}"></script>
@endsection
