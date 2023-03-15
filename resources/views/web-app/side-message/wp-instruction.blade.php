<div class="report-content">
    <ol>
        <li>
            Install oneSignal push notification and activate <a class="tip-icon tip-docs"
                       href="https://wordpress.org/plugins/onesignal-free-web-push-notifications" target="_new">
                WordPress plugin</a> on your Wordpress blog.
        </li>

        <li>Once installed, copy both(App ID and REST API Key) keys.
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-uppercase font-weight-bold">App Id</div>
                            <div class="row">
                                <div class="col-xl-9 col-md-4 col-sm-6 col-12 pr-sm-0">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="app_auth_key"
                                               value="{{$appData->app_id}}"/>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-12">
                                    <button class="btn btn-outline-primary" id="auth-btn-copy" onclick="copyAppKey('#app_auth_key','#auth-btn-copy')">Copy!</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-uppercase font-weight-bold">Rest Api key</div>
                            <div class="row">
                                <div class="col-xl-9 col-md-4 col-sm-6 col-12 pr-sm-0">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="api_key"
                                               value="{{isset($appData->app_rest_api_key) ? $appData->app_rest_api_key : ""}}"/>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-12">
                                    <button class="btn btn-outline-primary" id="api-btn-copy" onclick="copyAppKey('#api_key','#api-btn-copy')" >Copy!</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-uppercase font-weight-bold">Safari Web ID</div>
                            <div class="row">
                                <div class="col-xl-9 col-md-4 col-sm-6 col-12 pr-sm-0">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="safari_web_id" value=""/>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-12">
                                    <button class="btn btn-outline-primary" id="safari-web-btn-copy" onclick="copyAppKey('#safari_web_id','#safari-web-btn-copy')">Copy!</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </li>

        <li class="font-medium-2">
           <spa></spa> Paste these keys into your WordPress plugin Configure tab(<b>Configuration > Account Settings.</b>) in the appropriate inputs:
        </li>

        <li class="font-medium-2">
            <img src="{{ asset('images/wpPlugin/wp_1.png')}}" class="img-fluid">
        </li>

{{--        <li class="font-medium-2">--}}
{{--            <strong>--}}
{{--                Turn on Push Prompts--}}
{{--            </strong>--}}
{{--            <p>--}}
{{--                Enable the Slide Prompt and Subscription Bell Prompt. These prompts allow you to ask site visitors--}}
{{--                permission to send them push notifications, making them push subscribers to your site.--}}
{{--            </p>--}}
{{--            <img src="{{ asset('images/wpPlugin/wp_2.png')}}" class="img-fluid">--}}
{{--        </li>--}}

{{--        <li class="font-medium-2">--}}
{{--            <strong>--}}
{{--                Finish and Save Your Settings--}}
{{--            </strong>--}}
{{--            <p>--}}
{{--                Be sure to Save your configuration at the bottom of the plugin once you've added these keys.--}}
{{--            </p>--}}
{{--            <img src="{{ asset('images/wpPlugin/wp_3.png')}}" class="img-fluid">--}}
{{--        </li>--}}


    </ol>


</div>
