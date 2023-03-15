@extends('admin/layouts/adminContentLayoutMaster')

@section('title', $pageConfigs['title'])

@section('content')

    <!-- account setting page -->
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column nav-left">
                    <!-- Limit Setting -->
                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            id="account-pill-social"
                            data-toggle="pill"
                            href="#account-vertical-social"
                            aria-expanded="false"
                        >
                            <i data-feather="link" class="font-medium-3 mr-1"></i>
                            <span class="font-weight-bold">Limit Setting</span>
                        </a>
                    </li>
                    <!-- End Limit Setting -->

                </ul>
            </div>
            <!--/ left menu section -->

            <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Default Limit Setting -->
                            <div
                                class="tab-pane active"
                                id="account-vertical-social"
                                role="tabpanel"
                                aria-labelledby="account-pill-social"
                                aria-expanded="false"
                            >
                                <!-- form -->
                                <form class="default-limit-setting-form form" >
                                    @csrf
                                    <div class="row">
                                        <!-- Default Limit header -->
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mb-2">
                                                <i data-feather="link" class="font-medium-3"></i>
                                                <h4 class="mb-0 ml-75">Default Limit</h4>
                                            </div>
                                        </div>
                                        <!-- Default limit input -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="daily-limit">Apps Limit</label>
                                                <input
                                                    type="text"
                                                    id="account-twitter"
                                                    class="form-control"
                                                    placeholder="0"
                                                    name="apps_limit"
                                                    value="{{isset($getDefaultLimitData) ? $getDefaultLimitData->apps_limit : 0}}"
                                                />

                                            </div>
                                            <span class="text-danger error-text apps_limit_err"></span>
                                        </div>
                                        <!-- Monthly limit input -->
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-facebook">Monthly Limit<code>(Push Notification Send Monthly Basis)</code></label>
                                                <input type="text" id="account-facebook"
                                                       class="form-control"
                                                       name="monthly_limit"
                                                       value="{{isset($getDefaultLimitData) ? $getDefaultLimitData->monthly_limit : 0}}"
                                                       placeholder="0" />
                                            </div>
                                            <span class="text-danger error-text monthly_limit_err"></span>
                                        </div>

                                        <!-- divider -->
                                        <div class="col-12">
                                            <hr class="my-2" />
                                        </div>

                                        <div class="col-12">
                                            <!-- submit and cancel button -->
                                            <button type="submit" class="btn btn-primary mr-1 mt-1 button-submit">
                                                <div style="display:none;" class="spinner-border spinner-border-sm button-loader" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Update
                                            </button>

                                            <button type="reset" class="btn btn-outline-secondary mt-1">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                            <!--/ End Default Limit Setting -->

                        </div>
                    </div>
                </div>
            </div>
            <!--/ right content section -->
        </div>
    </section>
    <!-- / account setting page -->
@endsection


@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/settings/global-settings.js')) }}"></script>
@endsection
