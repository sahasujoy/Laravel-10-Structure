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

        .card-datatable td .avatar {
            background-color: #f8f8f8;
            margin-right: 2rem;
        }
    </style>
    <style>
        .unclebigbay__article{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            gap: 30px;
        }

        #shareCaption{
            padding: 10px;
            min-width: 300px;
            min-height: 100px;
            text-align: center;
        }

        .btn{
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 20px;
            cursor: pointer;
        }

        .copy__btn{
            border: 1px solid rgb(31,65,130);
            transition: 0.3s ease;
        }

        .copy__btn:hover{
            background: rgba(31,65,130, 0.9);
            color: #FFFFFF;
        }

        .linkedin__btn{
            background: rgb(31,65,130);
            color: #FFFFFF;
        }


        .linkedin__btn:hover{
            background: rgba(31,65,130,0.8);

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
                                <option value="" selected data-name="all user"> All</option>
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

    <!-- Dashboard Starts -->
    <section id="dashboard-ecommerce">
        <div class="row match-height">
            <div class="col-lg-12 col-12">
                <div class="row match-height">
                    <!-- Total Image -->
                    <div class="col-lg-4 col-md-3 col-6">
                        <a href="{{route('admin-user-view')}}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="avatar bg-light-primary mr-2">
                                            <div class="avatar-content">
                                                <i data-feather="user" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="media-body my-auto">
                                            <h4 class="font-weight-bolder mb-0 total_user">0</h4>
                                            <p class="card-text font-small-3 mb-0"> Total user </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!--/ Total Image -->

                    <!-- Total user Image -->
                    <div class="col-lg-4 col-md-3 col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar bg-light-info mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="server" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0 total_project">0</h4>
                                        <p class="card-text font-small-3 mb-0"> Total project </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Total user -->

                    <!-- Total notification  -->
                    <div class="col-lg-4 col-md-6 col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar bg-light-primary mr-2">
                                        <div class="avatar-content">
                                            <i data-feather="bell" class="avatar-icon"></i>
                                        </div>
                                    </div>
                                    <div class="media-body my-auto">
                                        <h4 class="font-weight-bolder mb-0 total_notification">0</h4>
                                        <p class="card-text font-small-3 mb-0">Total notification</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total notification -->
                </div>
            </div>
        </div>

    </section>
    <!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-script')

@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/admin-dashboard/admin-dashboard.js')) }}"></script>
@endsection
