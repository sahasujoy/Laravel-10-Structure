@extends('admin/layouts/adminContentLayoutMaster')

@section('title', $pageConfigs['title'])

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection

@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/admin-dashboard.css')) }}">

    <style>
        .card.earnings-card .earnings-card-row {
            flex-direction: column;
        }

        .card.earnings-card .earnings-card-row .earnings-card-col {
            flex: 100%;
            max-width: 100%;
        }

        @media(max-width: 1400px) {

            div#goal-overview-radial-bar-chart-daily svg,
            div#goal-overview-radial-bar-chart-daily .apexcharts-canvas{
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
    <!-- Dashboard Starts -->
    <section id="dashboard-ecommerce">
        <input class="hidden app_id" type="text" value="{{$appId}}">
        <div class="row match-height">
            <div class="col-lg-12 col-12">
                <div class="row match-height">
                    <!-- Total Subscriptions -->
                    <div class="col-lg-6 col-md-3 col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar bg-light-primary mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="user-plus" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0 total_subscription">0</h4>
                                        <p class="card-text font-small-3 mb-0"> Total Subscriptions </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Total Subscriptions -->

                    <!-- Total active Subscriptions -->
                    <div class="col-lg-6 col-md-3 col-6">
                        <div class="card">

                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar bg-light-info mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="user-check" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0 total_active_subscription">0</h4>
                                        <p class="card-text font-small-3 mb-0"> Total Active Subscriptions </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Total active Subscriptions -->
                </div>
            </div>
        </div>
    </section>
    <!-- Dashboard Ecommerce ends -->

    <!--Start graph report -->
    <section id="subscription-graph-chart">
        <div class="card">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Apps Dashboard</h4>
                        <!-- Filter Section Starts -->
                        <div>
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
                        <!-- Filter Section Ends -->
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-start mb-3">

                        </div>
                        <div id="app-dashboard-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End graph report -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/web-app-dashboard/web-app-dashboard.js')) }}"></script>
@endsection
