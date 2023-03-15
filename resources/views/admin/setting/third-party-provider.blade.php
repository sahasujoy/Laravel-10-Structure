@extends('admin/layouts/adminContentLayoutMaster')

@section('title', $pageConfigs['title'])


@section('content')

    <div class="row match-height">

        @php
            $fromEmail = "";
            $apiKeySendgrid = "";
            $apiKeyRemoveBg = "";
            $apiNameRemoveBg = "";

        @endphp

        @if(isset($getAllProvider))
            @foreach($getAllProvider as $item)
                @php
                    $provider_credentials =  json_decode($item->provider_credentials);
                @endphp

                @if($item->provider_type == GATEWAY_PROVIDER_TYPE_IS_ONESIGNAL)
                    @php

                        if(isset($provider_credentials)){
                            $apiNameRemoveBg = isset( $provider_credentials->api_name) ?  $provider_credentials->api_name : "";
                            $apiKeyRemoveBg = isset($provider_credentials->api_key) ? $provider_credentials->api_key : "";
                        }
                    @endphp
                    <!-- Bg remove Card -->

                    <!--/ Bg remove Card -->
                @elseif($item->provider_type == GATEWAY_PROVIDER_TYPE_IS_SENDGRID)
                    @php
                            if(isset($provider_credentials)){
                                $fromEmail = isset($provider_credentials->sender_address) ? $provider_credentials->sender_address : "";
                                $apiKeySendgrid = isset($provider_credentials->api_key) ? $provider_credentials->api_key : "";
                            }
                    @endphp

                @endif
            @endforeach
        @endif

            <div class="col-lg-4 col-md-6 col-12">
                <div class="card card-payment">
                    <div class="card-header">
                        <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="147" height="33" viewBox="0 0 304 68"><path d="M30 1.4C21.8 3.2 17.1 5.8 10.9 12-1.6 24.4-3 44.4 7.8 58.4c2 2.7 4.9 5.8 6.3 6.9 2.7 1.9 2.7 1.9 9.2-.7 3.6-1.4 7.5-2.6 8.6-2.6 2 0 2.1-.5 2.1-11 0-6.7-.4-11-1-11-.5 0-1-.9-1-2 0-1.8.7-2 5.5-2H43v25.5l6.3 2.3c3.4 1.3 7 2.5 7.9 2.8 2.7.9 10.4-7 14.1-14.5 2.8-5.8 3.2-7.5 3.2-15.1s-.3-9.3-3.3-15.2C63.5 6.1 46.4-2.3 30 1.4zm16.8 14.2c4.9 2 10 7 12.3 11.9 2.4 5.2 2.4 13.8 0 19-2.7 6-12.8 14.2-14.9 12.1-.4-.5.4-1.6 1.8-2.5C56.9 49 60.5 40.2 57 29.6 54.2 21 42.7 15 33.1 17.1c-19.6 4.2-21.8 31.2-3.2 38.8 1.7.8 3.1 2 3.1 2.7 0 1.2-.6 1.2-3.7-.1-5.5-2.3-7.9-4-10.6-7.7C7.3 35.4 18.1 14 37.3 14c3.2 0 7.4.7 9.5 1.6zm-2.7 9.9C48 27.6 51 32.6 51 37.1c0 3.6-3.4 9.9-5.7 10.7-1.9.6-1.6-1.7.7-4.5 6.4-8.1-2.7-19.9-12.3-16-7.3 3.1-9.1 11.4-3.7 16.9 3.1 3.1 3.8 4.8 1.9 4.8-2.2 0-6.8-5.8-7.4-9.4-2.1-10.9 9.6-19.2 19.6-14.1zm253.9 8c0 15.8.1 16.5 2 16.5s2-.7 2-16.5-.1-16.5-2-16.5-2 .7-2 16.5zM106.1 19.1c-13.2 2.8-16.5 21.1-5.2 28.6 6.6 4.5 17.4 2.4 21.7-4.2 7.9-12.1-2.3-27.4-16.5-24.4zm11.3 4.2c10.4 7.3 5 24.7-7.7 24.7-7.4 0-12.8-5.5-12.9-13-.1-11.9 11.1-18.3 20.6-11.7zm72.6-4.1c-4.3 1.2-6.9 4.3-7 8.4 0 3.6 2.9 6.6 8.1 8.3 5.3 1.7 7.5 4.4 6.1 7.6-.9 2-1.9 2.5-4.8 2.5-2.1 0-4.5-.7-5.4-1.5-1.5-1.4-1.9-1.3-3.4.3-1.5 1.8-1.5 2 0 3.2.8.8 4.1 1.6 7.2 1.8 4.7.3 6.2 0 8.3-1.7 5.5-4.3 4.5-11.7-1.9-14.6-7.3-3.2-8.7-4.1-9-6.2-.2-1.4.5-2.7 2.1-3.8 2.3-1.4 2.9-1.5 6.1-.1 3.3 1.4 3.7 1.4 4.6-.4.8-1.5.6-2.1-.7-2.8-3.2-1.6-6.7-2-10.3-1zm18.4 1.3c-.4.9-.2 2.1.4 2.7 1.6 1.6 4.7.5 4.7-1.7 0-2.6-4.2-3.4-5.1-1zm-71.1 9.7c-1.3.6-2.3 1.5-2.3 2 0 .4-.4.8-1 .8-.5 0-1-.7-1-1.5s-.4-1.5-1-1.5-1 4-1 10c0 8.2.3 10 1.5 10s1.5-1.5 1.5-7.5c0-8.3 1.8-11.5 6.4-11.5 4 0 5.6 3.5 5.6 11.7 0 4.2.4 7.3 1 7.3 1.2 0 1.4-15.9.2-17.7-.7-1.1-5.6-3.4-7-3.2-.4 0-1.7.5-2.9 1.1zm24.1-.3c-3.2 1.4-6.4 6-6.4 9.3 0 6.1 4.4 10.7 10.1 10.8 3.7 0 9.1-3.2 7.7-4.6-.5-.4-1.6 0-2.6.9-1.9 1.7-5.7 2.2-8.7 1.1-1.4-.6-4.5-5.3-4.5-6.9 0-.3 3.8-.5 8.5-.5 8.3 0 8.5 0 8.5-2.4 0-5.4-7.4-9.9-12.6-7.7zm8.5 3.7c1.2 1.5 2.1 3.1 2.1 3.5 0 .5-3.4.9-7.5.9-7.5 0-7.6 0-6.4-2.3 2.9-5.3 8.5-6.3 11.8-2.1zm39.1 5.9c0 9.8.1 10.5 2 10.5s2-.7 2-10.5-.1-10.5-2-10.5-2 .7-2 10.5zm13.7-8c-3 3-3.8 6.6-2.6 11.1 1.8 6.2 8.9 9.4 13.5 5.9 1-.8 2.3-1.5 2.8-1.5 1.4 0-.3 6.4-2.1 7.7-2.1 1.6-6.7 1.7-9.4.2-2.9-1.5-5.7.7-3.6 2.9 2.1 2 10 2.7 13.7 1.2 4.9-2 6-5.4 6-18.5 0-10.8-.1-11.5-2-11.5-1.1 0-2 .7-2 1.6 0 1.4-.2 1.4-2.2 0-3.5-2.5-9.1-2-12.1.9zm11.8 3c4.6 4.5 1.9 11.5-4.4 11.5-5.9 0-8.3-8.1-3.5-11.9 3.4-2.7 5-2.6 7.9.4zm13.5 5c0 9.8.1 10.5 2 10.5 1.8 0 2-.7 2-7 0-5.7.4-7.4 2-9 1.1-1.1 2.5-2 3-2 .6 0 1.9.9 3 2 1.6 1.6 2 3.3 2 9 0 6.3.2 7 2 7s2-.7 2-8.5c0-7.2-.3-8.8-2-10.5-2.4-2.4-7.7-2.6-10.2-.3-1.7 1.5-1.8 1.5-1.8 0 0-1-.8-1.7-2-1.7-1.9 0-2 .7-2 10.5zm27.4-9.1c-2.9 2.2-.7 3.9 3.2 2.4 3.6-1.3 5.8-.7 7.3 2 1 1.8.6 2-4.3 2.6-8.5 1.1-12.1 6.1-7.6 10.6 2.4 2.4 7.7 2.6 10.8.4 2-1.4 2.2-1.4 2.2 0 0 1 .9 1.6 2.1 1.6 2 0 2.1-.4 1.8-8.6-.4-7.6-.7-8.8-2.8-10.5-2.8-2.3-9.8-2.6-12.7-.5zm11.2 11.2c-.3.9-.6 2-.6 2.4 0 1.6-4.1 3.2-6.6 2.6-2.9-.8-3.2-4-.6-5.5.9-.6 3.2-1.1 5.1-1.1 2.6 0 3.2.3 2.7 1.6z"/></svg>

                        {{--                                <h4 class="card-title">BG removal</h4>--}}
                        <div class="custom-control custom-control-primary custom-switch">
{{--                            <input type="checkbox" name="onesignal_status" checked class="custom-control-input onesignal-status-change-click08" id="customSwitch3" />--}}
{{--                            <label class="custom-control-label" for="customSwitch3"></label>--}}
                        </div>
                    </div>
                    <div class="card-body">
                        <form  class="form onesignal-provider-integration-form">
                            <input type="hidden" name="provider_type" value="1">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <label for="api-name"> Name</label>
                                        <input type="text" id="api-name" class="form-control"
                                               name="api_name" placeholder="Api name" value="{{$apiNameRemoveBg}}" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <label for="api-key">Auth Key</label>
                                        <input type="text" id="api-key" class="form-control"
                                               name="api_key" placeholder="2133324445678921" value="{{$apiKeyRemoveBg}}" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block button-submit_1">
                                        <div style="display:none;" class="spinner-border spinner-border-sm button-loader_1" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div> Save Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--Sendgrid Card -->
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card card-payment">
                    <div class="card-header">
                        <svg width="147" height="33" viewBox="0 0 147 33">
                            <g fill="none" fill-rule="evenodd">
                                <path d="M50.803 22.808c.61-1.366 1.89-2.296 3.575-2.296 1.686 0 2.936.785 3.46 2.296h-7.035Zm11.045 1.744c0-4.185-3.052-7.528-7.499-7.528a7.542 7.542 0 0 0-7.557 7.558c0 4.185 3.14 7.557 7.674 7.557 3.14 0 5.399-1.515 6.67-3.687l-3.159-1.883c-.67 1.286-1.956 2.082-3.482 2.082-2.093 0-3.4-1.047-3.866-2.645h11.22v-1.454Zm81.068 0c0-2.15-1.57-3.894-3.72-3.894-2.21 0-3.895 1.656-3.895 3.894 0 2.238 1.686 3.924 3.895 3.924 2.15 0 3.72-1.773 3.72-3.924Zm-11.51.03c0-5.145 3.779-7.558 7.063-7.558 1.89 0 3.372.698 4.33 1.715V10.63h3.983v21.218H142.8V30.22c-.96 1.134-2.5 1.919-4.389 1.919-3.081 0-7.005-2.442-7.005-7.557Zm-2.925-9.479a2.382 2.382 0 1 0 0-4.764 2.382 2.382 0 0 0 0 4.764Zm-1.991 2.212h3.982v14.533h-3.982V21.18h-1.445l1.445-3.866Zm-10.608 0h3.953V19.7c.727-1.512 2.035-2.384 4.011-2.384h1.599l-1.444 3.866h-1.085c-2.122 0-3.052 1.104-3.052 3.807v6.86h-3.982V17.315ZM93.481 21.24c0-6.046 4.563-10.9 10.841-10.9 3.14 0 5.781 1.131 7.693 2.933a10.556 10.556 0 0 1 1.957 2.503l-3.546 2.15c-1.308-2.412-3.313-3.662-6.075-3.662-3.865 0-6.86 3.168-6.86 6.976 0 3.895 2.937 6.976 7.006 6.976 3.08 0 5.26-1.744 6.016-4.447h-6.656v-3.866h11.016v1.628c0 5.697-4.069 10.609-10.376 10.609-6.627 0-11.016-5.029-11.016-10.9Zm-4.8 3.313c0-2.15-1.57-3.894-3.72-3.894-2.21 0-3.895 1.656-3.895 3.894 0 2.238 1.686 3.924 3.895 3.924 2.15 0 3.72-1.773 3.72-3.924Zm-11.51.03c0-5.145 3.778-7.558 7.063-7.558 1.889 0 3.371.698 4.33 1.715v-8.11h3.983v21.218h-3.982V30.22c-.96 1.134-2.5 1.919-4.39 1.919-3.08 0-7.004-2.442-7.004-7.557Zm-14.392-7.267h3.953v1.628c.93-1.192 2.355-1.919 4.011-1.919 3.43 0 5.494 2.21 5.494 5.959v8.865h-4.04v-8.342c0-1.947-.901-3.081-2.674-3.081-1.512 0-2.762 1.046-2.762 3.488v7.935H62.78V17.315ZM30.267 28.331l3.691-2.907c1.046 1.803 2.703 2.849 4.592 2.849 2.064 0 3.169-1.337 3.169-2.79 0-1.744-2.122-2.296-4.39-2.994-2.848-.872-6.016-1.977-6.016-6.046 0-3.4 2.965-6.104 7.063-6.104 3.459 0 5.435 1.308 7.15 3.081l-3.342 2.529c-.872-1.308-2.122-2.006-3.779-2.006-1.89 0-2.906 1.018-2.906 2.355 0 1.627 2.034 2.18 4.301 2.935 2.878.93 6.133 2.21 6.133 6.279 0 3.371-2.674 6.627-7.354 6.627-3.836 0-6.394-1.628-8.312-3.808Z" fill="#212F38"/>
                                <path fill="#9DD6E3" d="M8.53 31.848h8.486V23.36H8.53zM.043 23.361h8.486v-8.487H.043z"/>
                                <path fill="#3F72AB" d="M.043 31.848H8.53V23.36H.043z"/>
                                <path fill="#00A9D1" d="M17.016 23.361h8.487v-8.487h-8.487zM8.53 14.875h8.486V6.388H8.53z"/>
                                <path fill="#2191C4" d="M8.53 23.361h8.486v-8.487H8.53z"/>
                                <path fill="#3F72AB" d="M17.016 14.875h8.487V6.388h-8.487z"/>
                                <path fill="#212F38" d="M34.27 1.26v4.948h-1.144V1.261h-1.764V.27h4.678l-.002.99H34.27m10.113 4.948h-1.085l-1.316-4.32-1.317 4.32H39.59L37.93.243l1.202.016 1.103 4.202 1.24-4.19h1.144l1.239 4.19 1.084-4.19h1.144l-1.703 5.937m3.961 0h1.144V.271h-1.144zm3.796 0V.271h1.144V5.2h1.98l.01 1.007H52.14m5.509.001h1.144V.271H57.65zM64 1.106c-1.015 0-1.626.834-1.626 2.134 0 1.3.61 2.134 1.626 2.134 1.024 0 1.635-.835 1.635-2.134 0-1.3-.62-2.134-1.635-2.134m-.008 5.214c-1.687 0-2.78-1.239-2.78-3.072 0-1.841 1.101-3.089 2.797-3.089 1.704 0 2.779 1.239 2.779 3.072s-1.093 3.09-2.796 3.09"/>
                            </g>
                        </svg>

                        {{--                                <h4 class="card-title">SENDGRID</h4>--}}
                        <div class="custom-control custom-control-primary custom-switch">
{{--                            <input type="checkbox" checked class="custom-control-input sendgrid-status-change-click" id="customSwitch3" />--}}
{{--                            <label class="custom-control-label" for="customSwitch3"></label>--}}
                        </div>
                    </div>
                    <div class="card-body">
                        <form  class="form sendgrid-provider-integration-form">
                            <input type="hidden" name="provider_type" value="2">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <label for="api-name"> From Mail</label>
                                        <input type="text" id="api-name" class="form-control"
                                               name="sender_address" placeholder="From mail address" value="{{$fromEmail}}"
                                        />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <label for="api-key">Api Key</label>
                                        <input type="text" id="api-key" class="form-control"
                                               name="api_key" placeholder="2133324445xxxxxxxx" value="{{$apiKeySendgrid}}" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block button-submit_2">
                                        <div style="display:none;" class="spinner-border spinner-border-sm button-loader_2" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div> Save Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/ Sendgrid Card -->

    </div>

    <!--/ Card Advance -->
@endsection

@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/pages/integration/integration.js')) }}"></script>
@endsection
