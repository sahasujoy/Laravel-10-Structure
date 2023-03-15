@extends('admin.layouts.adminContentLayoutMaster')

@section('title', $pageConfigs['title'])

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/user-list.css')) }}">


    <style>
        .jfss-own-card  tr td.sorting_1 {
            vertical-align: top!important;
            padding-top: 30px!important;
        }
    </style>
@endsection

@section('content')
    <!-- users list start -->
    <section class="app-user-list app-user-view">
        <!-- users filter start -->
        <div class="card ">
            <h5 class="card-header">Search Filter</h5>
            <div class="d-flex justify-content-between align-items-center mx-50 row pt-0 pb-2">
                <div class="col-md-6 user_status">

                </div>
                <div class="col-md-6 user_type">

                </div>
            </div>


        </div>
        <!-- users filter end -->
        <!-- list section start -->
        <div class="card jfss-own-card">
            <div class="card-datatable table-responsive pt-0">
                <table class="user-list-table table">
                    <thead class="thead-light">
                    <tr>
                        <th>User Details</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>

            <!-- Add User Modal -->
            <div
                class="modal fade text-left new-user-modal"
                id="inlineForm"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myModalLabel33"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">New User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form class="add-new-user form form-vertical">
                                    @csrf
                                    <input class="form-control hidden" id="type" type="text" name="type" value="1"/>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-icon">First Name</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                data-feather="user"></i></span>
                                                    </div>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        name="first_name"
                                                        placeholder="First Name"
                                                    />
                                                </div>
                                                <span  class="text-danger error-text first_name_err_for_add"></span>
                                            </div>

                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="last-name-icon">Last Name</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                data-feather="user"></i></span>
                                                    </div>
                                                    <input
                                                        type="text"
                                                        id="last-name-icon"
                                                        class="form-control"
                                                        name="last_name"
                                                        placeholder="Last Name"
                                                    />
                                                </div>
                                                <span class="text-danger error-text last_name_err_for_add"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                data-feather="mail"></i></span>
                                                    </div>
                                                    <input
                                                        type="email"
                                                        id="email"
                                                        class="form-control"
                                                        name="email"
                                                        placeholder="Email"
                                                        aria-describedby="email"
                                                    />
                                                </div>

                                                <span class="text-danger error-text email_err_for_add"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="password-icon">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                data-feather="lock"></i></span>
                                                    </div>
                                                    <input
                                                        type="password"
                                                        id="password-icon"
                                                        class="form-control"
                                                        name="password"
                                                        placeholder="Password"
                                                    />
                                                </div>
                                                <span class="text-danger error-text password_err_for_add"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="contact-info-icon">Default Apps Limit</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i data-feather="smartphone"></i></span>
                                                    </div>
                                                    <input
                                                        type="number"
                                                        id="contact-info-icon"
                                                        class="form-control"
                                                        name="apps_limit"
                                                        placeholder="0.0"
                                                        value="{{isset($defaultLimit->apps_limit) ? $defaultLimit->apps_limit : 0}}"
                                                    />
                                                </div>
                                                <span class="text-danger error-text apps_limit_err_for_add"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="contact-info-icon">Default Monthly limit(<code>(Push Notification Send Monthly Basis)</code>)</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i data-feather="smartphone"></i></span>
                                                    </div>
                                                    <input
                                                        type="number"
                                                        id="contact-info-icon"
                                                        class="form-control"
                                                        name="monthly_limit"
                                                        placeholder="0.0"
                                                        value="{{isset($defaultLimit->monthly_limit) ? $defaultLimit->monthly_limit : 0}}"
                                                    />
                                                </div>
                                                <span class="text-danger error-text monthly_limit_err_for_add"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="contact-info-icon">Mobile</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i data-feather="smartphone"></i></span>
                                                    </div>
                                                    <input
                                                        type="number"
                                                        id="contact-info-icon"
                                                        class="form-control"
                                                        name="phone"
                                                        placeholder="Mobile"
                                                    />
                                                </div>
                                                <span class="text-danger error-text phone_err"></span>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mr-1 button-submit">
                                                <div style="display:none;"
                                                     class="spinner-border spinner-border-sm button-loader"
                                                     role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Add Modal -->

            <!-- Edit User Modal -->
            <div
                class="modal fade text-left edit-user-modal"
                id="inlineForm"
                tabindex="-1"
                role="dialog"
                aria-labelledby="edit-user-modal-aria"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="edit-user-modal-aria">Edit User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form class="edit-user-form form form-vertical">
                                    @csrf
                                    <input class="form-control hidden" id="user_id" type="text" name="user_id"
                                           value=""/>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="first-name-icon">First Name</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                data-feather="user"></i></span>
                                                    </div>
                                                    <input
                                                        type="text"
                                                        id="first-name-icon"
                                                        class="form-control"
                                                        name="first_name"
                                                        placeholder="First Name"
                                                    />

                                                </div>
                                                <span class="text-danger error-text first_name_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="last-name-icon">Last Name</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                data-feather="user"></i></span>
                                                    </div>
                                                    <input
                                                        type="text"
                                                        id="last-name-icon"
                                                        class="form-control"
                                                        name="last_name"
                                                        placeholder="Last Name"
                                                    />

                                                </div>
                                                <span class="text-danger error-text last_name_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-icon">Email</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                data-feather="mail"></i></span>
                                                    </div>
                                                    <input
                                                        type="email"
                                                        id="email-id-icon"
                                                        class="form-control"
                                                        name="email"
                                                        placeholder="Email"
                                                        disabled
                                                    />

                                                </div>
                                                <span class="text-danger error-text email_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="contact-info-icon">Mobile</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i data-feather="smartphone"></i></span>
                                                    </div>
                                                    <input
                                                        type="number"
                                                        id="contact-info-icon"
                                                        class="form-control"
                                                        name="phone"
                                                        placeholder="Mobile"
                                                    />

                                                </div>
                                                <span class="text-danger error-text phone_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mr-1 button-submit">
                                                <div style="display:none;"
                                                     class="spinner-border spinner-border-sm button-loader"
                                                     role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Update
                                            </button>
{{--                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>--}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Edit Modal -->

            <!-- Change Password Modal -->
            <div
                class="modal fade text-left change-password-modal"
                id="changePasswordForm"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myModalLabel33"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="change-password-label">Change Password</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form class="change-password-form form form-vertical">
                                    @csrf
                                    <input class="form-control hidden " id="user_id" type="text" name="user_id" value="" />
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-icon">New Password</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                data-feather="lock"></i></span>
                                                    </div>
                                                    <input
                                                        type="password"
                                                        id="password"
                                                        class="form-control"
                                                        name="new_password"
                                                        placeholder="Password"
                                                    />
                                                </div>
                                                <span class="text-danger error-text new_password_err"></span>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-icon">Confirm Password</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                data-feather="lock"></i></span>
                                                    </div>
                                                    <input
                                                        type="password"
                                                        id="password-icon"
                                                        class="form-control"
                                                        name="password_confirmation"
                                                        placeholder="Confirm Password"
                                                    />

                                                </div>
                                                <span
                                                    class="text-danger error-text password_confirmation_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">

                                            <button type="submit" id="chang-password-button" class="btn btn-primary mr-1 button-submit">
                                                <div style="display:none;"
                                                     class="spinner-border spinner-border-sm button-loader"
                                                     role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Update
                                            </button>

                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Change Password Modal -->

            <!-- Limit Allocate Modal -->
            <div
                class="modal fade text-left limit-allocation-modal"
                id="limitAllocateForm"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myModalLabel33"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="change-password-label">Limit allocation</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form class="limit-allocation-form form form-vertical">
                                    @csrf
                                    <input class="form-control hidden" id="user_id" type="text" name="user_id"
                                           value=""/>
                                    <input class="form-control hidden" type="text" name="type" value="2"/>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-icon">App(Limit)</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                data-feather="credit-card"></i></span>
                                                    </div>
                                                    <input
                                                        type="text"
                                                        id="apps-limit"
                                                        class="form-control"
                                                        name="apps_limit"
                                                        placeholder="00"
                                                        value=""
                                                    />

                                                </div>
                                                <span class="text-danger error-text apps_limit_err"></span>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password-icon">Monthly Notification<code>(Push Notification Send Monthly Basis)</code></label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                data-feather="credit-card"></i></span>
                                                    </div>
                                                    <input
                                                        type="text"
                                                        id="monthly-limit"
                                                        class="form-control"
                                                        name="monthly_limit"
                                                        placeholder="00"
                                                        value=""
                                                    />

                                                </div>
                                                <span class="text-danger error-text monthly_limit_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mr-1 button-submit">
                                                <div style="display:none;"
                                                     class="spinner-border spinner-border-sm button-loader"
                                                     role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Update
                                            </button>
{{--                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>--}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Limit Allocate Modal -->

        </div>
        <!-- list section end -->
    </section>
    <!-- users list ends -->
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/admin-user-manage/user-manage.js')) }}"></script>

@endsection


