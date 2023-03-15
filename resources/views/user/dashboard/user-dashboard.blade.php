@extends('user.layouts/userContentLayoutMaster')

@section('title', 'Dashboard')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/user-dashboard.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">

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

    <!-- Dashboard Ecommerce Starts -->
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <div class="col-lg-4 col-12">
                <div class="row match-height">
                    <!-- Total Image  -->
                    <div class="col-lg-6 col-md-3 col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar bg-light-primary mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="user" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0 total_image_top"></h4>
                                        <p class="card-text font-small-3 mb-0">Total image process</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Image -->

                    <!-- Total not clean Image -->
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
                                        <h4 class="font-weight-bolder mb-0 total_clean_image_top"></h4>
                                        <p class="card-text font-small-3 mb-0"> Total image cleaned</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Total not clean Image -->

                    <!-- Image process Card -->
                    <div class="col-lg-12 col-md-6 col-12">
                        <div class="card earnings-card">
                            <div class="card-body">
                                <div class="row earnings-card-row">
                                    <div class="col-md-4 earnings-card-col">
                                        <h4 class="card-title mb-1">Process image vs Cleaned image</h4>
                                        <div class="font-small-2"> Processed Image </div>
                                        <h5 class="mb-1" id="total_image_process"> 0 </h5>
                                        <p class="card-text text-muted font-small-2">
                                            <span class="font-weight-bolder" id="total_image_process_percentage"> 0 </span><span>% has been cleaned.</span>
                                        </p>
                                    </div>
                                    <div class="col-md-8 earnings-card-col">
                                        <div class="p-2">
                                            <div class="card">
                                                <div class="card-body p-2">
                                                    <div id="goal-overview-radial-bar-chart-daily" class="my-2"></div>
                                                    <div class="row border-top text-center mx-0">
                                                        <div class="col-6 border-right py-1">
                                                            <p class="card-text text-muted mb-0">Process Image</p>
                                                            <h3 class="font-weight-bolder mb-0 process_image">0</h3>
                                                        </div>
                                                        <div class="col-6 py-1">
                                                            <p class="card-text text-muted mb-0">Clean Image</p>
                                                            <h3 class="font-weight-bolder mb-0 clean_image">0</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="earnings-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Image process report</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-start mb-3">

                        </div>
                        <div id="revenue-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>

@endsection
@section('page-script')
    {{-- Page js files --}}
{{--    <script src="{{ asset(mix('js/scripts/pages/user-dashboard.js')) }}"></script>--}}
@endsection
