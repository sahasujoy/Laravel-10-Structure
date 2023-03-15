@extends('user.layouts/userContentLayoutMaster')

@section('title', 'Segment')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/user-dashboard.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">


    <style>
        .segement-accordion-bg {
            background: rgb(229, 232, 235);
        }

        .segement-accordion-item {
            transition: 0.3s all ease-in;
        }

        .segement-accordion-item:hover {
            background: rgb(229, 232, 235) !important;
        }

        .equal-section-row {
            gap: 10px;
        }

        .border-dot {
            border: 1px dashed rgb(185, 194, 202);
        }

        .and-wrapper .card,
        .or-wrapper .card {
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .modal-footer .btn {
            background: rgb(67, 70, 206);
            color: #fff;
        }
    </style>
@endsection

@section('content')

    <!-- Start App Dashboard Navbar -->
    @include('panels/appDashboardNavbar')
    <!-- End App Dashboard Navbar -->

    <section class="app-user-list">
        <div class="card">
            <div class="col-md-12">
                <div class="card-datatable table-responsive pt-0">
                    <table class="segment-table table">
                        <thead class="thead-light">
                        <tr>
                            <th>Segment name</th>
                            <th>Filter</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>

    @include('.web-app.segment.segment-modal')

@endsection

@section('page-script')
    <script>
        let app_id = '{!! $appId !!}';

    </script>

    <script src="{{ asset(mix('js/scripts/pages/segment/segment-manage.js')) }}"></script>

@endsection
