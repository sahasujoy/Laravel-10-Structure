@extends('user.layouts/userContentLayoutMaster')

@section('title', 'Delivery Report')

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
            <div class="col-md-12">
                <div class="card-datatable table-responsive pt-0">
                    <table class="report-delivery-table table">
                        <thead class="thead-light">
                        <tr>
                            <th>Message</th>
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



    <script src="{{ asset(mix('js/scripts/pages/report-delivery/report-delivery.js')) }}"></script>

@endsection
