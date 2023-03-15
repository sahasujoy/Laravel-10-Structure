@extends('user.layouts/userContentLayoutMaster')

@section('title', 'Web Configuration')

@section('vendor-style')

@endsection
@section('page-style')

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.7.0/build/styles/default.min.css">

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

        .report-content {
            margin-top: 50px;
        }

        .report-content p {
            font-size: 16px;
            color: #000;
        }

        .report-content h4 {
            color: #000000;
        }

        .report-content ol li a {
            color: #000000;
            font-weight: 500;
        }

        .report-content ol li span a {
            color: #7367f0;
        }

        .report-content ol li {
            color: #222;
            padding-bottom: 12px;
        }

        .nav-tabs-menu {
            margin: 3px 0 20px 12px !important
        }

        .shareCaptionTextArea {
            height: 320px;
            border-color: #fff8f8;
            color: black;
            background: #fbfbfb;
            font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
            font-size: 12px;
            pointer-events: none;
        }
    </style>
@endsection

@section('content')

    <main>
        <section class="site-setup-section">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="advance-wrapper mx-2 mb-3">

                                    <!-- start new  -->
                                    <div class="code-spainer-wrapper">

                                        <!-- Tabs with Icon starts one -->
                                        <div class="col-xl-12 col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                </div>
                                                <div class="card-body">
                                                    <ul class="nav nav-tabs nav-tabs-menu" role="tablist"
                                                        style="margin: 3px 0 20px 12px !important">
                                                        <li class="nav-item">
                                                            <a
                                                                class="nav-link active"
                                                                id="homeIcon-tab"
                                                                data-toggle="tab"
                                                                href="#homeIcon"
                                                                aria-controls="home"
                                                                role="tab"
                                                                aria-selected="true"
                                                            >
                                                                <i data-feather="code"></i>
                                                                <strong>
                                                                    Configure Custom website
                                                                </strong>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a
                                                                class="nav-link"
                                                                id="profileIcon-tab"
                                                                data-toggle="tab"
                                                                href="#profileIcon"
                                                                aria-controls="profile"
                                                                role="tab"
                                                                aria-selected="false"
                                                            ><i data-feather="cloud"></i>
                                                                <strong>
                                                                    Configure WordPress site
                                                                </strong>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="homeIcon"
                                                             aria-labelledby="homeIcon-tab" role="tabpanel">

                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-7 col-sm-12">
                                                                    {{-- BEGIN: Configuration --}}
                                                                    <div class="customizer-content">
                                                                        <form class="alert_config_form">
                                                                            <!-- Theme -->
                                                                            <div class="customizer-footer px-2">
                                                                                <p class="font-weight-bold">Notification type</p>
                                                                                <div class="d-flex">
                                                                                    <div class="custom-control custom-radio mr-1">
                                                                                        <input type="radio" id="bell_prompt"
                                                                                               name="notification_type"
                                                                                               class="custom-control-input" value="1"
                                                                                            {{(isset($configData) and $configData->type == 1) ? "checked" : ""}}
                                                                                        />
                                                                                        <label class="custom-control-label"
                                                                                               for="bell_prompt">Bell prompt</label>
                                                                                    </div>
                                                                                    <div class="custom-control custom-radio mr-1">
                                                                                        <input type="radio" id="slide_prompt"
                                                                                               name="notification_type"
                                                                                               class="custom-control-input" value="2"
                                                                                            {{(isset($configData) and $configData->type == 2) ? "checked" : ""}}
                                                                                        />

                                                                                        <label class="custom-control-label"
                                                                                               for="slide_prompt">Slide prompt</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <hr/>
                                                                            <!-- BEGIN: Bell prompt -->
                                                                            <div class="bell_prompt ">
                                                                                <!-- Size -->
                                                                                <div class="customizer-menu px-2">
                                                                                    <div id="customizer-menu-collapsible" class="d-flex">
                                                                                        <h5 class="font-weight-bold mr-auto m-0">Size</h5>
                                                                                        <div
                                                                                            class="custom-control custom-control-primary custom-switch">
                                                                                            <div class="form-group">
                                                                                                <select class="form-control mr-1" id="size"
                                                                                                        name="size">
                                                                                                    <option
                                                                                                        value="large"
                                                                                                        {{(isset($configData) and $configData->bellPrompt->size == "large") ? "selected" : ""}} >

                                                                                                        Large
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="medium"
                                                                                                        {{(isset($configData) and $configData->bellPrompt->size == "medium") ? "selected" : ""}}>
                                                                                                        Medium
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="small"
                                                                                                        {{(isset($configData) and $configData->bellPrompt->size == "small") ? "selected" : ""}}>
                                                                                                        Small
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <hr/>

                                                                                <!-- Theme -->
                                                                                <div class="customizer-footer px-2">
                                                                                    <p class="font-weight-bold">Theme</p>
                                                                                    <div class="d-flex">
                                                                                        <div class="custom-control custom-radio mr-1">
                                                                                            <input type="radio" id="default_theme"
                                                                                                   name="theme" class="custom-control-input"
                                                                                                   value="default"
                                                                                                {{(isset($configData) and $configData->bellPrompt->theme == "default") ? "checked" : ""}} />
                                                                                            <label class="custom-control-label"
                                                                                                   for="default_theme">Default</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-radio mr-1">
                                                                                            <input type="radio" id="inverse_theme"
                                                                                                   name="theme" class="custom-control-input"
                                                                                                   value="inverse"
                                                                                                {{(isset($configData) and $configData->bellPrompt->theme == "inverse") ? "checked" : ""}}/>
                                                                                            <label class="custom-control-label"
                                                                                                   for="inverse_theme">Inverse</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <hr/>

                                                                                <!-- Position -->
                                                                                <div class="customizer-footer px-2">
                                                                                    <p class="font-weight-bold">Position</p>
                                                                                    <div class="d-flex">
                                                                                        <div class="custom-control custom-radio mr-1">
                                                                                            <input type="radio" id="bottom_right"
                                                                                                   name="position"
                                                                                                   class="custom-control-input"
                                                                                                   value="bottom-right"
                                                                                                {{(isset($configData) and $configData->bellPrompt->position == "bottom-right") ? "checked" : ""}} />
                                                                                            <label class="custom-control-label"
                                                                                                   for="bottom_right">Bottom right</label>
                                                                                        </div>
                                                                                        <div class="custom-control custom-radio mr-1">
                                                                                            <input type="radio" id="bottom_left"
                                                                                                   name="position"
                                                                                                   class="custom-control-input"
                                                                                                   value="bottom-left"
                                                                                                {{(isset($configData) and $configData->bellPrompt->position == "bottom-left") ? "checked" : ""}}/>

                                                                                            <label class="custom-control-label"
                                                                                                   for="bottom_left">Bottom left</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <hr/>
                                                                                <!-- Start: Instruction -->
                                                                                <div class="customizer-footer">
                                                                                    <div class="row">
                                                                                        <div class="col-12">
                                                                                            <div class="form-group">
                                                                                                <label for="bellPromptActionMessage">Update
                                                                                                    instruction</label>
                                                                                                <textarea
                                                                                                    class="form-control"
                                                                                                    id="bellPromptActionMessage",
                                                                                                    name="bell_prompt_action_message"
                                                                                                    rows="3"
                                                                                                    placeholder="Instruction Message">{{(isset($configData) and $configData->bellPrompt->message != "") ? $configData->bellPrompt->message : "Subscribe to notifications"}}</textarea>
                                                                                                <span class="text-danger error-text bell_prompt_action_message_err"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <hr/>
                                                                                <!-- End: Instruction -->

                                                                            </div>
                                                                            <!-- End: Bell prompt -->

                                                                            <!-- BEGIN: Slide prompt -->
                                                                            <div class="slide_prompt d-none">
                                                                                <div class="col-12">
                                                                                    <div class="customizer-footer">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="actionMessage">Update
                                                                                                        instruction</label>
                                                                                                    <textarea
                                                                                                        class="form-control"
                                                                                                        id="slidePromptActionMessage"
                                                                                                        name="slide_prompt_action_message"
                                                                                                        rows="3"
                                                                                                        placeholder="Instruction Message"
                                                                                                    >{{(isset($configData) and $configData->slidePrompt->message != "") ? $configData->slidePrompt->message : "We'd like to show you notifications for the latest news and updates."}}</textarea>
                                                                                                    <span class="text-danger error-text slide_prompt_action_message_err"></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="col-sm-6 col-12">
                                                                                                <label for="acceptButton">Positive
                                                                                                    button</label>
                                                                                                <input
                                                                                                    type="text"
                                                                                                    class="form-control is-valid"
                                                                                                    id="acceptButton"
                                                                                                    name="accept_button"
                                                                                                    placeholder="Accept"
                                                                                                    value="{{(isset($configData) and $configData->slidePrompt->acceptButton != "") ? $configData->slidePrompt->acceptButton : "Accept"}}"
                                                                                                    required
                                                                                                />
                                                                                                <span class="text-danger error-text accept_button_err"></span>
                                                                                            </div>
                                                                                            <div class="col-sm-6 col-12">
                                                                                                <label for="cancelButton">Negative
                                                                                                    button</label>
                                                                                                <input
                                                                                                    type="text"
                                                                                                    class="form-control is-invalid"
                                                                                                    id="cancelButton"
                                                                                                    name="cancel_button"
                                                                                                    placeholder="Cancel"
                                                                                                    value="{{(isset($configData) and $configData->slidePrompt->cancelButton != "") ? $configData->slidePrompt->cancelButton : "Cancel"}}"
                                                                                                    required
                                                                                                />
                                                                                                <span class="text-danger error-text cancel_button_err"></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <hr/>
                                                                            </div>
                                                                            <!-- End: Slide prompt -->

                                                                            <div class="col-12 text-right">
                                                                                <button
                                                                                    class="btn btn-primary waves-effect waves-float waves-light"
                                                                                    id="bell_button">
                                                                                    Update
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    {{-- End: Configuration --}}
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="text-right mb-1">
                                                                        Time to subscribe to your notifications! Just go to your website and Allow push notifications.
                                                                        <a href="{{$appData->chrome_web_origin}}" type="button" class="ml-2 btn btn-outline-primary" target="_blank">
                                                                            <i data-feather='external-link'></i>
                                                                            <span>Go To My Website</span>
                                                                        </a>
                                                                    </div>

                                                                    <div class="code-wrapper">
                                                                        <div class="card light-gray-bg">
                                                                            <div class="card-body">

                                                                                <div class="code-inner">
                                                                                    @include('.web-app.side-message.http-web-push-side')
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="tab-pane" id="profileIcon"
                                                             aria-labelledby="profileIcon-tab" role="tabpanel">

                                                            <div class="code-wrapper">
                                                                <div class="card light-gray-bg">
                                                                    <div class="card-body">
                                                                        <div class=" code-inner">
                                                                            @include('.web-app.side-message.wp-instruction')
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tabs with Icon ends one -->

{{--                                        <div class="header mb-2">--}}
{{--                                            <h4>Add Code To Side</h4>--}}
{{--                                        </div>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-lg-4 col-md-7 col-sm-12">--}}
{{--                                                --}}{{-- BEGIN: Configuration --}}
{{--                                                <div class="customizer-content">--}}
{{--                                                    <form class="alert_config_form">--}}
{{--                                                        <!-- Theme -->--}}
{{--                                                        <div class="customizer-footer px-2">--}}
{{--                                                            <p class="font-weight-bold">Notification type</p>--}}
{{--                                                            <div class="d-flex">--}}
{{--                                                                <div class="custom-control custom-radio mr-1">--}}
{{--                                                                    <input type="radio" id="bell_prompt"--}}
{{--                                                                           name="notification_type"--}}
{{--                                                                           class="custom-control-input" value="1"--}}
{{--                                                                        {{(isset($configData) and $configData->type == 1) ? "checked" : ""}}--}}
{{--                                                                    />--}}
{{--                                                                    <label class="custom-control-label"--}}
{{--                                                                           for="bell_prompt">Bell prompt</label>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="custom-control custom-radio mr-1">--}}
{{--                                                                    <input type="radio" id="slide_prompt"--}}
{{--                                                                           name="notification_type"--}}
{{--                                                                           class="custom-control-input" value="2"--}}
{{--                                                                        {{(isset($configData) and $configData->type == 2) ? "checked" : ""}}--}}
{{--                                                                        />--}}

{{--                                                                    <label class="custom-control-label"--}}
{{--                                                                           for="slide_prompt">Slide prompt</label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <hr/>--}}
{{--                                                        <!-- BEGIN: Bell prompt -->--}}
{{--                                                        <div class="bell_prompt ">--}}
{{--                                                            <!-- Size -->--}}
{{--                                                            <div class="customizer-menu px-2">--}}
{{--                                                                <div id="customizer-menu-collapsible" class="d-flex">--}}
{{--                                                                    <h5 class="font-weight-bold mr-auto m-0">Size</h5>--}}
{{--                                                                    <div--}}
{{--                                                                        class="custom-control custom-control-primary custom-switch">--}}
{{--                                                                        <div class="form-group">--}}
{{--                                                                            <select class="form-control mr-1" id="size"--}}
{{--                                                                                    name="size">--}}
{{--                                                                                <option--}}
{{--                                                                                    value="large"--}}
{{--                                                                                    {{(isset($configData) and $configData->bellPrompt->size == "large") ? "selected" : ""}} >--}}

{{--                                                                                    Large--}}
{{--                                                                                </option>--}}
{{--                                                                                <option--}}
{{--                                                                                    value="medium"--}}
{{--                                                                                    {{(isset($configData) and $configData->bellPrompt->size == "medium") ? "selected" : ""}}>--}}
{{--                                                                                    Medium--}}
{{--                                                                                </option>--}}
{{--                                                                                <option--}}
{{--                                                                                    value="small"--}}
{{--                                                                                    {{(isset($configData) and $configData->bellPrompt->size == "small") ? "selected" : ""}}>--}}
{{--                                                                                    Small--}}
{{--                                                                                </option>--}}
{{--                                                                            </select>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <hr/>--}}

{{--                                                            <!-- Theme -->--}}
{{--                                                            <div class="customizer-footer px-2">--}}
{{--                                                                <p class="font-weight-bold">Theme</p>--}}
{{--                                                                <div class="d-flex">--}}
{{--                                                                    <div class="custom-control custom-radio mr-1">--}}
{{--                                                                        <input type="radio" id="default_theme"--}}
{{--                                                                               name="theme" class="custom-control-input"--}}
{{--                                                                               value="default"--}}
{{--                                                                            {{(isset($configData) and $configData->bellPrompt->theme == "default") ? "checked" : ""}} />--}}
{{--                                                                        <label class="custom-control-label"--}}
{{--                                                                               for="default_theme">Default</label>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="custom-control custom-radio mr-1">--}}
{{--                                                                        <input type="radio" id="inverse_theme"--}}
{{--                                                                               name="theme" class="custom-control-input"--}}
{{--                                                                               value="inverse"--}}
{{--                                                                            {{(isset($configData) and $configData->bellPrompt->theme == "inverse") ? "checked" : ""}}/>--}}
{{--                                                                        <label class="custom-control-label"--}}
{{--                                                                               for="inverse_theme">Inverse</label>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <hr/>--}}

{{--                                                            <!-- Position -->--}}
{{--                                                            <div class="customizer-footer px-2">--}}
{{--                                                                <p class="font-weight-bold">Position</p>--}}
{{--                                                                <div class="d-flex">--}}
{{--                                                                    <div class="custom-control custom-radio mr-1">--}}
{{--                                                                        <input type="radio" id="bottom_right"--}}
{{--                                                                               name="position"--}}
{{--                                                                               class="custom-control-input"--}}
{{--                                                                               value="bottom-right"--}}
{{--                                                                            {{(isset($configData) and $configData->bellPrompt->position == "bottom-right") ? "checked" : ""}} />--}}
{{--                                                                        <label class="custom-control-label"--}}
{{--                                                                               for="bottom_right">Bottom right</label>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="custom-control custom-radio mr-1">--}}
{{--                                                                        <input type="radio" id="bottom_left"--}}
{{--                                                                               name="position"--}}
{{--                                                                               class="custom-control-input"--}}
{{--                                                                               value="bottom-left"--}}
{{--                                                                            {{(isset($configData) and $configData->bellPrompt->position == "bottom-left") ? "checked" : ""}}/>--}}

{{--                                                                        <label class="custom-control-label"--}}
{{--                                                                               for="bottom_left">Bottom left</label>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <hr/>--}}
{{--                                                            <!-- Start: Instruction -->--}}
{{--                                                            <div class="customizer-footer">--}}
{{--                                                                <div class="row">--}}
{{--                                                                    <div class="col-12">--}}
{{--                                                                        <div class="form-group">--}}
{{--                                                                            <label for="bellPromptActionMessage">Update--}}
{{--                                                                                instruction</label>--}}
{{--                                                                            <textarea--}}
{{--                                                                                class="form-control"--}}
{{--                                                                                id="bellPromptActionMessage",--}}
{{--                                                                                name="bell_prompt_action_message"--}}
{{--                                                                                rows="3"--}}
{{--                                                                                placeholder="Instruction Message">{{(isset($configData) and $configData->bellPrompt->message != "") ? $configData->bellPrompt->message : "Subscribe to notifications"}}</textarea>--}}
{{--                                                                            <span class="text-danger error-text bell_prompt_action_message_err"></span>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <hr/>--}}
{{--                                                            <!-- End: Instruction -->--}}

{{--                                                        </div>--}}
{{--                                                        <!-- End: Bell prompt -->--}}

{{--                                                        <!-- BEGIN: Slide prompt -->--}}
{{--                                                        <div class="slide_prompt d-none">--}}
{{--                                                            <div class="col-12">--}}
{{--                                                                <div class="customizer-footer">--}}
{{--                                                                    <div class="row">--}}
{{--                                                                        <div class="col-12">--}}
{{--                                                                            <div class="form-group">--}}
{{--                                                                                <label for="actionMessage">Update--}}
{{--                                                                                    instruction</label>--}}
{{--                                                                                <textarea--}}
{{--                                                                                    class="form-control"--}}
{{--                                                                                    id="slidePromptActionMessage"--}}
{{--                                                                                    name="slide_prompt_action_message"--}}
{{--                                                                                    rows="3"--}}
{{--                                                                                    placeholder="Instruction Message"--}}
{{--                                                                                >{{(isset($configData) and $configData->slidePrompt->message != "") ? $configData->slidePrompt->message : "We'd like to show you notifications for the latest news and updates."}}</textarea>--}}
{{--                                                                                <span class="text-danger error-text slide_prompt_action_message_err"></span>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}

{{--                                                                    <div class="row">--}}
{{--                                                                        <div class="col-sm-6 col-12">--}}
{{--                                                                            <label for="acceptButton">Positive--}}
{{--                                                                                button</label>--}}
{{--                                                                            <input--}}
{{--                                                                                type="text"--}}
{{--                                                                                class="form-control is-valid"--}}
{{--                                                                                id="acceptButton"--}}
{{--                                                                                name="accept_button"--}}
{{--                                                                                placeholder="Accept"--}}
{{--                                                                                value="{{(isset($configData) and $configData->slidePrompt->acceptButton != "") ? $configData->slidePrompt->acceptButton : "Accept"}}"--}}
{{--                                                                                required--}}
{{--                                                                            />--}}
{{--                                                                            <span class="text-danger error-text accept_button_err"></span>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="col-sm-6 col-12">--}}
{{--                                                                            <label for="cancelButton">Negative--}}
{{--                                                                                button</label>--}}
{{--                                                                            <input--}}
{{--                                                                                type="text"--}}
{{--                                                                                class="form-control is-invalid"--}}
{{--                                                                                id="cancelButton"--}}
{{--                                                                                name="cancel_button"--}}
{{--                                                                                placeholder="Cancel"--}}
{{--                                                                                value="{{(isset($configData) and $configData->slidePrompt->cancelButton != "") ? $configData->slidePrompt->cancelButton : "Cancel"}}"--}}
{{--                                                                                required--}}
{{--                                                                            />--}}
{{--                                                                            <span class="text-danger error-text cancel_button_err"></span>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <hr/>--}}
{{--                                                        </div>--}}
{{--                                                        <!-- End: Slide prompt -->--}}

{{--                                                        <div class="col-12 text-right">--}}
{{--                                                            <button--}}
{{--                                                                class="btn btn-primary waves-effect waves-float waves-light"--}}
{{--                                                                id="bell_button">--}}
{{--                                                                Update--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </form>--}}
{{--                                                </div>--}}
{{--                                                --}}{{-- End: Configuration --}}
{{--                                            </div>--}}

{{--                                            <div class="col-lg-8 col-md-4 col-sm-12 pl-3">--}}
{{--                                                <!-- Tabs with Icon starts -->--}}
{{--                                                <div class="col-xl-12 col-lg-12">--}}
{{--                                                    <div class="card">--}}
{{--                                                        <div class="card-header">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="card-body">--}}
{{--                                                            <ul class="nav nav-tabs nav-tabs-menu" role="tablist"--}}
{{--                                                                style="margin: 3px 0 20px 12px !important">--}}
{{--                                                                <li class="nav-item">--}}
{{--                                                                    <a--}}
{{--                                                                        class="nav-link active"--}}
{{--                                                                        id="homeIcon-tab"--}}
{{--                                                                        data-toggle="tab"--}}
{{--                                                                        href="#homeIcon"--}}
{{--                                                                        aria-controls="home"--}}
{{--                                                                        role="tab"--}}
{{--                                                                        aria-selected="true"--}}
{{--                                                                    >--}}
{{--                                                                        <i data-feather="code"></i>--}}
{{--                                                                        <strong>--}}
{{--                                                                            Custom site--}}
{{--                                                                        </strong>--}}
{{--                                                                    </a>--}}
{{--                                                                </li>--}}
{{--                                                                <li class="nav-item">--}}
{{--                                                                    <a--}}
{{--                                                                        class="nav-link"--}}
{{--                                                                        id="profileIcon-tab"--}}
{{--                                                                        data-toggle="tab"--}}
{{--                                                                        href="#profileIcon"--}}
{{--                                                                        aria-controls="profile"--}}
{{--                                                                        role="tab"--}}
{{--                                                                        aria-selected="false"--}}
{{--                                                                    ><i data-feather="cloud"></i>--}}
{{--                                                                        <strong>--}}
{{--                                                                            Configure WordPress Plugin--}}
{{--                                                                        </strong>--}}
{{--                                                                    </a>--}}
{{--                                                                </li>--}}
{{--                                                            </ul>--}}
{{--                                                            <div class="tab-content">--}}
{{--                                                                <div class="tab-pane active" id="homeIcon"--}}
{{--                                                                     aria-labelledby="homeIcon-tab" role="tabpanel">--}}

{{--                                                                    <div class="code-wrapper">--}}
{{--                                                                        <div class="card light-gray-bg">--}}
{{--                                                                            <div class="card-body">--}}
{{--                                                                                <div class="code-inner">--}}
{{--                                                                                    @include('.web-app.side-message.http-web-push-side')--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="tab-pane" id="profileIcon"--}}
{{--                                                                     aria-labelledby="profileIcon-tab" role="tabpanel">--}}

{{--                                                                    <div class="code-wrapper">--}}
{{--                                                                        <div class="card light-gray-bg">--}}
{{--                                                                            <div class="card-body">--}}
{{--                                                                                <div class=" code-inner">--}}
{{--                                                                                    @include('.web-app.side-message.wp-instruction')--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}


{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <!-- Tabs with Icon ends -->--}}

{{--                                                --}}{{--                                                @include('.web-app.side-message.http-web-push-side')--}}

{{--                                                <div class="code-spainer-inner">--}}
{{--                                                    --}}{{--                                                                                                        @include('.web-app.side-message.http-web-push-side')--}}
{{--                                                    <div class="btn-holder mb-3">--}}
{{--                                                        --}}{{--                                                        <button class="btn btn-info">Copy Code</button>--}}
{{--                                                    </div>--}}
{{--                                                    <!-- end btn-holder  -->--}}

{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                        </div>--}}
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

            </div>
            <!-- end card  -->
        </section>
        <!-- end section  -->
    </main>

@endsection

@section('vendor-script')


@endsection
@section('page-script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>
        hljs.highlightAll();

        let notificationTypeButton = 'input[type=radio][name="notification_type"]';
        let slide_prompt = $(".slide_prompt");
        let bell_prompt = $(".bell_prompt");
        var alert_config_form = $(".alert_config_form");

        if ($("input[name='notification_type']:checked")) {
            let notificationType = $("input[name='notification_type']:checked").val();
            conditionallyRenderConfigForm(notificationType)
        }

        $(notificationTypeButton).change(function () {
            let notificationType = $(this).val();

            conditionallyRenderConfigForm(notificationType)
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

        if (alert_config_form.length) {

            alert_config_form.validate({
                errorClass: 'error',
                rules: {
                    'bell_prompt_action_message': {
                        required: true,
                        minlength: 6,
                        maxlength: 150,
                    },
                    'slide_prompt_action_message': {
                        required: true,
                        minlength: 6,
                        maxlength: 150,
                    },
                    'accept_button': {
                        required: true,
                        minlength: 1,
                        maxlength: 30,
                    },
                    'cancel_button': {
                        required: true,
                        minlength: 1,
                        maxlength: 30,
                    },
                },
                messages: {
                    bell_prompt_action_message: {
                        required : "Instruction message can not be empty.",
                        minlength : "Instruction message should be minimum 6 characters.",
                        maxlength : "Instruction message must not be greater than 150 characters."
                    },
                    slide_prompt_action_message: {
                        required : "Instruction message can not be empty.",
                        minlength : "Instruction message should be minimum 6 characters.",
                        maxlength : "Instruction message must not be greater than 150 characters."
                    },
                    accept_button: {
                        required : "Positive button can not be empty.",
                        minlength : "Positive button should be minimum at least 1 characters.",
                        maxlength : "Positive button must not be greater than 30 characters."
                    },
                    cancel_button: {
                        required : "Negative button can not be empty.",
                        minlength : "Negative button should be minimum at least 1 characters.",
                        maxlength : "Negative button must not be greater than 30 characters."
                    },

                },
                errorPlacement: function (error, element) {
                    var name = $(element).attr("name");
                    $("." + name + "_err").html("")
                    error.appendTo($("." + name + "_err"));
                },
            });
        }

        $("#bell_button").on('click', function (e) {
            e.preventDefault()
            let isValid = alert_config_form.valid();

            if(isValid){
                blockUICustom()
                let notification_type = $("input[name='notification_type']:checked").val();
                let data = updatePromptData(notification_type)

                let response = $.makeAjaxRequest('web-app-config-setup', 'POST', data)

                if (response.status === $.Response.HTTP_OK) {
                    $("#code_script").html(response.data.data)
                    $("#shareCaption").html(response.data.data)
                    reCopy()
                    // Reset all form input value
                    $.showSuccessAlert(response.message)
                    $.unblockUI()
                }
            }
        })

        function reCopy() {
            $(".re_copy").removeClass("d-none").addClass("d-block");

            setTimeout(function () {
                $(".re_copy").removeClass("d-block").addClass("d-none");
            },15000)
        }

        function updatePromptData(notificationType) {
            return {
                app_id: "{!! $appId !!}",
                type: notificationType,
                size: $("#size option:selected").val(),
                theme: $("input[name='theme']:checked").val(),
                position: $("input[name='position']:checked").val(),
                bellPromptActionMessage: $("#bellPromptActionMessage").val(),
                slidePromptActionMessage: $("#slidePromptActionMessage").val(),
                acceptButton: $("#acceptButton").val(),
                cancelButton: $("#cancelButton").val(),
            };
        }

        function updateSlidePromptData(notificationType) {
            return {
                bellPromptActionMessage: $("#slidePromptActionMessage").val(),
                acceptButton: $("#acceptButton").val(),
                cancelButton: $("#cancelButton").val(),
            };
        }

        function conditionallyRenderConfigForm(notificationType) {
            if (parseInt(notificationType) === 1) {
                slide_prompt.removeClass("d-block").addClass("d-none")
                bell_prompt.removeClass("d-none").addClass("d-block")

            } else {
                slide_prompt.removeClass("d-none").addClass("d-block")
                bell_prompt.removeClass("d-block").addClass("d-none")
            }
        }

        /*=========================================================================================
           Action : Copy code from App Configuration
        ==========================================================================================*/
        const copyCaption = () => {
            /* Get the text field */
            var copyText = document.getElementById("shareCaption");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* notify the user that the text has been copied */
            document.querySelector(".copy__btn").innerText = "Text Copied!"

            setTimeout(function () {
                document.querySelector(".copy__btn").innerText = "Copy Code"
            },2000)

        }

        /*=========================================================================================
           Action : Copy input field value by click button
           Parameters : copiedArea,copiedButton
           Description: copiedArea => The text need to copy, copiedButton => The button will fire event for copyAppKey
        ==========================================================================================*/
        const copyAppKey = (copiedArea,copiedButton) => {

            /* Get the text field */
            var copyText = $(copiedArea);


            /* Select the text field */
            copyText.select();

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* notify the user that the text has been copied */
            document.querySelector(copiedButton).innerText = "Text Copied!"

            setTimeout(function () {
                document.querySelector(copiedButton).innerText = "Copy!"
            },2000)
        }

    </script>

@endsection
