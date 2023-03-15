@extends('user.layouts/userContentLayoutMaster')

@section('title', $pageConfigs['title'])

@section('vendor-style')

@endsection
@section('page-style')
    {{-- Page css files --}}
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
            background: url('https://i.ibb.co/xjXz51d/web.jpg') no-repeat center center/ cover;
            /*height: 70vh;*/
            height: 413px;
            position: relative;
        }

        .web-img-icon {
            max-width: 60px;
            width: 100%;
            margin-right: 15px !important;
            display: inline-block;
            height: 60px;
            flex-shrink: 0;
        }

        .web-content {
            max-width: calc(100% - 65px);
        }

        .web-img-icon img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover !important;
        }

        .web-image-inner h4 {
            font-size: 14px;
            color: #222222;
        }

        .web-image-inner p {
            font-size: 12px;
        }

        .push-notification {
            position: absolute;
            top: 25%;
            left: 10%;
            margin-bottom: 0;
            max-width: 350px !important;
            width: 100%;
        }

        .push-notification.top-right {
            top: 25%;
            right: 10%;
            left: unset;
        }

        .push-notification.top-center {
            top: 25%;
            left: 50%;
            right: unset;
            transform: translateX(-50%);
        }

        .push-notification.bottom-left {
            bottom: 20%;
            left: 10%;
            top: unset;
        }

        .push-notification.bottom-right {
            bottom: 20%;
            right: 10%;
            top: unset;
            left: unset;
        }

        @media (min-width: 1367px) {
            .push-notification {
                left: 12%;
            }

            .push-notification.top-right {
                right: 12%;
            }

            .push-notification.bottom-left {
                left: 12%;
            }

            .push-notification.bottom-right {
                right: 12%;
            }
        }

        .upload-img-wrapper {
            position: relative;
        }

        .upload-img-inner .upload-btn-inner {
            position: absolute;
            top: 30px;
            right: 2px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            z-index: 1;
        }

        .upload-img-inner .upload-btn-inner .upload-btn {
            font-size: 12px;
            border: 1px solid #7367f0;
            padding: 6px 10px;
            background-repeat: no-repeat;
            background-position: 5px 5px;
            margin-right: 10px;
            color: #7367f0;
            background: #fff;
            margin-left: 5px;
        }

        html .content.app-content {
            padding-bottom: 10px;
        }

        /*.custom-control-input:checked ~ .custom-control-label::before {*/
        /*    color: #fff;*/
        /*    border-color: #7B1FA2;*/
        /*    background-color: red;*/
        /*}*/
        .custom-control-input:checked ~ .custom-control-label::before {
            color: #fff;
            border: 2px solid #f1f2f6;
        }

        /*.custom-control-input:checked~.custom-control-label.red::before {*/
        /*    background-color: red;*/
        /*}*/

        .custom-control-input:checked ~ .custom-control-label.green::before {
            background-color: #7367f0;
            border: 3px solid red;
        }

        /**/
        /*  Start:  custom-css for segment create modal
        /**/

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

        /*.
         /*   End:  custom-css for segment create modal
         /*}*/

    </style>
@endsection

@section('content')
    <!-- Start main -->
    <main>
        <section class="site-setup-section">
            <div class="card">
                <!-- end row  -->
                <div class="message-wrapper">
                    <div class="message-inner d-flex justify-content-between  align-items-center m-2">
                        <h4 class=""> Message</h4>
                        <div class="profile-polls-info">
                            <!-- custom radio -->
                            <div class="d-flex justify-content-between mt-2">
                                <div class="custom-control">
                                    <label class="text-left " for=""> Message Limit : <span
                                            class="badge badge-light-success badge-pill font-medium-1 "> {{ $balance }} </span></label>
                                </div>
                                <label class="text-right"><span class="font-weight-bold">Remaining  message :</span>
                                    <span
                                        class="badge badge-light-{{$percentageLabelColor}} badge-pill font-medium-1 "> {{$current_balance}} </span></label>
                            </div>
                            <!--/ custom radio -->
                            <!-- progressbar -->
                            <div class="progress progress-bar-{{$percentageLabelColor}} my-50"
                                 style="font-weight: 600;height: 13px;">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{$current_balance}}"
                                     aria-valuemin="{{$current_balance}}" aria-valuemax="{{$balance}}"
                                     style="width: {{$percentageDataCurrentBalance}}%">{{$percentageDataCurrentBalance}}
                                    %
                                </div>
                            </div>
                            <!--/ progressbar -->
                        </div>
                        <div class="">
                            <button type="button" class="btn btn-outline-primary waves-effect mr-2 d-none">
                                <i data-feather='filter'></i>
                                <span>A/B Test</span>
                            </button>
                            <button type="button" class="btn btn-outline-primary waves-effect d-none">
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
                                            </div>
                                            <div class="message-wrap">
                                                <div class="message-form-inner">
                                                    <div class="title-inner">
                                                        <label for="basicInput">Title</label>
                                                        <div
                                                            class="input-group input-group-merge form-title-toggle mb-2">
                                                            <input type="text"
                                                                   class="form-control"
                                                                   id="title"
                                                                   placeholder="Title(Any/ English)"
                                                            >

                                                            <div class="input-group-append">
                                                                <span class="input-group-text cursor-pointer">
{{--                                                                    <i data-feather='plus-circle'></i>--}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end title  -->
                                                    <div class="title-inner">
                                                        <label for="basicInput">Messages <span>*</span> </label>
                                                        <div
                                                            class="input-group input-group-merge form-title-toggle mb-2">
                                                            <textarea class="form-control"
                                                                      id="message"
                                                                      rows="3"
                                                                      placeholder="Thanks for Subscribing!"></textarea>

                                                            <div class="input-group-append">
                                                                <span class="input-group-text cursor-pointer">
{{--                                                                    <i data-feather='plus-circle'></i>--}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end form  -->
                                                </div>

                                                <div class="upload-img-wrapper">
                                                    <div class="upload-img-inner">
                                                        <label for="basicInput">Image</label>
                                                        <div class="upload-btn-inner">
                                                            <button class="btn upload-btn uploader-from-bth"
                                                                    data-image-type="1">Upload
                                                            </button>
                                                        </div>
                                                        <div class="input-url">
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="main_image"
                                                                   id="main_image"
                                                                   placeholder="Upload or Input URL">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="basicInput">Launch URL</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           id="launch_url"
                                                           placeholder="http://demo/abc">
                                                </div>

                                                <div class="row  pb-5">
                                                    <!--Start segment section-->
                                                    <div class="col-md-12">
                                                        <div class="">
                                                            <label class="d-block">Audience </label>

                                                            <div class="radio-inner d-flex flex-column">
                                                                <div
                                                                    class="custom-control custom-radio custom-control-inline mt-1">
                                                                    <input type="radio" id="default_subscriber"
                                                                           name="audience"
                                                                           class="custom-control-input green"
                                                                           checked
                                                                           value="subscribers">
                                                                    <label class="custom-control-label"
                                                                           for="default_subscriber">Send to
                                                                        subscription</label>
                                                                </div>
                                                                <div
                                                                    class="custom-control custom-radio custom-control-inline d-flex align-items-center  ">
                                                                    <div class="mb-2">
                                                                        <input type="radio" id="segment" name="audience"
                                                                               class="custom-control-input red"
                                                                               value="particular_segment">
                                                                        <label class="custom-control-label"
                                                                               for="segment">Send to particular
                                                                            segments</label>
                                                                    </div>
                                                                    <a class="nav-link mb-2" data-toggle="modal" data-target="#segment-help" title="Help Video">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle font-large-1"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                                                                    </a>
                                                                </div>

                                                                <div
                                                                    class="modal fade text-left"
                                                                    id="segment-help"
                                                                    tabindex="-1"
                                                                    role="dialog"
                                                                    aria-labelledby="edit-user-modal-aria"
                                                                    aria-hidden="true"
                                                                >
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="edit-user-modal-aria">Segment Help Video</h4>
                                                                                <button  type="button" class="close" id="segment-help-modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <video id="segment-video" height="400" width="780" controls>
                                                                                        <source src="{{asset('data/segment.mp4')}}" type="video/mp4">
                                                                                        <source src="{{asset('data/segment.mp4')}}" type="video/ogg">
                                                                                        Your browser does not support HTML video.
                                                                                    </video>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="segment_section">
                                                                    <!-- Multiple -->
                                                                    <div class="mt-2">
                                                                        <label>Include segments</label>
                                                                        <span class="text-danger font-small-3"> ( What segment(s) should receive this message? )</span>
                                                                        <select class="select2 form-control"
                                                                                name="segment_list" id="segment_list"
                                                                                multiple>
                                                                            <option value="all" selected>Subscribed
                                                                                Users (Default)
                                                                            </option>
                                                                        </select>
                                                                        <span
                                                                            class="text-danger  default_Selected"></span>
                                                                    </div>
                                                                    <!-- End: Multiple -->
                                                                    <div class=" text-right">
                                                                        <button
                                                                            class="btn btn-outline-primary mt-2 create_segment">
                                                                            Create segment
                                                                        </button>
                                                                    </div>
                                                                    @include('.web-app.segment.segment-modal')
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--End segment section-->

                                                    <div class="col-lg-6 col-sm-12 ">
                                                        <div class="form-group">
                                                            <label class="d-block">When should this message start
                                                                sending</label>

                                                            <div class="radio-inner d-flex flex-column">
                                                                <div
                                                                    class="custom-control custom-radio custom-control-inline mt-1">
                                                                    <input type="radio" id="rd_1" name="rd"
                                                                           class="custom-control-input green"
                                                                           checked
                                                                           value="immediately">
                                                                    <label class="custom-control-label" for="rd_1">Immediately</label>
                                                                </div>
                                                                <div
                                                                    class="custom-control custom-radio custom-control-inline d-flex flex-column mt-1 mb-1">
                                                                    <div class="">
                                                                        <input type="radio" id="rd_2" name="rd"
                                                                               class="custom-control-input red"
                                                                               value="specific">
                                                                        <label class="custom-control-label" for="rd_2">Specific
                                                                            Time</label>
                                                                    </div>

                                                                    <div class="date-inner mt-2 date-inner-show-hide">
                                                                        <input type="text" id="fp-date-time"
                                                                               class="form-control flatpickr-date-time flatpickr-input"
                                                                               value=""
                                                                               placeholder="YYYY-MM-DD HH:MM"
                                                                               readonly="readonly">
                                                                        {{--                                                                        <span class="text-warning">Message will be sent following Coordinated Universal Time or Universal Time Coordinated (UTC).</span>--}}
                                                                        <span class="text-warning">
                                                                            Message will start sending
                                                                            <span
                                                                                class="schedule_date text-success"></span> UTC+06:00
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- date time  -->

                                                    </div>
                                                    <div class="col-lg-6 col-sm-12">
                                                        <span></span>
                                                    </div>
                                                    {{--                        end col --}}

                                                </div>


                                                <div class="accordion-list-wrapper d-none">
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
                                                                                           id="send_to_google_chrome_new">
                                                                                    <label class="custom-control-label"
                                                                                           for="send_to_google_chrome_new">
                                                                                        Send to google chrome</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body"
                                                                             id="send_to_google_chrome_tab">
                                                                            <div class="col-12">
                                                                                <div class="upload-img-wrapper">
                                                                                    <div class="upload-img-inner">
                                                                                        <label
                                                                                            for="basicInput">Image</label>
                                                                                        <div class="upload-btn-inner">
                                                                                            <button
                                                                                                class=" btn upload-btn  uploader-from-bth"
                                                                                                data-image-type="2">
                                                                                                Upload
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="input-url">
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="send_to_google_chrome_main_image"
                                                                                                   id="send_to_google_chrome_main_image"
                                                                                                   placeholder="Upload or Input URL">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="upload-img-wrapper">
                                                                                    <div class="upload-img-inner">
                                                                                        <label
                                                                                            for="basicInput">Icon</label>
                                                                                        <div class="upload-btn-inner">
                                                                                            <button
                                                                                                class=" btn upload-btn  uploader-from-bth"
                                                                                                data-image-type="3">
                                                                                                Upload
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="input-url">
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="send_to_google_chrome_main_icon"
                                                                                                   id="send_to_google_chrome_main_icon"
                                                                                                   placeholder="Upload or Input URL">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="upload-img-wrapper">
                                                                                    <div class="upload-img-inner">
                                                                                        <label
                                                                                            for="basicInput">Badge</label>
                                                                                        <div class="upload-btn-inner">
                                                                                            <button
                                                                                                class=" btn upload-btn uploader-from-bth"
                                                                                                data-image-type="4">
                                                                                                Upload
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="input-url">
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="send_to_google_chrome_main_badge"
                                                                                                   id="send_to_google_chrome_main_badge"
                                                                                                   placeholder="Upload or Input URL">
                                                                                        </div>
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
                                                                                    <input type="checkbox"
                                                                                           checked=""
                                                                                           name="send_to_safari"
                                                                                           class="custom-control-input"
                                                                                           id="send_to_safari">
                                                                                    <label class="custom-control-label"
                                                                                           for="send_to_safari">
                                                                                        Send to Safari</label>
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
                                                                                           id="send_to_edge">
                                                                                    <label class="custom-control-label"
                                                                                           for="send_to_edge">
                                                                                        Send to Edge</label>
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
                                                                                           id="send_to_mozila_fireFox">
                                                                                    <label class="custom-control-label"
                                                                                           for="send_to_mozila_fireFox">
                                                                                        Send to Mozila FireFox</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body"
                                                                             id="send_to_mozila_fireFox_tab">
                                                                            <div class="col-12">
                                                                                <div class="form-group">

                                                                                    <div class="upload-img-wrapper">
                                                                                        <div class="upload-img-inner">
                                                                                            <label for="customFile">Icon
                                                                                                <span>
                                                                                        </span>
                                                                                            </label>
                                                                                            {{--                                                                                            <label for="basicInput">Images</label>--}}
                                                                                            <div
                                                                                                class="upload-btn-inner">
                                                                                                <button
                                                                                                    class=" btn upload-btn  uploader-from-bth"
                                                                                                    data-image-type="5">
                                                                                                    Upload
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="input-url">
                                                                                                <input type="text"
                                                                                                       class="form-control"
                                                                                                       name="send_to_mozila_fireFox_icon"
                                                                                                       id="send_to_mozila_fireFox_icon"
                                                                                                       placeholder="Upload or Input URL">
                                                                                            </div>
                                                                                        </div>
                                                                                        {{--                                                                                        <i data-feather='plus'></i></span>--}}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end  -->
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
                        </div>
                        <!-- end col  -->
                        <div class="col-lg-6 col-md-5 col-sm-12">
                            <div class="web-img-wrapper light-gray-bg">
                                <div class="web-image-inner ">
                                    <div class="card bg-light push-notification">
                                        <div class="card-body">
                                            <div
                                                class="web-content-inner d-flex justify-content-start align-items-start">
                                                <div class="web-img-icon mr-3 ">
                                                    <img src="https://i.ibb.co/stFStJD/profile.jpg" alt="profile">
                                                </div>
                                                <div class="web-content ">
                                                    <h4 id="b-title">Title</h4>
                                                    <p id="b-message">Message will be show here.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col  -->
                    </div>

                    {{--file upload--}}
                    <label>
                        <input type="file" name="image_uploader" id="image_uploader" hidden="hidden">
                    </label>
                    <div class="btn-holder d-flex justify-content-end align-items-center mb-5 mr-3">
                        <button type="button" class="btn btn-outline-primary waves-effect mr-2" id="save_data">
                            <i data-feather='send'></i>
                            <span>Review and Send</span>
                        </button>
                        {{--                        <button type="button" class="btn btn-outline-primary waves-effect">--}}
                        {{--                            <span>Save As Draft</span>--}}
                        {{--                        </button>--}}
                        {{--                    </div>--}}
                    </div>
                </div>
                <!-- end col  -->
                <!-- end card-body  -->
                <!-- end card  -->
            </div>
        </section>
        <!-- end section  -->
    </main>

@endsection

@section('vendor-script')
    {{-- vendor files --}}

@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/segment/segment-manage.js')) }}"></script>

    <script>
        let app_id = '{!! $appId !!}';
        let image_upload_type = 0; // no one selected

        function matcherForImageUrl(url, type) {
            type = parseInt(type)

            if (type === 1) {
                $('#main_image').val(url)
            }
            if (type === 2) {
                $('#send_to_google_chrome_main_image').val(url)
            }

            if (type === 3) {
                $('#send_to_google_chrome_main_icon').val(url)
            }

            if (type === 4) {
                $('#send_to_google_chrome_main_badge').val(url)
            }

            if (type === 5) {
                $('#send_to_mozila_fireFox_icon').val(url)
            }

            $(".uploader-from-bth").attr("disabled", false);
            $("#save_data").attr("disabled", false);

            $("#image_uploader").val(null);


        }

        $(document).on('click', '.uploader-from-bth', function (e) {
            image_upload_type = $(this).attr('data-image-type');
            $('#image_uploader').click()
        });

        $(document).on('change', '#image_uploader', function (e) {
            let formData = new FormData();
            formData.append('file', $('#image_uploader')[0].files[0]);
            $(".uploader-from-bth").attr("disabled", true);
            $("#save_data").attr("disabled", true);

            /* ******************************************************  */

            $.blockUI({
                message: '<div class="text-primary" role="status">Image uploading</div>',
                // timeout: 4000,
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8
                }
            });

            /* ******************************************************  */


            $.ajax({
                url: '{!! route('image-uploader') !!}',
                type: 'POST',
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function (response) {
                    console.log(response)
                    if (response.status === 200) {
                        $.showSuccessAlert('Image upload successfully')
                        let url = response.data.url
                        matcherForImageUrl(url, image_upload_type)
                    } else {
                        $.showWarningAlert(response.message)
                        $(".uploader-from-bth").attr("disabled", false);
                        $("#save_data").attr("disabled", false);
                        $("#image_uploader").val(null);
                    }
                    $.unblockUI();
                }
            });

        });


        $('.date-inner-show-hide').hide();
        let range_pickr = $('.flatpickr-date-time');

        let specific_time = null;
        let dateTimeData = null;
        let title = null;
        let message = null;
        let launch_url = null;
        let main_image = null;
        let specific_time_status = false
        let send_to_google_chrome_main_image = null;
        let send_to_google_chrome_main_icon = null;
        let send_to_google_chrome_main_badge = null;
        let send_to_mozila_fireFox_icon = null;
        let send_to_google_chrome = true;
        let send_to_safari = true;
        let send_to_edge = true;
        let send_to_mozila_fireFox = true;
        let date = new Date();
        let defaultHour = date.getHours()
        let defaultMinute = date.getMinutes()
        let segmentData = null
        /**
         * specific and immediately time pick
         */
        if (range_pickr.length) {
            dateTimeData = range_pickr.flatpickr({
                defaultDate: "today",
                defaultHour: defaultHour,
                defaultMinute: defaultMinute,
                minDate: "today",
                enableTime: true,
                dateFormat: "Y-m-d H:i:s",
                onChange: function (selectedDates, dateStr, instance) {
                    specific_time = instance.formatDate(selectedDates[0], "Y-m-d H:i:s");

                    // let startDate = moment(selectedDates[0], "DD.MM.YYYY");
                    let utcTime = moment(selectedDates[0]);
                    let dateTime = utcTime.format('lll');
                    $(".schedule_date").html(dateTime)

                    let nextWeekSunday = moment().day(selectedDates[0]);

                    console.log(nextWeekSunday, 'nextWeekSunday');

                },
                onClose: function (selectedDates, dateStr, instance) {
                    specific_time = instance.formatDate(selectedDates[0], "Y-m-d H:i:s");
                }
            });

            specific_time = dateTimeData.formatDate(dateTimeData.now, "Y-m-d H:i:s")
        }

        $(".schedule_date").html(specific_time)


        $("#title").on("change paste keyup", function () {
            $('#b-title').html($(this).val())
        });

        $("#message").on("change paste keyup", function () {
            $('#b-message').html($(this).val())
        });


        $("#send_to_google_chrome_new").change(function () {
            if (this.checked) {
                send_to_google_chrome = true
                $('#send_to_google_chrome_tab').show();
            } else {
                $('#send_to_google_chrome_tab').hide();
                send_to_google_chrome = false;
            }
        });

        $("#send_to_safari").change(function () {
            send_to_safari = !!this.checked;
        });

        $("#send_to_edge").change(function () {
            send_to_edge = !!this.checked;
        });

        $("#send_to_mozila_fireFox").change(function () {
            if (this.checked) {
                send_to_mozila_fireFox = !!this.checked;
                $('#send_to_mozila_fireFox_tab').show();
            } else {
                send_to_mozila_fireFox = !!this.checked;
                $('#send_to_mozila_fireFox_tab').hide();
            }
        });

        $('input[type=radio][name=rd]').change(function () {
            if (this.value === 'specific') {
                $('.date-inner-show-hide').show();
                specific_time_status = true;
            } else if (this.value === 'immediately') {
                $('.date-inner-show-hide').hide();
                specific_time_status = false;
            }
        });


        function blockUICustom() {
            $.blockUI({
                message: '<div class="spinner-border text-primary" role="status"></div>',
                timeout: 3000,
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8
                }
            });
        }


        $(document).on('click', '#save_data', function () {

            /* *****************************************************  */
            title = $('#title').val();
            message = $('#message').val();
            launch_url = $('#launch_url').val();
            main_image = $('#main_image').val();
            send_to_google_chrome_main_image = $('#send_to_google_chrome_main_image').val();
            send_to_google_chrome_main_icon = $('#send_to_google_chrome_main_icon').val();
            send_to_google_chrome_main_badge = $('#send_to_google_chrome_main_badge').val();
            send_to_mozila_fireFox_icon = $('#send_to_mozila_fireFox_icon').val();
            send_to_mozila_fireFox_icon = $('#send_to_mozila_fireFox_icon').val();
            // segmentData = $('#segment_list').val();

            if (title === '') {
                $.showWarningAlert('Title can not be empty !!');
                return;
            }

            if (title === '') {
                $.showWarningAlert('message can not be empty !!');
                return;
            }

            if (launch_url === '') {
                $.showWarningAlert('Launch url can not be empty !!');
                return;
            }

            if (launch_url !== '') {
                if (!$.validURL(launch_url)) {
                    $.showWarningAlert('Please provide valid launch url');
                    return;
                }
            }

            let formData = new FormData();
            formData.append('title', title);
            formData.append('message', message);
            formData.append('launch_url', launch_url);
            formData.append('main_image', main_image);
            formData.append('send_to_google_chrome', send_to_google_chrome);
            formData.append('send_to_safari', send_to_safari);
            formData.append('send_to_edge', send_to_edge);
            formData.append('send_to_mozila_fireFox', send_to_mozila_fireFox);
            formData.append('send_to_google_chrome_main_image', send_to_google_chrome_main_image)
            formData.append('send_to_google_chrome_main_icon', send_to_google_chrome_main_icon);
            formData.append('send_to_google_chrome_main_badge', send_to_google_chrome_main_badge);
            formData.append('send_date', specific_time);
            formData.append('send_to_mozila_fireFox_icon', send_to_mozila_fireFox_icon);
            formData.append('specific_time_status', specific_time_status);
            formData.append('app_id', '{!! $appId !!}');
            formData.append('filters', segmentData);

            blockUICustom();

            $.ajax({
                url: '{!! route('broadcast-create') !!}',
                type: 'POST',
                data: formData,
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                success: function (response) {
                    if (response.status === 200) {
                        $.showSuccessAlert('Success', 'Message created successfully');
                        setTimeout(() => {
                            window.location.href = route('broadcast-list-view', {id: '{!! $appId !!}'});
                        }, 4000);
                    } else {
                        $.showErrorAlert('Error', 'Something is wrong !!');
                    }
                }
            });
        });


        /*======= Start : Append segment collection list into include segment select dropdown ======== */
        function appendOptionToSelect() {
            let data = {
                app_id: '{!! $appId !!}',
            }
            let response = $.makeAjaxRequest('all-segment-list', 'GET', data)

            if (response?.data.length) {
                $.each(response.data, function (index, data) {
                    $('#segment_list').append($('<option>', {
                        value: data.id,
                        text: data.name
                    }));
                });
            }
        }

        appendOptionToSelect()

        $('#segment_list').on('select2:select', function (e) {
            var data = e.params.data;

            if ($('#segment_list option:selected').val() == 'all') {
                segmentData = null
                $(".default_Selected").html("Message will be sent to all subscribers if default subscribed user is not deselected.")
            } else {
                segmentData = $('#segment_list').val();
                $(".default_Selected").html("")
            }
        });
        /*======= End : Append segment collection list into include segment select dropdown ======== */

    </script>
@endsection
