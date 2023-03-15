@extends('user.layouts/userContentLayoutMaster')

@section('title', $pageConfigs['title'])

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/user-dashboard.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">

@endsection

@section('content')

    <!-- Start App Dashboard Navbar -->
    @include('panels/appDashboardNavbar')
    <!-- End App Dashboard Navbar -->

    <section class="app-user-list">
        <div class="card">
            <div class="card-body">
               <div class="row d-flex justify-content-center align-items-center flex-wrap">
                   <div class="col-lg-4 col-sm-12">
                       <ul class="nav nav-tabs" role="tablist">
                           <li class="nav-item">
                               <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all" aria-controls="all" role="tab" aria-selected="true">All</a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" id="profile-tab" data-toggle="tab" href="#sent" aria-controls="sent" role="tab" aria-selected="false">Sent</a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" id="about-tab" data-toggle="tab" href="#schedule" aria-controls="schedule" role="tab" aria-selected="false">Schedule</a>
                           </li>
                       </ul>
                   </div>
                   <div class="col-lg-4 col-sm-12">
                       <div class="alert alert-danger mt-1 alert-validation-msg" style="font-size: 11px" role="alert">
                           <div class="alert-body">
                               <i class="" data-feather="alert-triangle"></i>
                               <span>  It takes up 3-5 minutes to start processing broadcast.</span>
                           </div>
                       </div>
                   </div>
                   <div class="col-4"></div>
                   </div>
               </div>

{{--            end div --}}
            <div class="tab-content">
                <div class="tab-pane active" id="all" aria-labelledby="all-tab" role="tabpanel">
                    <div class="col-md-12">
                        <div class="card-datatable table-responsive pt-0">
                            <table class="report-delivery-table table">
                                <thead class="thead-light">
                                <tr>
                                    <th>Message</th>
                                    <th>Segment Type</th>
                                    <th>Status</th>
                                    <th>Sent At</th>
                                    <th>Delivery(%)</th>
                                    <th>Sent</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="sent" aria-labelledby="sent-tab" role="tabpanel">
                    <div class="col-md-12">
                        <div class="card-datatable table-responsive pt-0">
                            <table class="sent-report-delivery-table table">
                                <thead class="thead-light">
                                <tr>
                                    <th>Message</th>
                                    <th>Segment Type</th>
                                    <th>Status</th>
                                    <th>Sent At</th>
                                    <th>Delivery(%)</th>
                                    <th>Sent</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="schedule" aria-labelledby="schedule-tab" role="tabpanel">
                    <div class="col-md-12">
                        <div class="card-datatable table-responsive pt-0">
                            <table class="schedule-report-delivery-table table">
                                <thead class="thead-light">
                                <tr>
                                    <th>Message</th>
                                    <th>Segment Type</th>
                                    <th>Status</th>
                                    <th>Sent At</th>
                                    <th>Delivery(%)</th>
                                    <th>Sent</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>

@endsection
@section('page-script')
    <script>
        let app_id = '{!! $appId !!}';
    </script>

    <script src="{{ asset(mix('js/scripts/pages/broadcast/broadcast.js')) }}"></script>

@endsection
