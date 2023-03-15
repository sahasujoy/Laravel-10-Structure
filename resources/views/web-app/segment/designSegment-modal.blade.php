@extends('user.layouts/userContentLayoutMaster')

@section('title', 'Segment')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection
@section('page-style')
    {{-- Page css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/user-dashboard.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">

    {{--    b4 --}}
    {{--    <link--}}
    {{--        rel="stylesheet"--}}
    {{--        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"--}}
    {{--        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"--}}
    {{--        crossorigin="anonymous"--}}
    {{--    />--}}

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
    <!-- End App Dashboard Navbar -->

    <button
        type="button"
        class="btn btn-outline-primary waves-effect"
        data-toggle="modal"
        data-target="#exampleModalScrollable"
    >
        Scrolling Content Inside Modal
    </button>

    <div
        class="modal fade"
        id="exampleModalScrollable"
        tabindex="-1"
        aria-labelledby="exampleModalScrollableTitle"
        style="display: none"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg  modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <!-- <h1> Implement Done</h1> -->
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalScrollableTitle ">
                        Segment Editor
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <!-- <h1>Implement Done</h1> -->

                <div class="modal-body">
                    <!-- <h1>JFSS</h1> -->
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <form action="">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"
                                    >Name of segment <span class="text-danger">*</span></label
                                    >
                                    <input
                                        type="email"
                                        class="form-control"
                                        id="exampleInputEmail1"
                                        aria-describedby="emailHelp"
                                        placeholder="Enter email"
                                    />
                                </div>
                            </form>
                        </div>
                        <!-- end col  -->
                        <div class="col-lg-6 col-sm-12">
                            <div class="pr-2 text-right">
                                <p class="text-dark">Total subscriptions (estimate)</p>
                                <h3 class="text-dark">Pending</h3>
                            </div>
                        </div>
                        <!-- end col  -->
                        <p class="pl-2">Users in this segment must meet these rules:</p>
                    </div>
                    <!-- end row  -->

                    <!-- start input  -->
                    <div class="row segment_filter_input">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center bg-light segement-accordion-header-inner segement-accordion-item mb-2" onclick="showAccordion()">
                                <div class="segement-accordion-bg p-1 rounded-left w-25 d-flex align-items-center">
                                    <div class="pr-2">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            fill="currentColor"
                                            class="bi bi-box-arrow-left"
                                            viewBox="0 0 16 16"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"
                                            />
                                        </svg>
                                    </div>
                                    First Section
                                </div>
                                <div class="d-flex align-items-center justify-content-between w-75 px-2">
                                    <form class="w-100">
                                        <div class="row no-gutters equal-section-row">
                                            <div class="col">
                                                <!-- <input type="text" class="form-control" placeholder="First name"> -->
                                                <select
                                                    class="form-control"
                                                    id="exampleFormControlSelect1"
                                                >
                                                    <option>less than</option>
                                                    <option>greater than</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    placeholder="0"
                                                />
                                            </div>
                                            <div class="col d-flex justify-content-between align-items-center">
                                                <p>hours ago</p>
                                                <button type="button" class="close" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End input  -->

                    <!-- Start Accordion  -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="segement-accordion-wrapper">
                                <div class="segement-inner">
                                    <div
                                        class="d-flex align-items-center bg-light segement-accordion-header-inner segement-accordion-item mb-2"
                                        onclick="showAccordion()"
                                    >
                                        <div
                                            class="segement-accordion-bg p-1 rounded-left w-25 d-flex align-items-center d-flex align-items-center"
                                        >
                                            <div class="pr-2">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-box-arrow-left"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"
                                                    />
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"
                                                    />
                                                </svg>
                                            </div>

                                            First Section
                                        </div>
                                        <div
                                            class="d-flex align-items-center justify-content-between w-75 px-2"
                                        >
                                            <div class="pr-2">Lorem ipsum dolor sit amet.</div>
                                            <div class="pr-2">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-plus-lg"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"
                                                    />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end segement-accordion-item mb-2   -->
                                    <div
                                        class="d-flex align-items-center bg-light segement-accordion-header-inner segement-accordion-item mb-2"
                                    >
                                        <div
                                            class="segement-accordion-bg p-1 rounded-left w-25 d-flex align-items-center"
                                        >
                                            <div class="pr-2">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-box-arrow-left"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"
                                                    />
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"
                                                    />
                                                </svg>
                                            </div>
                                            App Version
                                        </div>
                                        <div
                                            class="d-flex align-items-center justify-content-between w-75 px-2"
                                        >
                                            <div class="pr-2">Version of your app</div>
                                            <div class="pr-2">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-plus-lg"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"
                                                    />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end segement-accordion-item mb-2   -->
                                    <div
                                        class="d-flex align-items-center bg-light segement-accordion-header-inner segement-accordion-item mb-2"
                                    >
                                        <div
                                            class="segement-accordion-bg p-1 rounded-left w-25 d-flex align-items-center"
                                        >
                                            <div class="pr-2">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-box-arrow-left"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"
                                                    />
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"
                                                    />
                                                </svg>
                                            </div>
                                            Device Type
                                        </div>
                                        <div
                                            class="d-flex align-items-center justify-content-between w-75 px-2"
                                        >
                                            <div class="pr-2">Device operating system</div>
                                            <div class="pr-2">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-plus-lg"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"
                                                    />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end segement-accordion-item mb-2   -->
                                    <div
                                        class="d-flex align-items-center bg-light segement-accordion-header-inner segement-accordion-item mb-2"
                                    >
                                        <div
                                            class="segement-accordion-bg p-1 rounded-left w-25 d-flex align-items-center"
                                        >
                                            <div class="pr-2">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-box-arrow-left"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"
                                                    />
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"
                                                    />
                                                </svg>
                                            </div>
                                            Email
                                        </div>
                                        <div
                                            class="d-flex align-items-center justify-content-between w-75 px-2"
                                        >
                                            <div class="pr-2">
                                                Email address of user, used for device matching
                                            </div>
                                            <div class="pr-2">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="currentColor"
                                                    class="bi bi-plus-lg"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"
                                                    />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end segement-accordion-item mb-2   -->
                                </div>
                                <!-- end segement-inner  -->

                                <div class="item-content">
                                    <!-- end segement-accordion-item  -->
                                    <!-- Start And Btn  -->
                                    <div
                                        class="d-flex align-items-center bg-light segement-accordion-header-inner segement-accordion-item mb-2 justify-content-between"
                                        onclick="showAccordion()"
                                    >
                                        <div
                                            class="segement-accordion-bg p-1 rounded-left w-25 d-flex align-items-center"
                                        >
                                            <div class="pr-2">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="rgb(67, 70, 206)"
                                                    class="bi bi-plus-circle-fill"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"
                                                    />
                                                </svg>
                                            </div>
                                            Add Filter
                                        </div>
                                        <div class="pr-2 pr-2 text-dark font-weight-bold">
                                            <!-- <div class="form-group">
                                            <select class="form-control" id="exampleFormControlSelect1">
                                              <option>less than</option>
                                              <option>greater than</option>
                                            </select>
                                          </div> -->
                                            0 users for this filter.
                                        </div>
                                    </div>
                                    <!-- end segement-accordion-item  -->

                                    <!-- Start OR Btn  -->
                                    <div
                                        class="d-flex align-items-center bg-light segement-accordion-header-inner segement-accordion-item mb-2 justify-content-between"
                                        onclick="showAccordion()"
                                    >
                                        <div
                                            class="segement-accordion-bg p-1 rounded-left w-25 d-flex align-items-center"
                                        >
                                            <div class="pr-2">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    fill="rgb(67, 70, 206)"
                                                    class="bi bi-plus-circle-fill"
                                                    viewBox="0 0 16 16"
                                                >
                                                    <path
                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"
                                                    />
                                                </svg>
                                            </div>
                                            Add OR
                                        </div>
                                        <!-- <div class="  pr-2 pr-2 text-dark font-weight-bold">
                                        0 users for this filter.
                                  </div> -->
                                    </div>
                                    <!-- end segement-accordion-item  -->

                                    <!-- OR Header Start  -->

                                    <div
                                        class="or-header d-flex justify-content-start align-items-center"
                                    >
                                        <h5
                                            class="bg-light text-dark font-weight-bold text-center p-1 w-10 rounded mr-2"
                                        >
                                            OR
                                        </h5>
                                        <div class="border-dot w-100 pr-2"></div>
                                    </div>

                                    <!-- OR Header End  -->
                                </div>

                            </div>

                            <div class="and-wrapper mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div
                                            class="and-inner d-flex justify-content-between align-items-center mb-4"
                                        >
                                            <h5>And Filter</h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <!-- end and-inner  -->
                                        <div
                                            class="d-flex align-items-center bg-light segement-accordion-header-inner segement-accordion-item mb-2"
                                            onclick="showAccordion()"
                                        >
                                            <div
                                                class="segement-accordion-bg p-1 rounded-left w-25 d-flex align-items-center d-flex align-items-center"
                                            >
                                                <div class="pr-2">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-box-arrow-left"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"
                                                        />
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"
                                                        />
                                                    </svg>
                                                </div>

                                                First Section
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-between w-75 px-2"
                                            >
                                                <div class="pr-2">Lorem ipsum dolor sit amet.</div>
                                                <div class="pr-2">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-plus-lg"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"
                                                        />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end item  -->
                                        <div
                                            class="d-flex align-items-center bg-light segement-accordion-header-inner segement-accordion-item mb-2"
                                            onclick="showAccordion()"
                                        >
                                            <div
                                                class="segement-accordion-bg p-1 rounded-left w-25 d-flex align-items-center d-flex align-items-center"
                                            >
                                                <div class="pr-2">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-box-arrow-left"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"
                                                        />
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"
                                                        />
                                                    </svg>
                                                </div>

                                                First Section
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-between w-75 px-2"
                                            >
                                                <div class="pr-2">Lorem ipsum dolor sit amet.</div>
                                                <div class="pr-2">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-plus-lg"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"
                                                        />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end item  -->
                                    </div>
                                </div>
                            </div>
                            <!-- end and-wrapper  -->

                            <div class="or-wrapper mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div
                                            class="and-inner d-flex justify-content-between align-items-center mb-4"
                                        >
                                            <h5>OR Filter</h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <!-- end and-inner  -->
                                        <div
                                            class="d-flex align-items-center bg-light segement-accordion-header-inner segement-accordion-item mb-2"
                                            onclick="showAccordion()"
                                        >
                                            <div
                                                class="segement-accordion-bg p-1 rounded-left w-25 d-flex align-items-center d-flex align-items-center"
                                            >
                                                <div class="pr-2">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-box-arrow-left"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"
                                                        />
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"
                                                        />
                                                    </svg>
                                                </div>

                                                First Section
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-between w-75 px-2"
                                            >
                                                <div class="pr-2">Lorem ipsum dolor sit amet.</div>
                                                <div class="pr-2">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-plus-lg"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"
                                                        />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end item  -->
                                        <div
                                            class="d-flex align-items-center bg-light segement-accordion-header-inner segement-accordion-item mb-2"
                                            onclick="showAccordion()"
                                        >
                                            <div
                                                class="segement-accordion-bg p-1 rounded-left w-25 d-flex align-items-center d-flex align-items-center"
                                            >
                                                <div class="pr-2">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-box-arrow-left"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"
                                                        />
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"
                                                        />
                                                    </svg>
                                                </div>

                                                First Section
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-between w-75 px-2"
                                            >
                                                <div class="pr-2">Lorem ipsum dolor sit amet.</div>
                                                <div class="pr-2">
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="16"
                                                        height="16"
                                                        fill="currentColor"
                                                        class="bi bi-plus-lg"
                                                        viewBox="0 0 16 16"
                                                    >
                                                        <path
                                                            fill-rule="evenodd"
                                                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"
                                                        />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end item  -->
                                    </div>
                                </div>
                            </div>
                            <!-- end or-wrapper  -->
                            <!-- END Accordion  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @endsection

        @section('page-script')
            <script>
                let app_id = '{!! $appId !!}';

            </script>

            <script src="{{ asset(mix('js/scripts/pages/segment/segment-manage.js')) }}"></script>


    {{--    Js --}}
    {{--    <script--}}
    {{--        src="https://code.jquery.com/jquery-3.2.1.slim.min.js"--}}
    {{--        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"--}}
    {{--        crossorigin="anonymous"--}}
    {{--    ></script>--}}
    {{--    <script--}}
    {{--        src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"--}}
    {{--        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"--}}
    {{--        crossorigin="anonymous"--}}
    {{--    ></script>--}}
    {{--    <script--}}
    {{--        src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"--}}
    {{--        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"--}}
    {{--        crossorigin="anonymous"--}}
    {{--    ></script>--}}

@endsection
