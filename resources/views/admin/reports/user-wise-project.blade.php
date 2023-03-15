@extends('admin/layouts/adminContentLayoutMaster')

@section('title', $pageConfigs['title'])

@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/user-list.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/admin-dashboard.css')) }}">

    <style>
        .card.earnings-card .earnings-card-row {
            flex-direction: column;
        }

        .card.earnings-card .earnings-card-row .earnings-card-col {
            flex: 100%;
            max-width: 100%;
        }

        @media (max-width: 1400px) {

            div#goal-overview-radial-bar-chart-daily svg,
            div#goal-overview-radial-bar-chart-daily .apexcharts-canvas {
                width: 100% !important;
            }

            .earnings-card-col + .earnings-card-col .p-2 {
                padding: 0 !important;
            }

            .apexcharts-datalabels-group text {
                font-size: 30px;
            }

        }
    </style>
@endsection

@section('content')

    <!-- Filter Section Starts -->
    <section id="ecommerce-header">
        <div class="row">
            <div class="col-sm-12">
                <input class="hidden user_wise_id" value="{{$user->id}}">
                <div class="ecommerce-header-items">
                    <div class="result-toggler">
                        <button class="navbar-toggler shop-sidebar-toggler" type="button" data-toggle="collapse">
                            <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                        </button>
                        <p class="text-left">
                            State counts report with the search date
                            being <code id="filter_date_label">the previous 7 days</code>.
                        </p>
                    </div>
                    <div class="view-options d-flex">

                        {{-- Date picker --}}
                        <div class="">
                            <input
                                type="text"
                                id="fp-range"
                                name="date_picker"
                                class="form-control flatpickr-range "
                                placeholder="Select Date"
                            />
                        </div>
                        {{-- End Date picker --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Filter Section Ends -->

    <section class="app-user-view">
        <!-- User Card & Plan Starts -->
        <div class="row">
            <!-- User Card starts-->
            <div class="col-xl-12 col-lg-8 col-md-7">
                <div class="card user-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                <div class="user-avatar-section">
                                    <div class="d-flex justify-content-start">
                                        @if(!is_null($user->avatar) and !empty($user->avatar))
                                            <img class="round" src="{{ $user->avatar }}" alt="avatar"
                                                 height="40"
                                                 width="40">
                                        @else
                                            <img class="round" src="{{asset('images/portrait/small/avatar-s-11.jpg')}}"
                                                 alt="avatar" height="40"
                                                 width="40">
                                        @endif

                                        <div class="d-flex flex-column ml-1">
                                            <div class="user-info mb-1">
                                                <h4 class="mb-0"> {{ $user->first_name .' '. $user->last_name}} </h4>
                                                <span class="card-text"> {{ $user->email }} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                                <div class="user-info-wrapper">

                                    <div class="d-flex flex-wrap my-50">
                                        <div class="user-info-title">
                                            <i data-feather="check" class="mr-1"></i>
                                            <span class="card-text user-info-title font-weight-bold mb-0">Status</span>
                                        </div>
                                        <p class="card-text mb-0">{{ $user->status == 1 ?  'Active' : 'Inactive'}}</p>
                                    </div>

                                    <div class="d-flex flex-wrap my-50">
                                        <div class="user-info-title">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check mr-1"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                            <span class="card-text user-info-title font-weight-bold mb-0">Create by</span>
                                        </div>
                                        <p class="card-text mb-0"> {{ $user->type == 1 ?  'Registration' : 'Admin'}} </p>
                                    </div>

                                    <div class="d-flex flex-wrap">
                                        <div class="user-info-title">
                                            <i data-feather="phone" class="mr-1"></i>
                                            <span class="card-text user-info-title font-weight-bold mb-0">Contact</span>
                                        </div>
                                        <p class="card-text mb-0"> {{ $user->phone }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /User Card Ends-->
        </div>
        <!-- User Card & Plan Ends -->
    </section>

    <section>
        <!-- App / project list section start -->
        <div class="card">
            <div class="card-datatable table-responsive p-1">
                <table class="apps-list-table table">
                    <thead class="thead-light">
                    <tr>
                        <th>Web App Name</th>
                        <th>Total subscription</th>
                        <th>Total active subscription</th>
                        <th>status</th>
                        <th>action</th>
                    </tr>
                    </thead>
                </table>
            </div>

        </div>

    </section>
@endsection

@section('vendor-script')

@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/user-wise-project/user-wise-project.js')) }}"></script>
@endsection
