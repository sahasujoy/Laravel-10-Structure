<?php

namespace App\Http\Controllers\V1\User\Broadcast;

use App\Contracts\Repositories\UserBalanceLimitsRepository;
use App\Contracts\Services\BroadcastContract;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BroadcastController extends Controller
{
    private BroadcastContract $broadcastContract;

    /**
     * @param BroadcastContract $broadcastContract
     */
    public function __construct(BroadcastContract $broadcastContract)
    {
        $this->broadcastContract = $broadcastContract;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getBroadcastList(Request $request): \Illuminate\Http\JsonResponse
    {
        $request['user_id'] = auth()->id();

        return $this->broadcastContract->getBroadcastList($request['user_id'], $request['app_id'], $request['send_type']);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function broadcastDelete(Request $request): \Illuminate\Http\JsonResponse
    {
        $request['user_id'] = auth()->id();
        return response()->json($this->broadcastContract->broadcastDelete($request['user_id'], $request['id']));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createBroadcast(Request $request): JsonResponse
    {
        $request['user_id'] = auth()->id();
        return response()->json($this->broadcastContract->createBroadcast($request));
    }

    /**
     * Specific Notification report view
     * @param $appId
     * @return Application|Factory|View
     */
    public function notificationReportView($appId, $notificationId)
    {
        $prevUrl = url()->previous();
        $app = Helper::getAppInfo(['app_id' => $appId], ['app_name']);

        $breadcrumbs = [
            ['link' => "web/app/v", 'name' => "Apps"],
            ['link' => $prevUrl, 'name' => $app->app_name],
            ['name' => "Report"]
        ];

        $pageConfigs = ['pageHeader' => true, 'title' => 'Message Report'];


        $button = '<a href="' . route('web-app-message', $appId) . '" type="button" class="btn btn-primary waves-effect waves-float waves-light">
                    <i class="mr-50" data-feather="plus-circle"></i>
                    <span>New Message</span>
                </a>';

        return view('user.notification.notification-report',
            [
                'pageConfigs' => $pageConfigs,
                'appId' => $appId,
                'notificationId' => $notificationId,
                'breadcrumbs' => $breadcrumbs,
                'button' => $button,
            ]
        );
    }

    /**
     * Specific report count
     * @param Request $request
     * @return JsonResponse
     */
    public function specificNotificationStateCountDataReport(Request $request)
    {
        $webAppId = $request->web_app_id;
        $notificationId = $request->notification_id;

        $response = $this->broadcastContract->getSpecificBroadcastReport($notificationId, $webAppId);

        return response()->json($response);
    }

    /**
     * Broadcast list view
     * @param $appId
     * @return Application|Factory|View
     */
    public function index($appId)
    {
        $app = Helper::getAppInfo(['app_id' => $appId], ['app_name']);

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


        $breadcrumbs = [
            ['link' => "web/app/v", 'name' => "Web Apps"],
            ['name' => $app->app_name ]
        ];
        $pageConfigs = ['pageHeader' => true, 'title' => 'Messages'];

        $percentageData = (($current_balance * 100) / $balance);
        $percentageDataCurrentBalance = number_format((float)($percentageData), 2, '.', '');
        $percentageLabelColor = 'primary';
        if($percentageDataCurrentBalance < 50 && $percentageDataCurrentBalance > 10){
            $percentageLabelColor = 'warning';
        }else if($percentageDataCurrentBalance < 10 && $percentageDataCurrentBalance > 0) {
            $percentageLabelColor = 'danger';
        }

        $button = '
                    <div class="profile-polls-info mt-2">
                                 <a href="' . route('web-app-message', $appId) . '" type="button" class="btn btn-primary waves-effect waves-float waves-light">
                                        <i class="mr-50" data-feather="plus-circle"></i>
                                        <span>New Message</span>
                                </a>
                                  <!-- custom radio -->
                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="custom-control">
                                            <label class="text-left " for=""> Message Limit : <span class="badge badge-light-success badge-pill font-medium-1 "> ' . $balance . '</span></label>
                                        </div>
                                        <label class="text-right"><span class="font-weight-bold">Remaining  message :</span> <span class="badge badge-light-'.$percentageLabelColor.' badge-pill font-medium-1 ">' . $current_balance . '</span></label>
                                    </div>
                                    <!--/ custom radio -->

                                            <!-- progressbar -->
                                    <div class="progress progress-bar-'.$percentageLabelColor.' my-50" style="font-weight: 600;height: 13px;">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="' .$current_balance.'" aria-valuemin="' .$current_balance.'" aria-valuemax="' .$balance.'" style="width: ' .$percentageDataCurrentBalance.'%">'.$percentageDataCurrentBalance.'%</div>
                                    </div>
                                    <!--/ progressbar -->
                                </div>


    ';

        return view('user.broadcast.broadcast')->with([
            'appId' => $appId,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'button' => $button,
        ]);
    }

}
