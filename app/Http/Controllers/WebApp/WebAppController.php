<?php

namespace App\Http\Controllers\WebApp;

use App\Contracts\Repositories\UserBalanceLimitsRepository;
use App\Contracts\Services\WebAppContract;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class WebAppController extends Controller
{
    protected WebAppContract $webAppContract;

    public function __construct(WebAppContract $webAppContract)
    {
        $this->webAppContract = $webAppContract;

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteWebApp(Request $request): JsonResponse
    {
        $response = $this->webAppContract->webAppDeleteRequest($request['id']);

        return response()->json($response);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserWebAppData(Request $request): JsonResponse
    {
        return response()->json($this->webAppContract->getUserWebAppData($request['user_id'], $request['app_id']));
    }

    public function createWebApp(Request $request): JsonResponse
    {
        $request['user_id'] = auth()->id();
        return response()->json($this->webAppContract->createWebApp($request));
    }

    public function updateWebApp(Request $request): JsonResponse
    {
        $request['user_id'] = auth()->id();
        return response()->json($this->webAppContract->updateWebApp($request));
    }

    /**
     * @param $appId
     * @return Application|Factory|View
     */
    public function webAppEdit($appId): View|Factory|Application
    {
        $response = $this->webAppContract->getSingleWebAppData($appId, auth()->id());

        $app = Helper::getAppInfo(['app_id' => $appId], ['app_name']);
        $appDashboardRoute = "app/dashboard/" . $appId;
        $prevUrl = url()->previous();

        $breadcrumbs = [
            ['link' => "app", 'name' => "Web Apps"],
            ['name' => $app->app_name],
            ['link' => $appDashboardRoute, 'name' => "Web App Dashboard"]
        ];
        $pageConfigs = ['pageHeader' => true, 'title' => 'Setting'];


        $button = '<a href="' . route('user.app-dashboard-view',$appId) . '" type="button" class="btn btn-primary waves-effect waves-float waves-light">
                    <i class="mr-50" data-feather="arrow-left-circle"></i>
                    <span>Back to dashboard</span>
                </a>';

        return view('web-app.web-app-edit')->with([
            'data' => $response,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'button' => $button,
        ]);
    }

    public function messageView($appId): View|Factory|Application
    {
        $app = Helper::getAppInfo(['app_id' => $appId], ['app_name']);
        $appDashboardRoute = "app/dashboard/" . $appId;

        $breadcrumbs = [
            ['link' => "app", 'name' => "Web Apps"],
            ['name' => $app->app_name],
            ['link' => $appDashboardRoute, 'name' => "Web App Dashboard"]
        ];


        $pageConfigs = ['pageHeader' => true, 'title' => 'New Message'];

        $balance = 0;
        $current_balance = 0;

        $userBalanceLimits = App::make(UserBalanceLimitsRepository::class)->getUserBalanceLimit(['*'], [
            'user_id' => auth()->id(),
            'balance_key' => 2,
        ]);

        if (!is_null($userBalanceLimits)) {
            $balance = $userBalanceLimits->balance;
            $current_balance = $userBalanceLimits->current_balance;
        }

        $percentageData = (($current_balance * 100) / $balance);
        $percentageDataCurrentBalance = number_format((float)($percentageData), 2, '.', '');
        $percentageLabelColor = 'primary';
        if ($percentageDataCurrentBalance < 50 && $percentageDataCurrentBalance > 10) {
            $percentageLabelColor = 'warning';
        } else if ($percentageDataCurrentBalance < 10 && $percentageDataCurrentBalance > 0) {
            $percentageLabelColor = 'danger';
        }


        $button = '
                    <a href="' . route('broadcast-list-view', $appId) . '"type="button" class="btn btn-primary waves-effect waves-float waves-light">
                                        <i class="mr-50" data-feather="arrow-left-circle"></i>
                                        <span>Back to message list</span>
                                </a>

    ';

        return view('web-app.web-app-message')->with([
            'appId' => $appId,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'button' => $button,
            'balance' => $balance,
            'current_balance' => $current_balance,
            'percentageLabelColor' => $percentageLabelColor,
            'percentageDataCurrentBalance' => $percentageDataCurrentBalance,
        ]);
    }


    public function viewList()
    {
        $breadcrumbs = [
            ['link' => "app", 'name' => "User"]
        ];

        $pageConfigs = ['pageHeader' => true, 'title' => 'User dashboard'];

        return view('web-app.view-list')->with([
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    public function webAppList(Request $request): JsonResponse
    {
        $request['user_id'] = auth()->id();

        return $this->webAppContract->basicWebProjectListDataTable($request['user_id']);
    }

    /**
     * @return Application|Factory|View
     */
    public function createWebAppView()
    {
        $balance = 0;
        $current_balance = 0;

        $userBalanceLimits = App::make(UserBalanceLimitsRepository::class)->getUserBalanceLimit(['*'], [
            'user_id' => auth()->id(),
            'balance_key' => 1,
        ]);

        if (!is_null($userBalanceLimits)) {
            $balance = $userBalanceLimits->balance;
            $current_balance = $userBalanceLimits->current_balance;
        }

        $breadcrumbs = [
            ['link' => "app", 'name' => "Web Apps"]
        ];

        $pageConfigs = ['pageHeader' => true, 'title' => 'New Web App'];
        $percentageData = (($current_balance * 100) / $balance);
        $percentageDataCurrentBalance = number_format((float)($percentageData), 2, '.', '');
        $percentageLabelColor = 'primary';
        if ($percentageDataCurrentBalance < 50 && $percentageDataCurrentBalance > 10) {
            $percentageLabelColor = 'warning';
        } else if ($percentageDataCurrentBalance < 10 && $percentageDataCurrentBalance > 0) {
            $percentageLabelColor = 'danger';
        }

        $button = '
                     <div class="profile-polls-info mt-2">
                               <a href="' . route('user-dashboard') . '" type="button" class="btn btn-primary waves-effect waves-float waves-light">
                                        <i class="mr-50" data-feather="arrow-left-circle"></i>
                                        <span>Back to app list</span>
                                </a>
                                  <!-- custom radio -->
                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="custom-control">
                                            <label class="text-left " for=""> Apps Limit : <span class="badge badge-light-success badge-pill font-medium-1 "> ' . $balance . '</span></label>
                                        </div>
                                        <label class="text-right"><span class="font-weight-bold">Remaining  apps :</span> <span class="badge badge-light-' . $percentageLabelColor . ' badge-pill font-medium-1 ">' . $current_balance . '</span></label>
                                    </div>
                                    <!--/ custom radio -->

                                            <!-- progressbar -->
                                    <div class="progress progress-bar-' . $percentageLabelColor . ' my-50" style="font-weight: 600;height: 13px;">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="' . $current_balance . '" aria-valuemin="' . $current_balance . '" aria-valuemax="' . $balance . '" style="width: ' . $percentageDataCurrentBalance . '%">' . $percentageDataCurrentBalance . '%</div>
                                    </div>
                                    <!--/ progressbar -->
                                </div>


    ';

        return view('web-app.create-web-app')->with([
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'button' => $button,
            'balance' => $balance,
            'current_balance' => $current_balance,
        ]);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function webAppcodeShow($appId)
    {

        $pageConfigs = ['pageHeader' => true, 'title' => 'Delivery Report'];

        $button = '<a href="' . route('web-app-v-list') . '" type="button" class="btn btn-primary waves-effect waves-float waves-light">
                    <i class="mr-50" data-feather="arrow-left-circle"></i>
                    <span>Back to app list</span>
                </a>';

        $app = App::make(WebAppContract::class)->getConfigData($appId);

        $configData = $app['data']->notification_alert_config_code;

        $defaultConfigData = Helper::getDefaultConfigData();

        $script = App::make(WebAppContract::class)->formatConfigData(json_decode($configData), $appId);

        return view('web-app.code-show')->with([
            'appId' => $appId,
            'script' => $script['data'],
            'appData' => $app['data'],
            'configData' => $configData != "" ? json_decode($configData) : (object)$defaultConfigData,
            'pageConfigs' => $pageConfigs,
            'button' => $button,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function publicImageUpload(Request $request): JsonResponse
    {
        $request['user_id'] = auth()->id();
        return response()->json($this->webAppContract->publicImageUpload($request));

    }

    public function downloadOneSignalSdkFile(): BinaryFileResponse
    {
        return response()->download(public_path('OneSignalSDK.zip'));
    }

    public function webAppNotificationAlertConfigCode(Request $request)
    {
        $request['user_id'] = auth()->id();
        return $this->webAppContract->webAppNotificationAlertConfigCode($request);
    }


}
