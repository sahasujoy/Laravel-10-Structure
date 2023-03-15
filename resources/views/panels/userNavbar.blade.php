@if($configData["mainLayoutType"] === 'horizontal' && isset($configData["mainLayoutType"]))
    <nav
        class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center {{ $configData['navbarColor'] }}"
        data-nav="brand-center">
{{--        d-none--}}
        <div class="navbar-header d-xl-block">
            <ul class="nav navbar-nav">
                <li class="nav-item logo-nav-inner d-flex justify-content-center align-items-center px-3">
                    <a class="navbar-brand" href="{{url('/')}}">
                         <span class="brand-logo">
                            <a class="navbar-brand" href="{{url('/')}}">
{{--                                <img src="{{ asset('images/logo/' . env('MAIN_LOGO')) }}" style="width: 180px">--}}
                                <img src="https://app.pusholk9.com/images/logo/site-logo.png" style="max-width: 180px" class="img-fluid ">
                            </a>
                         </span>
                    </a>
                </li>
            </ul>
        </div>
        @else
            <nav class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }}">
                @endif
                <div class="navbar-container d-flex content">

                    <div class="bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block ">
                                <a href="{{route('user-dashboard')}}" type="button" class="btn btn-outline-primary waves-effect">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home mr-25"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    <span></span>
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-language ml-1 selected-nav-menu">
                                <select class="select2 form-control form-control-lg app_list" id="app_list">
                                    <option value="" selected disabled>
                                        No selected
                                    </option>
                                    @foreach(\App\Helpers\Helper::getAppList() as $app)
                                        <option value="{{$app->app_id}}">
                                            {{$app->app_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </li>
{{--                            d-none d-lg-block--}}

                        </ul>

                    </div>

                    <ul class="nav navbar-nav align-items-center ml-auto">

                        <li class="nav-item dropdown dropdown-user">
                            <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user"
                               href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">

                                <div class="user-nav d-sm-flex d-none">
                                    <span class="user-name font-weight-bolder"> {{ auth()->user()->first_name }} </span>
                                </div>

                                <span class="avatar">
                                  @if(!is_null(auth()->user()->avatar) and !empty(auth()->user()->avatar))
                                        <img class="round" src="{{ auth()->user()->avatar }}" alt="avatar" height="40"
                                             width="40">
                                    @else
                                        <img class="round"
{{--                                             src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" --}}
                                             src="{https://app.pusholk9.com/images/logo/site-logo.png"
                                             alt="avatar" height="40"
                                             width="40">
                                    @endif
                                  <span class="avatar-status-online"></span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">

                                <a class="dropdown-item" href="{{route('user-profile-settings')}}">
                                    <i class="mr-50" data-feather="settings" class></i> Profile
                                </a>
                                <div class="dropdown-divider"></div>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{route('user-log-out')}}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="mr-50" data-feather="power"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('user-log-out') }}" method="POST"
                                      class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- END: Header-->



