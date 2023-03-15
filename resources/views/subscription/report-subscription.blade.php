@extends('user.layouts/userContentLayoutMaster')

@section('title', 'Subscription Report')

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

    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th> Subscribed </th>
                            <th> Last Active </th>
                            <th> Sessions </th>
                            <th> First Sessions </th>
                            <th> Device </th>
                            <th> Player ID </th>
                            <th> IP Address </th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="device_pagination">

                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->

    @endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>

@endsection
@section('page-script')


<script>
    let app_id = '{!! $appId !!}';
</script>
    <script src="{{ asset(mix('js/scripts/pages/report-subscription/report-subscription.js')) }}"></script>

@endsection
