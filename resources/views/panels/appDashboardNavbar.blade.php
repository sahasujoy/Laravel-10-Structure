<!-- Nav Tabs starts -->
<section id="nav-filled">
    <div class="row match-height">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-justified" id="myTab2" style="font-size: 12px">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->route()->getName() == 'user.app-dashboard-view' ? 'active' : '' }}"
                               id="homeIcon-tab"
                               href="{{route('user.app-dashboard-view',$appId)}}"
                               aria-controls="home"
                               aria-selected="true">
                                <i data-feather="home" class="font-medium-3"></i> <strong>Dashboard</strong>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->route()->getName() == 'broadcast-list-view' ? 'active' : '' }}"
                               id="homeIcon-tab"
                               href="{{route('broadcast-list-view',$appId)}}"
                               aria-controls="home"
                               aria-selected="true">
                                <i data-feather="mail" class="font-medium-3"></i> Messages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->route()->getName() == 'report-subscription' ? 'active' : '' }}"
                               id="homeIcon-tab"
                               href="{{route('report-subscription',$appId)}}"
                               aria-controls="home"
                               aria-selected="true">
                                <i data-feather="airplay" class="font-medium-3"></i> Devices
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->route()->getName() == 'segment-view' ? 'active' : '' }}"
                               id="homeIcon-tab"
                               href="{{route('segment-view',$appId)}}"
                               aria-controls="home"
                               aria-selected="true">
                                <i data-feather='users'></i> Segment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->route()->getName() == 'report-delivery-view' ? 'active' : '' }}"
                               id="homeIcon-tab"
                               href="{{route('report-delivery-view',$appId)}}"
                               aria-controls="home"
                               aria-selected="true">
                                <i data-feather="send" class="font-medium-3"></i> Delivery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->route()->getName() == 'web-app-edit' ? 'active' : '' }}"
                               id="homeIcon-tab"
                               href="{{route('web-app-edit',$appId)}}"
                               aria-controls="home"
                               aria-selected="true">
                                <i data-feather="settings"></i> Edit App
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Nav Tabs ends -->

