@extends('user.layouts/userContentLayoutMaster')

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

    <!-- Filter Section Starts -->
    <section id="ecommerce-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="ecommerce-header-items">
                    <div class="result-toggler">
                        <button class="navbar-toggler shop-sidebar-toggler" type="button" data-toggle="collapse">
                            <span class="navbar-toggler-icon d-block d-lg-none"><i data-feather="menu"></i></span>
                        </button>
                    </div>
                    <div class="view-options d-flex">
                        {{-- Date picker --}}
{{--                        <div class="">--}}
{{--                            <input--}}
{{--                                type="text"--}}
{{--                                id="fp-range"--}}
{{--                                name="date_picker"--}}
{{--                                class="form-control flatpickr-range "--}}
{{--                                placeholder="Select Date"--}}
{{--                            />--}}
{{--                        </div>--}}
                        {{-- End Date picker --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Filter Section Ends -->

    <!-- Dashboard Starts -->
    <section id="dashboard-ecommerce">
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
                                            <i data-feather="image" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0 total_delivery">0</h4>
                                        <p class="card-text font-small-3 mb-0"> Delivered </p>
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
                                            <i data-feather="image" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0 total_failed">0</h4>
                                        <p class="card-text font-small-3 mb-0"> Failed </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Total active Subscriptions -->
                </div>
            </div>
        </div>

        <!--Start graph report -->

        <div class="row">
            <!-- Delivery Statistics Donut Chart Starts -->
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Delivery Statistics</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between mt-3 mb-1 border-bottom border-bottom-1 pb-1">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="send" class="font-medium-2 text-primary"></i>
                                        <span class="font-weight-bold ml-75 mr-25">Total Sent</span>
                                    </div>
                                    <div>
                                        <span class="total_sent">0</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mb-1 border-bottom border-bottom-1 pb-1">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="check-circle" class="font-medium-2 text-success"></i>
                                        <span class="font-weight-bold ml-75 mr-25">Delivered</span>
                                    </div>
                                    <div>
                                        <span class=" total_delivery">0</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mb-1 border-bottom border-bottom-1 pb-1">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="alert-circle" class="font-medium-2 text-warning"></i>
                                        <span class="font-weight-bold ml-75 mr-25">Failed (Unsubscribed)</span>
                                    </div>
                                    <div>
                                        <span class="total_failed_unsubscribed">0</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mb-1 border-bottom border-bottom-1 pb-1">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="alert-circle" class="font-medium-2 text-warning"></i>
                                        <span class="font-weight-bold ml-75 mr-25">Failed (Errored)</span>
                                    </div>
                                    <div>
                                        <span class="total_failed_errored">0</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="pie-chart" class="font-medium-2 text-info"></i>
                                        <span class="font-weight-bold ml-75 mr-25">Remaining </span>
                                    </div>
                                    <div>
                                        <span class="total_remaining">0</span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <canvas class="deliveryChart chartjs mt-1" data-height="275"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Delivery Statistics Donut Chart Starts -->

            <!-- Platform Statistics Donut Chart Starts -->
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Platform Statistics </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between mt-3 mb-1 border-bottom border-bottom-1 pb-1">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="send" class="font-medium-2 text-primary"></i>
                                        <span class="font-weight-bold ml-75 mr-25">Total Sent</span>
                                    </div>
                                    <div>
                                        <span class="total_sent">0</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mb-1 border-bottom border-bottom-1 pb-1">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="chrome" class="font-medium-2 text-primary"></i>
                                        <span class="font-weight-bold ml-75 mr-25">Web Push (Chrome)</span>
                                    </div>
                                    <div>
                                        <span class="chrome">0</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mb-1 border-bottom border-bottom-1 pb-1">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="globe" class="font-medium-2 text-primary"></i>
                                        <span class="font-weight-bold ml-75 mr-25">Web Push (Safari)</span>
                                    </div>
                                    <div>
                                        <span class="safari">0</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mb-1 border-bottom border-bottom-1 pb-1">
                                    <div class="d-flex align-items-center">
                                        <i data-feather="globe" class="font-medium-2 text-primary"></i>
                                        <span class="font-weight-bold ml-75 mr-25">Web Push (Firefox)</span>
                                    </div>
                                    <div>
                                        <span class="firefox">0</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <canvas class="platform-chart chartjs mt-1" data-height="275"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Platform Statistics Donut Chart Starts -->

        </div>
        <!--/ End graph report -->

    </section>
    <!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/charts/chart.min.js')) }}"></script>
@endsection

@section('page-script')
    <script>
        let app_id = '{!! $appId !!}';
        let notification_id = '{!! $notificationId !!}';
    </script>
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/notification-report/notification-report.js')) }}"></script>
@endsection
