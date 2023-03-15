@extends('admin/layouts/adminContentLayoutMaster')

@section('title', $pageConfigs['title'])

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
                        <p class="text-left">
                            State counts report for <code id="filter_user_label">all users</code>, with the search date
                            being <code id="filter_date_label">the previous 7 days</code>.
                        </p>
                    </div>
                    <div class="view-options d-flex">
                        {{-- User list dropdown --}}
                        <div class="mr-1">
                            <select class="form-control user_list" name="user_list">
                                <option value="" selected data-name="all user"> All </option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" data-name="{{$user->first_name }}">
                                        {{$user->first_name .' '. $user->last_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
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

    <!-- Report Starts -->
    <section id="dashboard-ecommerce">

        <!-- App / project list section start -->
        <div class="card">
            <div class="card-datatable table-responsive p-1">
                <table class="project-count-table table">
                    <thead class="thead-light">
                    <tr>
                        <th>User</th>
                        <th>Total Project</th>
                        <th>Total Notification</th>
                        <th>Total Subscription</th>
                        <th>Total Active Subscription</th>
                    </tr>
                    </thead>
                </table>
            </div>

        </div>
        <!-- App / project list section end -->

    </section>
    <!-- Report ends -->
@endsection

@section('vendor-script')

@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/admin-project-count/admin-project-count.js')) }}"></script>
@endsection
