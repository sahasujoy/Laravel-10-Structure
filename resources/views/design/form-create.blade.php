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
        .light-gray-bg {
            background: #f1f2f6;
        }


        label {
            color: #222222;
            font-weight: 600;
        }

        .switch-inner .card-header {
            background: #dfe4ea;
        }

        .switch-inner .card-body {
            background: #f1f2f6;
        }

        .switch-header-inner {
            margin-bottom: 0;
        }


        .content-header h3 {
            color: #000;
            font-weight: 600;
        }

        .document-content .title {
            color: #000;
            font-weight: 600;
        }

        .custom-switch .custom-control-label::before {
            background: #b4b7bd;
        }

        .label-choose-text {
            position: absolute;
            color: #000000;
            right: 8%;
            font-weight: 800;
        }

        .title-inner-icon .title-svg, .message-inner-icon .message-svg {
            position: relative;
        }

        .title-inner-icon .title-svg {
            position: absolute;
            color: red;
            right: 5%;
            top: 29%;
            font-weight: 800;
        }

        .message-inner-icon .message-svg {
            position: absolute;
            color: #000000;
            right: 5%;
            bottom: 25%;
            font-weight: 800;
        }

        /* .message-inner-icon span{
          position: absolute;
          right:5%;
            bottom:10%;
        } */
        .document-icon span svg {
            width: 56px;
            height: 56px;
        }

        .content-text {
            font-size: 16px;
            line-height: 1.48;
            color: #000;
        }

        .content-text span {
            font-weight: 600;
            color: #000;
        }

        .contet-headers {
            font-size: 18px;
            font-weight: 600;
            color: #222;
            text-transform: capitalize;
        }

        .document-icon {
            color: #7367f0;;
        }


        .web-image-inner {
            width: 100%;
            background: url('https://i.ibb.co/xjXz51d/web.jpg');
            height: 70vh;
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        .web-img-icon img {
            width: 56px;
            height: 56px;
            margin-right: 15px;
            border-radius: 50%;
        }

        .top-left-inner .top-left {
            position: absolute;
            top: 25%;
            left: 10%;
        }

        .top-right-inner .top-right {
            position: absolute;
            top: 25%;
            right: 10%;
        }

        .top-center-inner .top-center {
            position: absolute;
            top: 25%;
            right: 50%;
        }

        .bottom-left-inner .bottom-left {
            position: absolute;
            bottom: 15%;
            left: 10%;
        }

        .bottom-right-inner .bottom-right {
            position: absolute;
            bottom: 15%;
            right: 10%;
        }
    </style>
@endsection

@section('content')
    <!-- Start main -->
    <main>
        <section class="site-setup-section">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7 col-sm-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Name of your App or Website</label>
                                                <input type="text" class="form-control" name="fname"
                                                       placeholder="Name of your App or Website"/>
                                            </div>
                                            <!-- end form-grp  -->

                                            <div class="site-wrapper">
                                                <div class="header mb-2">
                                                    <h4>Site Setup</h4>
                                                </div>
                                                <div class="card light-gray-bg">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4 col-form-label">
                                                                        <label for="first-name">SITE NAME</label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control"
                                                                               name="fname" placeholder="Site Name"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end col  -->
                                                            <div class="col-12">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4 col-form-label">
                                                                        <label for="site-url">SITE URL </label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <input type="email" class="form-control"
                                                                               name="site-url" placeholder="Site URL"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end col  -->
                                                            <div class="col-12">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4 col-form-label">
                                                                        <label for="site-url">AUTO RESUBSCRIBE (HTTPS
                                                                            ONLY )
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div
                                                                            class="custom-control custom-control-primary custom-switch d-flex align-items-center">
                                                                            <input type="checkbox" checked=""
                                                                                   class="custom-control-input"
                                                                                   id="customSwitch3"/>
                                                                            <label class="custom-control-label"
                                                                                   for="customSwitch3"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end col  -->
                                                            <div class="col-12">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4 col-form-label">
                                                                        <label for="site-url">DEFAULT ICON URL</label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input"
                                                                                   id="customFile"/>
                                                                            <label class="custom-file-label"
                                                                                   for="customFile">Choose file</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end form grp  -->
                                                                <!-- Start switch header  -->
                                                            </div>
                                                            <!-- end col  -->
                                                        </div>
                                                        <!-- end row  -->
                                                    </div>
                                                    <!-- end card-body  -->
                                                </div>
                                                <!-- end card  -->
                                            </div>
                                            <!-- end site-wrapper  -->
                                            <div class="switch-inner mb-2 light-gray-bg">
                                                <div class="card switch-header-inner">
                                                    <div class="card-header">
                                                        <div
                                                            class="custom-control custom-control-primary custom-switch d-flex justify-center align-items-center">
                                                            <input type="checkbox" checked=""
                                                                   class="custom-control-input" id="customSwitch3"/>
                                                            <label class="custom-control-label" for="customSwitch3">
                                                                MY Site is not fully HTTPS</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <!-- <h5 class="card-title">Special title treatment</h5> -->
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-sm-4 col-form-label">
                                                                <label for="site-url">CHOOSE A LABEL <span>*</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div
                                                                    class="label-inner d-flex align-items-center justify-center">
                                                                    <input type="email" class="form-control"
                                                                           name="site-url" placeholder="Your Label"/>
                                                                    <span class="label-choose-text">.OS.TC</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end switch inner  -->
                                        </div>
                                        <!-- end col  -->
                                        <div class="col-lg-5 col-md-5 col-sm-12">

                                            <div class="setup-content-inner input-content-inner">
                                                <div class="content-header mb-2">
                                                    <h3>HTTP WEB PUSH</h3>
                                                </div>
                                                <p class="content-text mb-2">Lorem ipsum dolor sit amet consectetur
                                                    adipisicing elit. Nesciunt,
                                                    voluptatum <span>HTTP</span> quisquam adipisci est nulla?</p>
                                                <div class="list-inner mb-2">
                                                    <h6>Only select my site is fully HTTPS if your site:</h6>
                                                    <ul>
                                                        <li>Does not Support HTTPS</li>
                                                        <li>Service some pages over HTTPS</li>
                                                        <li>lorem5</li>
                                                    </ul>
                                                </div>
                                                <!-- end list-inner  -->
                                                <p class="content-text mb-2">Lorem, ipsum dolor sit amet consectetur
                                                    adipisicing elit. Est
                                                    officia laboriosam, obcaecati quisquam doloremque maiores.</p>

                                                <div
                                                    class="document-wrapper d-flex justify-content-between align-items-center">
                                                    <div class="document-icon mr-2">
                                                        <span><i data-feather='book'></i></span>
                                                    </div>
                                                    <!-- end document-icon  -->
                                                    <div class="document-content">
                                                        <h5 class="title">READ OUR DOCUMENTATION</h5>
                                                        <p class="content-text">Lorem ipsum dolor sit, amet consectetur
                                                            adipisicing elit. Sint,
                                                            odio.</p>

                                                    </div>
                                                </div>
                                                <!-- end document-wrapper  -->
                                            </div>
                                            <!-- end setup-content  -->
                                        </div>
                                        <!-- end col  -->
                                    </div>
                                    <!-- end row  -->
                                </div>
                                <!-- end card-body  -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-7 col-sm-12">
                                        <div class="header mx-2 mb-2">
                                            <h4>Welcome Notification (Optional)</h4>
                                        </div>
                                        <div class="switch-inner mx-2 mb-3 light-gray-bg">

                                            <div class="card switch-header-inner light-gray-bg">
                                                <div class="card-header">
                                                    <div
                                                        class="custom-control custom-control-primary custom-switch d-flex justify-center align-items-center">
                                                        <input type="checkbox" checked="" class="custom-control-input"
                                                               id="customSwitch3"/>
                                                        <label class="custom-control-label" for="customSwitch3">
                                                            Send welcome notification after subscribing
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 col-form-label">
                                                            <label for="site-url"> TITLE </label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="email" class="form-control" name="site-url"
                                                                   placeholder="My Website"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 col-form-label">
                                                            <label for="site-url"> MESSAGE </label>
                                                        </div>
                                                        <div class="col-sm-8">
                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        placeholder="Thanks for Subscribing!"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-4 col-form-label">
                                                            <label for="site-url">LINK</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div
                                                                class="custom-control custom-control-primary custom-switch d-flex align-items-center">
                                                                <input type="checkbox" checked=""
                                                                       class="custom-control-input" id="customSwitch3"/>
                                                                <label class="custom-control-label" for="customSwitch3">
                                                                    Open link when clicking welcome
                                                                    notification</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col  -->
                                    <div class="col-lg-6 col-md-5 col-sm-12">
                                        <div class="web-img-wrapper light-gray-bg p-2">
                                            <div class="web-image-inner ">
                                                <div class="top-left-inner light-gray-bg ">
                                                    <div class="card light-gray-bg top-left w-75">
                                                        <div class="card-body ">
                                                            <div
                                                                class="web-content-inner d-flex justify-content-center align-items-center">
                                                                <div class="web-img-icon">
                                                                    <img src="https://i.ibb.co/stFStJD/profile.jpg"
                                                                         alt="profile">
                                                                    <!-- <img src="../.../public/images/profile.jpg" alt=""> -->
                                                                </div>
                                                                <div class="web-content">
                                                                    <h4 class="text-dark">Lorem ipsum dolor sit.</h6>
                                                                        <p>Lorem, ipsum dolor sit amet consectetur
                                                                            adipisicing.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end top-left-inner  -->
                                                <!-- <div class="top-right-inner light-gray-bg ">
                                                <div class="card light-gray-bg top-right w-75">
                                                  <div class="card-body">
                                                  <div class="web-content-inner d-flex justify-content-center align-items-center">
                                                      <div class="web-img-icon">
                                                      <img src="https://i.ibb.co/stFStJD/profile.jpg" alt="profile">
                                                      </div>
                                                      <div class="web-content">
                                                        <h4 class="text-dark">Lorem ipsum dolor sit.</h6>
                                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing.</p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                               </div> -->
                                                <!-- end top-right-inner  -->
                                                <!-- end top-center-inner  -->
                                                <!-- <div class="bottom-left-inner light-gray-bg ">
                                                <div class="card light-gray-bg bottom-left w-75">
                                                  <div class="card-body">
                                                  <div class="web-content-inner d-flex justify-content-center align-items-center">
                                                      <div class="web-img-icon">
                                                      <img src="https://i.ibb.co/stFStJD/profile.jpg" alt="profile">
                                                      </div>
                                                      <div class="web-content">
                                                        <h4 class="text-dark">Lorem ipsum dolor sit.</h6>
                                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing.</p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                               </div> -->
                                                <!-- end bottom-left-inner  -->
                                                <!-- <div class="bottom-right-inner light-gray-bg ">
                                                <div class="card light-gray-bg bottom-right w-75">
                                                  <div class="card-body">
                                                  <div class="web-content-inner d-flex justify-content-center align-items-center w-50">
                                                      <div class="web-img-icon">
                                                      <img src="https://i.ibb.co/stFStJD/profile.jpg" alt="profile">
                                                      </div>
                                                      <div class="web-content">
                                                        <h4 class="text-dark">Lorem ipsum dolor sit.</h6>
                                                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing.</p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                               </div> -->
                                                <!-- end bottom-right-inner  -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col  -->
                                </div>
                                <!-- end sw  -->
                                <div class="advance-wrapper mx-2 mb-3">
                                    <div class="header mb-2">
                                        <h4>Advance Push Settings (Optional)</h4>
                                    </div>
                                    <!-- end header  -->
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7 col-sm-12">
                                            <div class="advance-inner">
                                                <div class="card light-gray-bg">
                                                    <div class="card-body">
                                                        <div class="col-12">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 col-form-label">
                                                                    <label for="site-url">WEBHOOKS</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div
                                                                        class="custom-control custom-control-primary custom-switch d-flex align-items-center">
                                                                        <div class="mb-2">
                                                                            <input type="checkbox" checked=""
                                                                                   class="custom-control-input"
                                                                                   id="customSwitch3"/>
                                                                            <label class="custom-control-label"
                                                                                   for="customSwitch3">
                                                                                Enable webhooks</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="basicInput">Ping this URL when a
                                                                            notification is
                                                                            displayed</label>
                                                                        <input type="text" class="form-control"
                                                                               id="basicInput"
                                                                               placeholder="https://example.com/notification-displayed"/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="basicInput">Ping this URL when a
                                                                            notification is
                                                                            clicked</label>
                                                                        <input type="text" class="form-control"
                                                                               id="basicInput"
                                                                               placeholder="https://example.com/notification-clicked"/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="basicInput">Ping this URL when a
                                                                            notification is
                                                                            dismissed</label>
                                                                        <input type="text" class="form-control"
                                                                               id="basicInput"
                                                                               placeholder="https://example.com/notification-dismissed"/>
                                                                    </div>
                                                                    <div class="mb-2">
                                                                        <div
                                                                            class="custom-control custom-control-primary custom-switch d-flex align-items-center">
                                                                            <div class="">
                                                                                <input type="checkbox" checked=""
                                                                                       class="custom-control-input"
                                                                                       id="customSwitch3"/>
                                                                                <label class="custom-control-label"
                                                                                       for="customSwitch3">Enable CORS
                                                                                    request
                                                                                    headers</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end advance-inner  -->
                                            <div class="advance-inner">
                                                <div class="card light-gray-bg">
                                                    <div class="card-body">
                                                        <div class="col-12">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 col-form-label">
                                                                    <label for="site-url">SERVICE WORKERS</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div
                                                                        class="custom-control custom-control-primary custom-switch d-flex align-items-center">
                                                                        <div class="mb-2">
                                                                            <input type="checkbox" checked=""
                                                                                   class="custom-control-input"
                                                                                   id="customSwitch3"/>
                                                                            <label class="custom-control-label"
                                                                                   for="customSwitch3"> Customize
                                                                                service worker
                                                                                paths and filenames</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="basicInput">Path to service worker
                                                                            files</label>
                                                                        <input type="text" class="form-control"
                                                                               id="basicInput" placeholder="/"/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="basicInput">Main service worker
                                                                            filename</label>
                                                                        <input type="text" class="form-control"
                                                                               id="basicInput"
                                                                               placeholder="OneSignalSDKWorker.js"/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="basicInput">Updater service worker
                                                                            filename</label>
                                                                        <input type="text" class="form-control"
                                                                               id="basicInput"
                                                                               placeholder="OneSignalSDKWorker.js"/>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="basicInput">Path to service worker
                                                                            files</label>
                                                                        <input type="text" class="form-control"
                                                                               id="basicInput" placeholder="/"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end advance-inner  -->
                                        </div>
                                        <!-- end col  -->
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <div class="setup-content-inner input-content-inner">
                                                <div class="content-header mb-2">
                                                    <h3>WEBHOOKS</h3>
                                                </div>
                                                <p class="content-text mb-2"><span class="contet-headers">Core Request headers:</span>
                                                    consectetur adipisicing elit. Nesciunt, voluptatum <span>HTTP</span>
                                                    quisquam adipisci est
                                                    nulla?</p>
                                                <p class="content-text mb-2">Lorem, ipsum dolor sit amet consectetur
                                                    adipisicing elit. Est
                                                    officia laboriosam, obcaecati quisquam doloremque maiores.</p>
                                                <div
                                                    class="document-wrapper d-flex justify-content-between align-items-center">
                                                    <div class="document-icon mr-2">
                                                        <span><i data-feather='book'></i></span>
                                                    </div>
                                                    <!-- end document-icon  -->
                                                    <div class="document-content">
                                                        <h5 class="title">READ OUR DOCUMENTATION</h5>
                                                        <p class="content-text">Lorem ipsum dolor sit, amet consectetur
                                                            adipisicing elit. Sint,
                                                            odio.</p>
                                                    </div>
                                                </div>
                                                <!-- end document-wrapper  -->
                                            </div>
                                            <!-- end setup-content  -->
                                        </div>
                                    </div>
                                    <!-- end col  -->
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7 col-sm-12">
                                            <div class="advance-inner">
                                                <div class="card light-gray-bg">
                                                    <div class="card-body">
                                                        <div class="col-12">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 col-form-label">
                                                                    <label for="site-url">CLICK BEHAVIOR</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="form-group">
                                                                        <div class="select-form mb-2">
                                                                            <label for="basicSelect">Matching
                                                                                Strategy</label>
                                                                            <select class="form-control"
                                                                                    id="basicSelect">
                                                                                <option>Open a new windows</option>
                                                                                <option>Open a new tap</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="select-form">
                                                                            <label for="basicSelect">Matching
                                                                                Strategy</label>
                                                                            <select class="form-control"
                                                                                    id="basicSelect">
                                                                                <option>Open a new windows</option>
                                                                                <option>Open a new tap</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end advance-inner  -->
                                            <div class="switch-notification-inner">
                                                <div class="card light-gray-bg">
                                                    <div class="card-body">
                                                        <div class="col-12">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4 col-form-label">
                                                                    <label for="site-url">PERSISTENCE </label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div
                                                                        class="custom-control custom-control-primary custom-switch d-flex align-items-center">
                                                                        <input type="checkbox" checked=""
                                                                               class="custom-control-input"
                                                                               id="customSwitch3"/>
                                                                        <label class="custom-control-label"
                                                                               for="customSwitch3">Notifications remain
                                                                            on
                                                                            screen until
                                                                            clicked</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end card  -->
                                            </div>
                                            <!-- end switch-notification-inner  -->
                                            <div class="switch-notification-inner">
                                                <div class="card light-gray-bg">
                                                    <div class="card-body">
                                                        <div class="col-12">
                                                            <div class="form-group row mb-2">
                                                                <div class="col-sm-4 col-form-label">
                                                                    <label for="site-url">SAFARI CERTIFICATE
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div
                                                                        class="custom-control custom-control-primary custom-switch d-flex align-items-center">
                                                                        <input type="checkbox" checked=""
                                                                               class="custom-control-input"
                                                                               id="customSwitch3"/>
                                                                        <label class="custom-control-label"
                                                                               for="customSwitch3">Notifications remain
                                                                            on
                                                                            screen until
                                                                            clicked</label>
                                                                    </div>
                                                                    <div class="form-group mt-2">
                                                                        <label for="basicInput">Private Key File</label>
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input"
                                                                                   id="customFile"/>
                                                                            <label class="custom-file-label"
                                                                                   for="customFile">Choose file</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-label"
                                                                               for="basic-default-password1">Private Key
                                                                            Password</label>
                                                                        <input type="password"
                                                                               id="basic-default-password1"
                                                                               class="form-control"
                                                                               placeholder="············" required=""/>
                                                                        <div class="valid-feedback">
                                                                            Looks good!
                                                                        </div>
                                                                        <div class="invalid-feedback">
                                                                            Please enter your password.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end switch-notification-inner  -->
                                        </div>
                                        <!-- end col  -->
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <p class="content-text">Lorem, ipsum dolor.</p>
                                            <div
                                                class="document-wrapper d-flex justify-content-between align-items-center">
                                                <div class="document-icon mr-2">
                                                    <span><i data-feather='book'></i></span>
                                                </div>
                                                <!-- end document-icon  -->
                                                <div class="document-content">
                                                    <h5 class="title">READ OUR DOCUMENTATION</h5>
                                                    <p class="content-text">Lorem ipsum dolor sit, amet consectetur
                                                        adipisicing elit. Sint, odio.
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- end document-wrapper  -->
                                        </div>
                                    </div>
                                    <!-- end row  -->
                                    <!-- start new  -->
                                    <div class="code-spainer-wrapper">
                                        <div class="header mb-2">
                                            <h4>Add Code To Side</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-7 col-md-7 col-sm-12">
                                                <div class="code-spainer-inner">
                                                    <p class="content-text">Lorem ipsum dolor sit amet, consectetur
                                                        adipisicing elit. Voluptatum
                                                        sunt esse veritatis eveniet inventore, rem eligendi earum nobis
                                                        quaerat iusto.</p>
                                                    <p class="content-text mb-2">Lorem ipsum dolor sit amet,<span> consectetur </span>
                                                        adipisicing
                                                        elit. Voluptatum sunt esse veritatis eveniet inventore, rem
                                                        eligendi earum nobis quaerat
                                                        iusto.</p>
                                                    <div class="btn-holder mb-3">
                                                        <button class="btn btn-info">Copy Code</button>
                                                    </div>
                                                    <!-- end btn-holder  -->
                                                    <div class="code-wrapper">
                                                        <div class="card light-gray-bg">
                                                            <div class="card-body">
                                                                <div class="code-inner">
                                  <pre>
                              <code class="">
                              <!DOCTYPE html>
                                <html>
                                  <body>
                                  <h1>The code element</h1>
                                  <p>The HTML <code>button</code> tag defines a clickable button.</p>
                                  <p>The CSS <code>background-color</code> property defines the background color of an element.</p>
                                  </body>
                                </html>
                              </code>
                            </pre>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col  -->
                                            <div class="col-lg-5 col-md-5 col-sm-12">
                                                <div class="setup-content-inner input-content-inner">
                                                    <div class="content-header mb-2">
                                                        <h3>WEBHOOKS</h3>
                                                    </div>
                                                    <p class="content-text mb-2"><span class="contet-headers">Core Request headers:</span>
                                                        consectetur adipisicing elit. Nesciunt, voluptatum
                                                        <span>HTTP</span> quisquam adipisci est
                                                        nulla?</p>

                                                    <p class="content-text mb-2">Lorem, ipsum dolor sit amet consectetur
                                                        adipisicing elit. Est
                                                        officia laboriosam, obcaecati quisquam doloremque maiores.</p>
                                                    <div
                                                        class="document-wrapper d-flex justify-content-between align-items-center">
                                                        <div class="document-icon mr-2">
                                                            <span><i data-feather='book'></i></span>
                                                        </div>
                                                        <!-- end document-icon  -->
                                                        <div class="document-content">
                                                            <h5 class="title">READ OUR DOCUMENTATION</h5>
                                                            <p class="content-text">Lorem ipsum dolor sit, amet
                                                                consectetur adipisicing elit. Sint,
                                                                odio.</p>
                                                        </div>
                                                    </div>
                                                    <!-- end document-wrapper  -->
                                                </div>
                                                <!-- end setup-content  -->
                                            </div>
                                        </div>
                                        <!-- end col  -->
                                    </div>
                                    <!-- end row  -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="">
                                                        <button type="reset"
                                                                class="btn btn-primary mr-1 waves-effect waves-float waves-light">
                                                            Finish
                                                        </button>
                                                        <button type="reset"
                                                                class="btn btn-outline-secondary waves-effect">Go Back
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row  -->
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7 col-sm-12">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Message Name</label>
                                                <input type="text" class="form-control" name="fname"
                                                       placeholder="Message Name"/>
                                            </div>
                                            <!-- end form-grp  -->
                                            <div class="site-wrapper">
                                                <div class="card light-gray-bg">
                                                    <div class="card-body">
                                                        <div class="header mb-2">
                                                            <h4>1. Audience</h4>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div
                                                                    class="demo-inline-spacing d-flex align-items-start flex-column">
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="customRadio1"
                                                                               name="customRadio"
                                                                               class="custom-control-input" checked="">
                                                                        <label class="custom-control-label"
                                                                               for="customRadio1">Checked</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio">
                                                                        <input type="radio" id="customRadio2"
                                                                               name="customRadio"
                                                                               class="custom-control-input">
                                                                        <label class="custom-control-label"
                                                                               for="customRadio2">Unchecked</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- end col  -->
                                                        </div>
                                                        <!-- end row  -->
                                                    </div>
                                                    <!-- end card-body  -->
                                                </div>
                                                <!-- end card  -->
                                            </div>
                                            <!-- end site-wrapper  -->
                                            <div class="switch-inner mb-2 light-gray-bg">
                                                <div class="card switch-header-inner">
                                                    <div class="card-header">
                                                        <div
                                                            class="custom-control custom-control-primary custom-switch d-flex justify-center align-items-center">
                                                            <input type="checkbox" checked=""
                                                                   class="custom-control-input" id="customSwitch3"/>
                                                            <label class="custom-control-label" for="customSwitch3">
                                                                MY Site is not fully HTTPS</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-sm-4 col-form-label">
                                                                <label for="site-url">CHOOSE A LABEL <span>*</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div
                                                                    class="label-inner d-flex align-items-center justify-center">
                                                                    <input type="email" class="form-control"
                                                                           name="site-url" placeholder="Your Label"/>
                                                                    <span class="label-choose-text">.OS.TC</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end switch inner  -->
                                        </div>
                                        <!-- end col  -->
                                    </div>
                                    <!-- end row  -->
                                </div>
                            </div>
                        </div>
                        <!-- end card  -->
                    </div>
                    <!-- end col  -->
                </div>
                <!-- end row  -->
                <div class="message-wrapper">
                    <div class="message-inner d-flex justify-content-between  align-items-center m-2">
                        <h4 class=""> 2. Message</h4>
                        <div class="">
                            <button type="button" class="btn btn-outline-primary waves-effect mr-2">
                                <i data-feather='filter'></i>
                                <span>A/B Test</span>
                            </button>
                            <button type="button" class="btn btn-outline-primary waves-effect">
                                <i data-feather='send'></i>
                                <span>Send Test Push</span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-7 col-sm-12">
                            <div class="switch-inner mx-2 mb-3 light-gray-bg">
                                <div class="card switch-header-inner light-gray-bg">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="header mb-2">
                                                <h6><span><i data-feather='globe'></i></span> Add Languages</h4>
                                            </div>
                                            <div class="message-wrap">
                                                <div class="message-form-inner">
                                                    <div class="title-inner">
                                                        <label for="basicInput">TITLE </label>
                                                        <div
                                                            class="input-group input-group-merge form-title-toggle mb-2">
                                                            <input type="text" class="form-control"
                                                                   id="basic-default-password1"
                                                                   placeholder="Title(Any/ English)"
                                                                   aria-describedby="basic-default-password1">
                                                            <div class="input-group-append">
                                <span class="input-group-text cursor-pointer">
                                  <i data-feather='plus-circle'></i>
                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end title  -->
                                                    <div class="title-inner">
                                                        <label for="basicInput">Messages <span>*</span> </label>
                                                        <div
                                                            class="input-group input-group-merge form-title-toggle mb-2">
                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        placeholder="Thanks for Subscribing!"></textarea>
                                                            <div class="input-group-append">
                                <span class="input-group-text cursor-pointer">
                                  <i data-feather='plus-circle'></i>
                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end form  -->
                                                </div>
                                                <div class="">
                                                    <div class="form-group">
                                                        <label for="customFile">IMAGE</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                   id="customFile">
                                                            <label class="custom-file-label" for="customFile">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="basicInput">Launch URL</label>
                                                    <input type="text" class="form-control" id="basicInput"
                                                           placeholder="http://demo/abc">
                                                </div>
                                                <div class="accordion-list-wrapper">
                                                    <div class="accordion" id="accordionExample">
                                                        <div class="card">
                                                            <div class="card-header bg-light" id="headingOne"
                                                                 data-toggle="collapse"
                                                                 data-target="#collapseOne" aria-expanded="true"
                                                                 aria-controls="collapseOne">
                                                                <h3 class="mb-0">
                                                                    Platform Settings
                                                                </h3>
                                                            </div>
                                                            <div id="collapseOne" class="collapse show"
                                                                 aria-labelledby="headingOne"
                                                                 data-parent="#accordionExample">
                                                                <div class="card-body bg-white ">
                                                                    <div class="switch-inner mb-2 light-gray-bg">
                                                                        <div class="card switch-header-inner">
                                                                            <div class="card-header">
                                                                                <div
                                                                                    class="custom-control custom-control-primary custom-switch d-flex justify-center align-items-center">
                                                                                    <input type="checkbox" checked=""
                                                                                           class="custom-control-input"
                                                                                           id="customSwitch3">
                                                                                    <label class="custom-control-label"
                                                                                           for="customSwitch3">
                                                                                        Send to google chrome</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="customFile">Icon
                                                                                        <span><i
                                                                                                data-feather='corner-right-down'></i></span></label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                               class="custom-file-input"
                                                                                               id="customFile">
                                                                                        <label class="custom-file-label"
                                                                                               for="customFile">Upload
                                                                                            or Enter
                                                                                            URL</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="customFile">Image <span><i
                                                                                                data-feather='corner-right-down'></i></span></label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                               class="custom-file-input"
                                                                                               id="customFile">
                                                                                        <label class="custom-file-label"
                                                                                               for="customFile">Upload
                                                                                            or Enter
                                                                                            URL</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="customFile">Badge <span><i
                                                                                                data-feather='corner-right-down'></i></span></label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                               class="custom-file-input"
                                                                                               id="customFile">
                                                                                        <label class="custom-file-label"
                                                                                               for="customFile">Upload
                                                                                            or Enter
                                                                                            URL</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end  -->
                                                                    <div class="switch-inner mb-2 light-gray-bg">
                                                                        <div class="card switch-header-inner">
                                                                            <div class="card-header">
                                                                                <div
                                                                                    class="custom-control custom-control-primary custom-switch d-flex justify-center align-items-center">
                                                                                    <input type="checkbox" checked=""
                                                                                           class="custom-control-input"
                                                                                           id="customSwitch3">
                                                                                    <label class="custom-control-label"
                                                                                           for="customSwitch3">
                                                                                        Send to Safari</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="customFile">Icon <span><svg
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                width="14" height="14"
                                                                                                viewBox="0 0 24 24"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                class="feather feather-corner-right-down">
                                                <polyline points="10 15 15 20 20 15"></polyline>
                                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                              </svg></span></label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                               class="custom-file-input"
                                                                                               id="customFile">
                                                                                        <label class="custom-file-label"
                                                                                               for="customFile">Upload
                                                                                            or Enter
                                                                                            URL</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="customFile">Image <span><svg
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                width="14" height="14"
                                                                                                viewBox="0 0 24 24"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                class="feather feather-corner-right-down">
                                                <polyline points="10 15 15 20 20 15"></polyline>
                                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                              </svg></span></label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                               class="custom-file-input"
                                                                                               id="customFile">
                                                                                        <label class="custom-file-label"
                                                                                               for="customFile">Upload
                                                                                            or Enter
                                                                                            URL</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="customFile">Badge <span><svg
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                width="14" height="14"
                                                                                                viewBox="0 0 24 24"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                class="feather feather-corner-right-down">
                                                <polyline points="10 15 15 20 20 15"></polyline>
                                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                              </svg></span></label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                               class="custom-file-input"
                                                                                               id="customFile">
                                                                                        <label class="custom-file-label"
                                                                                               for="customFile">Upload
                                                                                            or Enter
                                                                                            URL</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end  -->
                                                                    <div class="switch-inner mb-2 light-gray-bg">
                                                                        <div class="card switch-header-inner">
                                                                            <div class="card-header">
                                                                                <div
                                                                                    class="custom-control custom-control-primary custom-switch d-flex justify-center align-items-center">
                                                                                    <input type="checkbox" checked=""
                                                                                           class="custom-control-input"
                                                                                           id="customSwitch3">
                                                                                    <label class="custom-control-label"
                                                                                           for="customSwitch3">
                                                                                        Send to Edge</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="customFile">Icon <span><svg
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                width="14" height="14"
                                                                                                viewBox="0 0 24 24"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                class="feather feather-corner-right-down">
                                                <polyline points="10 15 15 20 20 15"></polyline>
                                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                              </svg></span></label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                               class="custom-file-input"
                                                                                               id="customFile">
                                                                                        <label class="custom-file-label"
                                                                                               for="customFile">Upload
                                                                                            or Enter
                                                                                            URL</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="customFile">Image <span><svg
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                width="14" height="14"
                                                                                                viewBox="0 0 24 24"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                class="feather feather-corner-right-down">
                                                <polyline points="10 15 15 20 20 15"></polyline>
                                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                              </svg></span></label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                               class="custom-file-input"
                                                                                               id="customFile">
                                                                                        <label class="custom-file-label"
                                                                                               for="customFile">Upload
                                                                                            or Enter
                                                                                            URL</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="customFile">Badge <span><svg
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                width="14" height="14"
                                                                                                viewBox="0 0 24 24"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                class="feather feather-corner-right-down">
                                                <polyline points="10 15 15 20 20 15"></polyline>
                                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                              </svg></span></label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                               class="custom-file-input"
                                                                                               id="customFile">
                                                                                        <label class="custom-file-label"
                                                                                               for="customFile">Upload
                                                                                            or Enter
                                                                                            URL</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end  -->
                                                                    <div class="switch-inner mb-2 light-gray-bg">
                                                                        <div class="card switch-header-inner">
                                                                            <div class="card-header">
                                                                                <div
                                                                                    class="custom-control custom-control-primary custom-switch d-flex justify-center align-items-center">
                                                                                    <input type="checkbox" checked=""
                                                                                           class="custom-control-input"
                                                                                           id="customSwitch3">
                                                                                    <label class="custom-control-label"
                                                                                           for="customSwitch3">
                                                                                        Send to Mozila FireFox</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label for="customFile">Icon <span><svg
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                width="14" height="14"
                                                                                                viewBox="0 0 24 24"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                class="feather feather-corner-right-down">
                                                <polyline points="10 15 15 20 20 15"></polyline>
                                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                              </svg></span></label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                               class="custom-file-input"
                                                                                               id="customFile">
                                                                                        <label class="custom-file-label"
                                                                                               for="customFile">Upload
                                                                                            or Enter
                                                                                            URL</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="customFile">Image <span><svg
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                width="14" height="14"
                                                                                                viewBox="0 0 24 24"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                class="feather feather-corner-right-down">
                                                <polyline points="10 15 15 20 20 15"></polyline>
                                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                              </svg></span></label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                               class="custom-file-input"
                                                                                               id="customFile">
                                                                                        <label class="custom-file-label"
                                                                                               for="customFile">Upload
                                                                                            or Enter
                                                                                            URL</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="customFile">Badge <span><svg
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                width="14" height="14"
                                                                                                viewBox="0 0 24 24"
                                                                                                fill="none"
                                                                                                stroke="currentColor"
                                                                                                stroke-width="2"
                                                                                                stroke-linecap="round"
                                                                                                stroke-linejoin="round"
                                                                                                class="feather feather-corner-right-down">
                                                <polyline points="10 15 15 20 20 15"></polyline>
                                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                              </svg></span></label>
                                                                                    <div class="custom-file">
                                                                                        <input type="file"
                                                                                               class="custom-file-input"
                                                                                               id="customFile">
                                                                                        <label class="custom-file-label"
                                                                                               for="customFile">Upload
                                                                                            or Enter
                                                                                            URL</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end  -->
                                                                </div>

                                                                <!-- end card-header  -->
                                                            </div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-header" id="headingTwo"
                                                                 data-toggle="collapse" data-target="#collapseTwo"
                                                                 aria-expanded="true" aria-controls="collapseTwo">
                                                                <h2 class="mb-0">
                                                                    Addvance Settings
                                                                </h2>
                                                            </div>
                                                            <div id="collapseTwo" class="collapse"
                                                                 aria-labelledby="headingTwo"
                                                                 data-parent="#accordionExample">
                                                                <div class="card-body bg-white">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="form-group mb-2">
                                                                                <label for="basicInput">Launch URL
                                                                                    <span><i
                                                                                            data-feather='corner-right-down'></i></span></label>
                                                                                <input type="text" class="form-control"
                                                                                       id="basicInput"
                                                                                       placeholder="http://demo/abc">
                                                                            </div>
                                                                            <div class="form-group mb-2">
                                                                                <label for="basicInput">Web Push Topic
                                                                                    <span><i
                                                                                            data-feather='corner-right-down'></i></span></label>
                                                                                <input type="text" class="form-control"
                                                                                       id="basicInput"
                                                                                       placeholder="http://demo/abc">
                                                                            </div>
                                                                            <div
                                                                                class="demo-inline-spacing d-flex align-items-start flex-column mb-2">
                                                                                <label for="basicInput">Priority
                                                                                    <span><i
                                                                                            data-feather='corner-right-down'></i></span></label>
                                                                                <div
                                                                                    class="custom-control custom-radio">
                                                                                    <input type="radio"
                                                                                           id="customRadio1"
                                                                                           name="customRadio"
                                                                                           class="custom-control-input"
                                                                                           checked="">
                                                                                    <label class="custom-control-label"
                                                                                           for="customRadio1">Checked</label>
                                                                                </div>
                                                                                <div
                                                                                    class="custom-control custom-radio">
                                                                                    <input type="radio"
                                                                                           id="customRadio2"
                                                                                           name="customRadio"
                                                                                           class="custom-control-input">
                                                                                    <label class="custom-control-label"
                                                                                           for="customRadio2">Unchecked</label>
                                                                                </div>

                                                                            </div>
                                                                            <!-- end radio  -->
                                                                            <div class="select-time-inner">
                                                                                <label for="basicInput mb-2">Time To
                                                                                    Live <span><i
                                                                                            data-feather='corner-right-down'></i></span></label>
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group">
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   id="basicInput"
                                                                                                   placeholder="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <select class="form-control"
                                                                                                id="basicSelect">
                                                                                            <option>Day</option>
                                                                                            <option>Month</option>
                                                                                            <option>Year</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- end accordion-list-wrappper  -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col  -->
                        <div class="col-lg-6 col-md-5 col-sm-12">
                            <div class="web-img-wrapper light-gray-bg p-2">
                                <div class="web-image-inner ">
                                    <div class="top-left-inner light-gray-bg ">
                                        <div class="card light-gray-bg top-left w-75">
                                            <div class="card-body ">
                                                <div
                                                    class="web-content-inner d-flex justify-content-center align-items-center">
                                                    <div class="web-img-icon">
                                                        <img src="https://i.ibb.co/stFStJD/profile.jpg" alt="profile">
                                                    </div>
                                                    <div class="web-content">
                                                        <h4 class="text-dark">Lorem ipsum dolor sit.</h6>
                                                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end top-left-inner  -->
                                    <!-- <div class="top-right-inner light-gray-bg ">
                                          <div class="card light-gray-bg top-right w-75">
                                            <div class="card-body">
                                            <div class="web-content-inner d-flex justify-content-center align-items-center">
                                                <div class="web-img-icon">
                                                <img src="https://i.ibb.co/stFStJD/profile.jpg" alt="profile">
                                                </div>
                                                <div class="web-content">
                                                  <h4 class="text-dark">Lorem ipsum dolor sit.</h6>
                                                  <p>Lorem, ipsum dolor sit amet consectetur adipisicing.</p>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                         </div> -->
                                    <!-- end top-right-inner  -->
                                    <!-- end top-center-inner  -->
                                    <!-- <div class="bottom-left-inner light-gray-bg ">
                                          <div class="card light-gray-bg bottom-left w-75">
                                            <div class="card-body">
                                            <div class="web-content-inner d-flex justify-content-center align-items-center">
                                                <div class="web-img-icon">
                                                <img src="https://i.ibb.co/stFStJD/profile.jpg" alt="profile">
                                                </div>
                                                <div class="web-content">
                                                  <h4 class="text-dark">Lorem ipsum dolor sit.</h6>
                                                  <p>Lorem, ipsum dolor sit amet consectetur adipisicing.</p>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                         </div> -->
                                    <!-- end bottom-left-inner  -->
                                    <!-- <div class="bottom-right-inner light-gray-bg ">
                                          <div class="card light-gray-bg bottom-right w-75">
                                            <div class="card-body">
                                            <div class="web-content-inner d-flex justify-content-center align-items-center w-50">
                                                <div class="web-img-icon">
                                                <img src="https://i.ibb.co/stFStJD/profile.jpg" alt="profile">
                                                </div>
                                                <div class="web-content">
                                                  <h4 class="text-dark">Lorem ipsum dolor sit.</h6>
                                                  <p>Lorem, ipsum dolor sit amet consectetur adipisicing.</p>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                         </div> -->
                                    <!-- end bottom-right-inner  -->
                                </div>
                            </div>
                        </div>
                        <!-- end col  -->
                    </div>


                    <!-- end row  -->
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-12">
                            <!-- end additional-data-inner  -->
                            <div class="additional-data-inner mx-2">
                                <div class="switch-inner mb-2 light-gray-bg">
                                    <div class="card switch-header-inner">
                                        <div class="card-header">
                                            <label for="">Additional Data<span><i data-feather='corner-right-down'></i></span></label>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="select-time-inner">
                                            <label for="basicInput mb-2">Field 1</label>
                                            <div class="form-group d-flex justify-content-start row">
                                                <div class="col-5">
                                                    <input type="text" class="form-control" id="basicInput"
                                                           placeholder="">
                                                </div>
                                                <div class="col-6 d-flex align-items-center ">
                                                    <input type="text" class="form-control mr-2" id="basicInput"
                                                           placeholder="">
                                                    <span><i data-feather='x-circle'></i></span>
                                                </div>
                                            </div>
                                            <div class="add-fields">
                                                <h6><span><i data-feather='plus-circle'></i></span> Add Fields</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end additional-data-inner  -->
                            <div class="additional-data-inner mx-2">
                                <div class="switch-inner mb-2 light-gray-bg">
                                    <div class="card switch-header-inner">
                                        <div class="card-header">
                                            <label for="">Chrome Action Buttons <span><i
                                                        data-feather='corner-right-down'></i></span></label>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="select-time-inner">
                                            <div class="form-group d-flex justify-content-start align-items-center row">
                                                <div class="col-5">
                                                    <label for="basicInput mb-2">Icon URL 1</label>
                                                    <input type="text" class="form-control" id="basicInput"
                                                           placeholder="">
                                                </div>
                                                <div class="col-5">
                                                    <label for="basicInput mb-2">Launch URL 1</label>
                                                    <input type="text" class="form-control" id="basicInput"
                                                           placeholder="">
                                                </div>
                                                <div class="col-2 mt-2">
                                                    <span><i data-feather='x-circle'></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="select-time-inner">
                                            <div class="form-group d-flex justify-content-start row">
                                                <div class="col-5">
                                                    <label for="basicInput mb-2">Icon URL 1</label>
                                                    <input type="text" class="form-control" id="basicInput"
                                                           placeholder="">
                                                </div>
                                                <div class="col-5">
                                                    <label for="basicInput mb-2">Launch URL 1</label>
                                                    <input type="text" class="form-control" id="basicInput"
                                                           placeholder="">
                                                </div>
                                            </div>
                                            <div class="add-fields">
                                                <h6><span><i data-feather='plus-circle'></i></span> Add Fields</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end additional-data-inner  -->
                        </div>
                    </div>
                    <!-- end row  -->
                    <div class="row m-2">
                        <div class="col-lg-7 col-sm-12 ">
                            <div class="header mb-2">
                                <h4>Add Code To Side</h4>
                            </div>
                            <div class="form-group">
                                <label class="d-block">When should this message start sending</label>
                                <div class="custom-control custom-radio my-50">
                                    <input type="radio" id="validationRadiojq1" name="validationRadiojq"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="validationRadiojq1">Male</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="validationRadiojq2" name="validationRadiojq"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="validationRadiojq2">Female</label>
                                    <div class="date-inner">
                                        <input type="text" id="fp-date-time"
                                               class="form-control flatpickr-date-time flatpickr-input"
                                               placeholder="YYYY-MM-DD HH:MM" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <!-- date time  -->
                            <div class="form-group">
                                <label class="d-block">Gender</label>
                                <div class="custom-control custom-radio my-50">
                                    <input type="radio" id="validationRadiojq1" name="validationRadiojq"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="validationRadiojq1">Male</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="validationRadiojq2" name="validationRadiojq"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="validationRadiojq2">Female</label>
                                </div>
                            </div>
                            <div class="btn-holder">
                                <div class="">
                                    <button type="button" class="btn btn-outline-primary waves-effect mr-2">
                                        <i data-feather='send'></i>
                                        <span>Review and Send</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-primary waves-effect">
                                        <span>Save As Draft</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-12">
                            <span>Message was sending Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, eaque!</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col  -->
            </div>
            </div>
            </div>
            <!-- end card-body  -->
            </div>
            <!-- end card  -->
        </section>
        <!-- end section  -->
    </main>

@endsection

@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>

@endsection
@section('page-script')
    {{-- Page js files --}}
    {{--    <script src="{{ asset(mix('js/scripts/pages/user-dashboard.js')) }}"></script>--}}
@endsection
