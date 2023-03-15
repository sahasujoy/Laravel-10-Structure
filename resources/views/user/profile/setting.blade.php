@extends('user.layouts.userContentLayoutMaster')

@section('title', 'Account Settings')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection


@section('content')
    <!-- account setting page -->
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column nav-left">
                    <!-- general -->
                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            id="account-pill-general"
                            data-toggle="pill"
                            href="#account-vertical-general"
                            aria-expanded="true"
                        >
                            <i data-feather="user" class="font-medium-3 mr-1"></i>
                            <span class="font-weight-bold">General</span>
                        </a>
                    </li>
                    <!-- change password -->
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            id="account-pill-password"
                            data-toggle="pill"
                            href="#account-vertical-password"
                            aria-expanded="false"
                        >
                            <i data-feather="lock" class="font-medium-3 mr-1"></i>
                            <span class="font-weight-bold">Change Password</span>
                        </a>
                    </li>

                </ul>
            </div>
            <!--/ left menu section -->

            <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- general tab -->
                            <div
                                role="tabpanel"
                                class="tab-pane active"
                                id="account-vertical-general"
                                aria-labelledby="account-pill-general"
                                aria-expanded="true"
                            >
                                <!-- header media -->
                                <div class="media">
                                    <a href="javascript:void(0);" class="mr-25">
                                        <img
                                            src="{{$profile_image}}"
                                            id="account-upload-img"
                                            class="rounded mr-50"
                                            alt="profile image"
                                            height="80"
                                            width="80"
                                        />
                                    </a>
                                    <!-- upload and reset button -->
                                    <form method="post" action="" enctype="multipart/form-data" id="myProfileImageform">
                                        @csrf
                                        <div class="media-body mt-75 ml-1">
    {{--                                        <form class="profile-image-upload-form" enctype="multipart/form-data">--}}
                                            <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">
                                                <div style="display:none;" class="spinner-border spinner-border-sm button-loader-image" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Upload</label>
                                            <input type="file" id="account-upload" name="profile_image" class="account-upload" hidden accept="image/*" />
{{--                                            <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button>--}}
                                            <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
    {{--                                        </form>--}}
                                            <span class="text-danger error-text profile_image_err"></span>
                                        </div>
                                    </form>
                                    <!--/ upload and reset button -->
                                </div>
                                <!--/ header media -->

                                <!-- form -->
                                <form class="validate-form mt-2 profile-information-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-username">First Name</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="first-name"
                                                    name="first_name"
                                                    placeholder="Write your first name"
                                                    value="{{isset($userInfo) ? $userInfo->first_name : ""}}"
                                                />
                                                <span class="text-danger error-text first_name_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="last-name">Last Name</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="last-name"
                                                    name="last_name"
                                                    placeholder="Write your last name"
                                                    value="{{isset($userInfo) ? $userInfo->last_name : ""}}"
                                                />
                                                <span class="text-danger error-text last_name_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-e-mail">E-mail</label>
                                                <input
                                                    type="email"
                                                    disabled
                                                    class="form-control"
                                                    id="account-e-mail"
                                                    name="email"
                                                    placeholder="Email"
                                                    value="{{isset($userInfo) ? $userInfo->email : ""}}"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-company">Phone</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="phone"
                                                    name="phone"
                                                    placeholder="Write your phone"
                                                    value="{{isset($userInfo) ? $userInfo->phone : ""}}"
                                                />
                                                <span class="text-danger error-text phone_err"></span>

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-2 mr-1 button-submit">
                                                <div style="display:none;" class="spinner-border spinner-border-sm button-loader" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                            <!--/ general tab -->

                            <!-- change password -->
                            <div
                                class="tab-pane fade"
                                id="account-vertical-password"
                                role="tabpanel"
                                aria-labelledby="account-pill-password"
                                aria-expanded="false"
                            >
                                <!-- form -->
                                <form class="validate-form reset-password-form">

                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-new-password">New Password</label>
                                                <div class="input-group form-password-toggle input-group-merge">
                                                    <input
                                                        type="password"
                                                        id="account-new-password"
                                                        name="new_password"
                                                        class="form-control"
                                                        placeholder="New Password"
                                                    />
                                                    <div class="input-group-append">
                                                        <div class="input-group-text cursor-pointer">
                                                            <i data-feather="eye"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="text-danger error-text new_password_err"></span>

                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-retype-new-password">Retype New Password</label>
                                                <div class="input-group form-password-toggle input-group-merge">
                                                    <input
                                                        type="password"
                                                        class="form-control"
                                                        id="account-retype-new-password"
                                                        name="confirm_password"
                                                        placeholder="Retype New Password"
                                                    />
                                                    <div class="input-group-append">
                                                        <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                                    </div>
                                                </div>
                                                <span class="text-danger error-text confirm_password_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-2 mr-1 button-submit">
                                                <div style="display:none;" class="spinner-border spinner-border-sm button-loader" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                            <!--/ change password -->
                        </div>
                    </div>
                </div>
            </div>
            <!--/ right content section -->
        </div>
    </section>
    <!-- / account setting page -->
@endsection

@section('vendor-script')
    <!-- vendor files -->
    {{-- select2 min js --}}
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    {{--  jQuery Validation JS --}}
    <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/user-profile/profile-settings.js')) }}"></script>

@endsection
