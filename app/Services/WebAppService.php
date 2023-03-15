<?php

namespace App\Services;


use App\Contracts\Repositories\GatewayProviderRepository;
use App\Contracts\Repositories\ProcessOverallStateCountDailyRepository;
use App\Contracts\Repositories\UserBalanceLimitsRepository;
use App\Contracts\Repositories\WebAppRepository;
use App\Contracts\Services\UserBalanceLimitContract;
use App\Contracts\Services\WebAppContract;
use App\Helpers\Helper;
use App\Models\WebApp;
use App\Traits\GenerateGraphReport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

class WebAppService implements WebAppContract
{
    use GenerateGraphReport;

    private WebAppRepository $webAppRepository;

    public function __construct(WebAppRepository $webAppRepository)
    {
        $this->webAppRepository = $webAppRepository;
    }

    /**
     * @param $webAppId
     * @return array
     */
    public function webAppDeleteRequest($webAppId): array
    {
        $response = $this->webAppRepository->statusChangeForDelete($webAppId);

        if ($response) {
            return Helper::RETURN_SUCCESS_FORMAT(200, 'Web app delete successfully !!');
        }

        return Helper::RETURN_ERROR_FORMAT(404);
    }

    /**
     * @param $userId
     * @param $appId
     * @return array
     */
    public function getUserWebAppData($userId, $appId): array
    {
        $response = $this->webAppRepository->getUserWebAppData([
            'id' => $appId,
            'user_id' => $userId
        ]);

        if ($response) {
            return Helper::RETURN_SUCCESS_FORMAT(200, 'Web app data list !!', $response);
        }

        return Helper::RETURN_ERROR_FORMAT(422);
    }

    /**
     * @param Request $request
     * @return array
     */


    /**
     * @param Request $request
     * @return string[]
     */
    private function imageUploadForWebApp(Request $request): array
    {
        $file = $request->file('file');

        $fileName = Helper::getCustomFileName($file);

        $response = Helper::Upload($file, $fileName, 'browser/');

        return $response['data'];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function createWebApp(Request $request): array
    {
        try {

            $validator = Validator::make($request->all(), [
//                'file' => 'mimes:jpeg,jpg,png|required|max:1000|min:100' // max 10000kb
                'file' => 'mimes:jpeg,jpg,png|max:1000|min:100' // max 10000kb
            ]);


            if (!$validator->passes()) {
                $validatorMessage = $validator->errors()->toArray();
                return Helper::RETURN_ERROR_FORMAT(422, $validatorMessage['file'][0]);
            }

            $where = [
                'user_id' => $request['user_id'],
                'balance_key' => 1
            ];

            $selectData = [
                'current_balance'
            ];


            $checkBalance = App::make(UserBalanceLimitsRepository::class)->getUserBalanceLimit($selectData, $where);

            if ($checkBalance && $checkBalance->current_balance == 0) {

                App::make(UserBalanceLimitContract::class)->decrementSingleDataByUserIdAndKey($request['user_id'], 1);

                return Helper::RETURN_ERROR_FORMAT(422, 'You have insufficient balance !!');
            }



            if (!is_null($request->file('file'))) {
                // after upload image
                $request['chrome_web_default_notification_icon'] = $this->imageUploadForWebApp($request)['url'];
            }

            // oneSignal implement
            $oneSignal = new OneSignalService();
            $oneSignalCredential = $this->getOneSignalCredential();

            $oneSignalResponse = $oneSignal->setUserAuth($oneSignalCredential['user_auth'])
                ->createAppData($request)
                ->createApp()
                ->getResponse();

            $responseData = json_decode($oneSignalResponse, true);


            if ($responseData) {
                if (isset($responseData['errors'])) {
                    return Helper::RETURN_ERROR_FORMAT(422, $responseData['errors'][0]);
                }

                $configData = $this->updateCodeConfigData($request['chrome_web_default_notification_icon']);

                $response = $this->webAppRepository->create([
                    'user_id' => $request['user_id'],
                    'app_id' => $responseData['id'],
                    'app_rest_api_key' => $responseData['basic_auth_key'],
                    'app_name' => $request['name'],
                    'chrome_web_origin' => $request['chrome_web_origin'],
                    'chrome_web_default_notification_icon' => $request['chrome_web_default_notification_icon'],
                    'chrome_web_sub_domain' => $request['chrome_web_sub_domain'],
                    'onesignal_response' => $oneSignalResponse,
                    'notification_alert_config_code' => json_encode($configData),
                ]);

                if ($response) {

                    $this->balanceDecrease($request['user_id']);

                    // Update code config

                    $dateTime = date("Y-m-d");
                    //Update overall state count reports [Date and app id wise total_player and total_messageable players]
                    $dataUpdate = [
                        'total_project' => 1
                    ];
                    $dataInsert = [
                        'user_id' => $request['user_id'],
                        'app_id' => $responseData['id'],
                        'daily_date' => $dateTime,
                        'total_project' => 1
                    ];

                    $this->updateOrCreateOverallStateCount($request['user_id'], $responseData['id'], $dateTime, $dataUpdate, $dataInsert);


                    return Helper::RETURN_SUCCESS_FORMAT(200, 'Web app created successfully !!', [
                        'app_id' => $responseData['id'],
                        'app_rest_api_key' => $responseData['basic_auth_key'],
                        'app_name' => $request['name'],
                        'chrome_web_origin' => $request['chrome_web_origin'],
                    ]);
                }
            }

            return Helper::RETURN_ERROR_FORMAT(422,"Web app create failed");

        } catch (\Exception $e) {
            Log::error('Error in create web apps', [$e->getMessage()]);
            return Helper::RETURN_ERROR_FORMAT(422);
        }

    }

    /**
     * @param $userId
     * @return array
     */
    public function balanceDecrease($userId): array
    {
        $where = [
            'user_id' => $userId,
            'balance_key' => 1
        ];

        $selectData = [
            'current_balance'
        ];

        $checkBalance = App::make(UserBalanceLimitsRepository::class)->getUserBalanceLimit($selectData, $where);

        if ($checkBalance && $checkBalance->current_balance > 0) {

            App::make(UserBalanceLimitContract::class)->decrementSingleDataByUserIdAndKey($userId, 1);

            return Helper::RETURN_SUCCESS_FORMAT(200, 'Balance decrement successfully');
        }

        return Helper::RETURN_ERROR_FORMAT(422, 'You have insufficient balance !!');

    }


    /**
     * @return string[]
     */
    public function getOneSignalCredential(): array
    {
        $where = ['provider_type' => GATEWAY_PROVIDER_TYPE_IS_ONESIGNAL];// onesignal provider
        $select = ['provider_credentials'];
        $data = App::make(GatewayProviderRepository::class)->getSpecificDataByWhere($where, $select);

        $apiKey = "";

        if ($data) {
            $provider_credentials = json_decode($data->provider_credentials);
            if (isset($provider_credentials)) {
                $apiKey = $provider_credentials->api_key ?? "";
            }
        }

        return [
            'user_auth' => $apiKey,
        ];
    }

    private function updateCodeConfigData($image)
    {
        $codeConfig = array(
            "type" => isset($request->type) ? $request->type : 1, ///bellPrompt
            "bellPrompt" => array(
                "theme" => isset($request->theme) ? $request->theme : "default",// One of 'default' (red-white) or 'inverse" (white-red) /
                "position" => isset($request->position) ? $request->position : "bottom-right",// Either 'bottom-left' or 'bottom-right' /
                "size" => isset($request->size) ? $request->size : "medium",// One of 'small', 'medium', or 'large' /
                "message" => isset($request->bellPromptActionMessage) ? $request->bellPromptActionMessage : "Subscribe to notifications",
            ),
            "slidePrompt" => array(
                "acceptButton" => isset($request->acceptButton) ? $request->acceptButton : "Allow-me",
                "cancelButton" => isset($request->cancelButton) ? $request->cancelButton : "Not interested",
                "message" => isset($request->slidePromptActionMessage) ? $request->slidePromptActionMessage : "We'd like to show you notifications for the latest news and updates.",
            ),
            "notification_icon" => $image
        );
        return $codeConfig;
    }

    private function updateOrCreateOverallStateCount($userId, $appId, $dateTime, $dataUpdate, $dataInsert)
    {
        $where = ['user_id' => $userId, 'app_id' => $appId, 'daily_date' => $dateTime];
        $select = ['id'];
        // check data exits
        $dailyProcessData = App::make(ProcessOverallStateCountDailyRepository::class)->getSpecificDataByWhere($where, $select);

        if ($dailyProcessData) {
            App::make(ProcessOverallStateCountDailyRepository::class)->updateByWhere($where, $dataUpdate);
        } else {
            App::make(ProcessOverallStateCountDailyRepository::class)->createData($dataInsert);
        }
    }

    /**
     * @param $userId
     * @return JsonResponse
     * @throws \Exception
     */
    public function basicWebProjectListDataTable($userId): JsonResponse
    {

        $response = $this->webAppRepository->basicSelectDataForDataTable(['id', 'app_name', 'app_id', 'players', 'messageable_players', 'status'],
            [
                'user_id' => $userId,
                'status' => WebApp::ACTIVE
            ]);

        return Datatables::of($response)
            ->addColumn('app_name', function ($response) {
                $app = '
                    <div class="d-flex align-items-center">
                    <div class="avatar rounded">
                        <div class="avatar-content">
                            <img src="' . asset('images/logo/favicon-16x16.png') . '" alt="Toolbar svg">
                        </div>
                    </div>
                        <div>
                            <div class="font-weight-bolder">' . $response->app_name . '</div>
                            <div class="font-small-2 mailto:text-muted">' . $response->app_id . '</div>
                            <div class="font-small-2 text-warning">Created at: ' . Helper::date_format_for_date($response->create_at, "jS M Y h:i:s A") . '</div>
                        </div>
                    </div>
                ';
                return '<a href="' . route('user.app-dashboard-view', [$response->app_id]) . '"  target="blank">  ' . $app . ' </a>';
            })
            ->addColumn('players', function ($response) {
                return '<span class="font-weight-bolder mb-25"> ' . $response->players . ' </span>';
            })
            ->addColumn('messageable_players', function ($response) {
                return '<span class="font-weight-bolder mb-25"> ' . $response->messageable_players . ' </span>';
            })
            ->addColumn('status', function ($response) {

                $status = <<<TEXT
                            <div class="btn btn-sm bg-primary text-white">
                                Active
                            </div>
                        TEXT;

                if ($response->status == STATUS__ACTIVE) {
                    $status = <<<TEXT
                            <div class="btn btn-sm bg-danger text-white">
                                INACTIVE
                            </div>
                        TEXT;
                }
                return $status;
            })
            ->addColumn('action', function ($response) {

                $action = '
                        <div class="btn-group">
                            <a href="" class="dropdown-toggle hide-arrow" data-toggle="dropdown">
                                <span class="">
                                    <i class="fa fa-ellipsis-v" class="avatar-icon"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">

                                <a href="' . route('web-app-edit', [$response->app_id]) . '" class="btn btn-sm dropdown-item ">
                                    <i class="fa fa-pencil-alt" class="avatar-icon mr-2"></i> Rename
                                </a>

                                 <a href="' . route('user.app-dashboard-view', [$response->app_id]) . '" class="btn btn-sm dropdown-item " target="blank">
                                    <i class="fa fa-gift" class="avatar-icon"></i> Open Dashboard
                                 </a>
                                 <a href="javascript:void(0)" class="btn btn-sm dropdown-item delete-app" data-id = "' . $response->id . '">
                                    <i class="fa fa-trash-alt" class="avatar-icon"></i> Delete
                                  </a>

                            </div>
                        </div>
                        ';

                return $action;
            })
            ->rawColumns(['app_name', 'players', 'messageable_players', 'status', 'action'])
            ->make(true);
    }

    /**
     * Get Web/Project List DataTable
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function getWebProjectListDataTable(Request $request)
    {
        $where = [];
        if (isset($request->user_id) and !empty($request->user_id)) {
            $where = ['user_id' => $request->user_id];
        }

        $select = ['id', 'user_id', 'app_name', 'app_id', 'players', 'messageable_players', 'status', 'created_at'];

        $response = $this->webAppRepository->getSelectDataForDataTable($request['from_date'], $request['to_date'], $where, $select);

        return Datatables::of($response)
            ->addColumn('app_info', function ($response) {
                $app = '
                    <div class="d-flex align-items-center">
                    <div class="avatar rounded">
                        <div class="avatar-content">
                            <img src="' . asset('images/logo/favicon-16x16.png') . '" alt="Toolbar svg">
                        </div>
                    </div>
                        <div>
                            <a href="' . route('admin.app-dashboard-view', [$response->app_id]) . '" title="App Dashboard"  target="blank">
                                <div class="font-weight-bolder">' . $response->app_name . '</div>
                                <div class="font-small-2 mailto:text-muted font-weight-bold">' . $response->app_id . '</div>
                            </a>
                             <a href="' . route('admin.user-wise-project-list-view', [$response->user_id]) . '"  target="blank" title="User Web Apps Report">
                             <div class="font-small-2 mailto:text-muted font-weight-bold">Created by: ' . $response->user->email . '</a></div>
                            <div class="font-small-2 text-warning">Created at: ' . Helper::date_format_for_date($response->created_at, "jS M Y h:i:s A") . '</div>
                        </div>
                    </div>
                ';
                return $app;
            })
            ->addColumn('players', function ($response) {
                return $response->players;
            })
            ->addColumn('messageable_players', function ($response) {
                return $response->messageable_players;
            })
            ->addColumn('create_at', function ($response) {
                return Helper::date_format_for_date($response->created_at, "jS M Y h:i:s A");
            })
            ->addColumn('status', function ($response) {

                $status = <<<TEXT
                            <span class="v-chip v-theme--light text-danger v-chip--density-default v-chip--size-small v-chip--variant-outlined" draggable="false"><!----><span class="v-chip__underlay"></span>Inactive</span>
                        TEXT;

                if ($response->status == STATUS__ACTIVE) {
                    $status = <<<TEXT
                            <span class="v-chip v-theme--light text-success v-chip--density-default v-chip--size-small v-chip--variant-outlined" draggable="false"><!----><span class="v-chip__underlay"></span>Active</span>
                        TEXT;
                }
                return $status;
            })
            ->addColumn('action', function ($response) {

                $action = '<a class="v-btn v-btn--icon v-theme--light text-default v-btn--density-default v-btn--size-x-small v-btn--variant-text"
                            href="' . route('admin.app-dashboard-view', [$response->app_id]) . '" title="Open App Dashboard">
                            <span class="v-btn__overlay"></span>
                            <span class="v-btn__underlay"></span>
                            <span class="v-btn__content" data-no-activator="">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                tag="i" class="v-icon notranslate v-theme--light iconify iconify--tabler" width="1em" height="1em" viewBox="0 0 24 24"
                                style="font-size: 22px; height: 22px; width: 22px;"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <circle cx="12" cy="12" r="2"></circle>
                                <path d="M22 12c-2.667 4.667-6 7-10 7s-7.333-2.333-10-7c2.667-4.667 6-7 10-7s7.333 2.333 10 7"></path></g>
                                </svg>
                            </span>
                            </a> ';

                return $action;
            })
            ->rawColumns(['app_info', 'user_info', 'players', 'messageable_players', 'status', 'action', 'create_at'])
            ->make(true);
    }

    /**
     * Get specific web app wise state count data
     * @param string $webAppId
     * @return array
     */
    public function webAppStateCountDataReportByWebAppId(string $webAppId): array
    {
        try {
            if (empty($webAppId) or $webAppId == "") {
                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_BAD_REQUEST, 'Web app id is required.');
            }
            $select = ['players', 'messageable_players'];
            $where = ['app_id' => $webAppId];

            $response = $this->webAppRepository->getAllCountDataByWhere($where, $select);

            $data = [];
            if ($response) {
                $data['subscriptions'] = $response->players;
                $data['activeSubscriptions'] = $response->messageable_players;
                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Web app state count data found.', $data);
            } else {
                $data['subscriptions'] = 0;
                $data['activeSubscriptions'] = 0;
                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Web app state count data found.', $data);
            }


        } catch (\Exception $e) {
            return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_BAD_REQUEST, 'Web app state count data not found..');
        }

    }

    /**
     * Get user graph data
     * @param Request $request
     * @return array
     */
    public function getSpecificAppWiseSubscriptionDataGraphReport(Request $request)
    {
        try {
            $dateDurationType = $request['duration_type'];
            $singleDate = $request['singleDate'];
            $firstDate = $request['from_date'];
            $secondDate = $request['to_date'];
            $dayDifference = $request['difference'];

            $selectArray = [
                'total_players',
                'total_messageable_players'
            ];

            $selectRawQueryString = "SUM(" . $selectArray[0] . ") as " . $selectArray[0] . ",
                 SUM(" . $selectArray[1] . ") as " . $selectArray[1];

            $where = [
                'app_id' => $request['app_id']
            ];

            // Duration type : day,week,month,year . Difference : Difference between selected days
            list($dateDurationType, $dayDifference) = $this->setAndGetDifferenceAndDurationTYpe($request['difference']);
            // Format from_date ,to_date based on $dateDurationType and $difference
            list($fromDate, $toDate) = $this->getFormattedFromDateToDate($firstDate, $secondDate, $dateDurationType, $dayDifference, $singleDate);

            // Query request for graph data
            $response = App::make(ProcessOverallStateCountDailyRepository::class)->getGraphDataByConditionAndBetweenDate($where, $dateDurationType, $fromDate, $toDate, $selectRawQueryString);

            // Generate a graph report array based on $dateDurationType,$difference,$selectArray using GenerateGraphReport.php trait


            $graphReport = $this->getGraphReportData($response, $fromDate, $dateDurationType, $dayDifference, $selectArray);


            if ($graphReport) {
                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Graph report data found', $graphReport);
            }

            return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_BAD_REQUEST, 'Graph report data not found');

        } catch (\Exception $e) {
            Log::error('Error in ', [$e->getMessage(), $e->getLine()]);

            return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_BAD_REQUEST, 'Graph report data not found');
        }
    }

    /**
     * @param $id
     * @param $userId
     * @return mixed
     */
    public function getSingleWebAppData($appId, $userId): mixed
    {
        return $this->webAppRepository->getOne([
            'user_id' => $userId,
            'app_id' => $appId
        ]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function publicImageUpload(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            'file' => 'mimes:jpeg,jpg,png|required|max:1000|min:100' // max 10000kb
        ]);


        if (!$validator->passes()) {
            $validatorMessage = $validator->errors()->toArray();
            return Helper::RETURN_ERROR_FORMAT(422, $validatorMessage['file'][0]);
        }



        $url = $this->imageUploadForWebApp($request)['url'];

        return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Uploaded file url', [
            'url' => $url
        ]);

    }

    public function webAppNotificationAlertConfigCode(Request $request)
    {
        try {
            $where = [
                'app_id' => $request->app_id
            ];

            $selectAppsData = ['app_id', 'notification_alert_config_code', 'chrome_web_default_notification_icon'];
            $appConfigData = App::make(WebAppRepository::class)->getSpecificAppData($where, $selectAppsData);

            $codeConfig = array(
                "type" => isset($request->type) ? $request->type : 1, ///bellPrompt
                "bellPrompt" => array(
                    "theme" => isset($request->theme) ? $request->theme : "default",// One of 'default' (red-white) or 'inverse" (white-red) /
                    "position" => isset($request->position) ? $request->position : "bottom-right",// Either 'bottom-left' or 'bottom-right' /
                    "size" => isset($request->size) ? $request->size : "medium",// One of 'small', 'medium', or 'large' /
                    "message" => isset($request->bellPromptActionMessage) ? $request->bellPromptActionMessage : "Subscribe to notifications",
                ),
                "slidePrompt" => array(
                    "acceptButton" => isset($request->acceptButton) ? $request->acceptButton : "Allow-me",
                    "cancelButton" => isset($request->cancelButton) ? $request->cancelButton : "Not interested",
                    "message" => isset($request->slidePromptActionMessage) ? $request->slidePromptActionMessage : "We'd like to show you notifications for the latest news and updates.",
                ),
                "notification_icon" => $appConfigData->chrome_web_default_notification_icon
            );

            $data = [
                'notification_alert_config_code' => json_encode($codeConfig)
            ];
            $where = [
                'app_id' => $request->app_id
            ];

            $response = $this->webAppRepository->updateWebApp($where, $data);

            if ($response) {

                $selectAppsData = ['app_id', 'notification_alert_config_code', 'chrome_web_default_notification_icon'];
                $response = App::make(WebAppRepository::class)->getSpecificAppData($where, $selectAppsData);
                $configData = json_decode($response->notification_alert_config_code);

                $script = $this->formatConfigData($configData, $request->app_id);
                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Web apps configuration code successfully updated', $script);
            }

            return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_BAD_REQUEST, 'Web apps configuration code updated failed');
        } catch (\Exception $e) {
            Log::error('Error in : ', [$e->getMessage(), $e->getLine()]);
            return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_BAD_REQUEST, 'Web apps configuration code updated failed');
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function updateWebApp(Request $request): array
    {
        if (!is_null($request->file('file'))) {
            // after upload image
            $validator = Validator::make($request->all(), [
                'file' => 'mimes:jpeg,jpg,png|required|max:1000|min:100' // max 10000kb
            ]);


            if (!$validator->passes()) {
                $validatorMessage = $validator->errors()->toArray();
                return Helper::RETURN_ERROR_FORMAT(422, $validatorMessage['file'][0]);
            }

            $request['chrome_web_default_notification_icon'] = $this->imageUploadForWebApp($request)['url'];
        }

        $oneSignal = new OneSignalService();
        $oneSignalCredential = $this->getOneSignalCredential();

        $oneSignalResponse = $oneSignal->setUserAuth($oneSignalCredential['user_auth'])
            ->setAppId($request['app_id'])
            ->createAppData($request)
            ->updateApp()
            ->getResponse();

        $responseData = json_decode($oneSignalResponse, true);

        if (isset($responseData['errors'])) {
            return Helper::RETURN_ERROR_FORMAT(422, 'Authorization problem. Please contact with admin,');
        }

        $response = $this->webAppRepository->updateWebApp([
            'id' => $request['id'],
            'user_id' => $request['user_id'],
        ], [
            'app_id' => $responseData['id'],
            'app_name' => $responseData['name'],
            'chrome_web_origin' => $responseData['chrome_web_origin'],
            'chrome_web_default_notification_icon' => $request['chrome_web_default_notification_icon'],
            'chrome_web_sub_domain' => $request['chrome_web_sub_domain'],
            'onesignal_response' => $oneSignalResponse,
        ]);

        if ($response) {
            // Update code config
            $this->updateCodeConfigData($request['chrome_web_default_notification_icon']);

            return Helper::RETURN_SUCCESS_FORMAT(200, 'Web app data list !!', [
                'app_id' => $responseData['id'],
                'app_rest_api_key' => $responseData['basic_auth_key'],
                'app_name' => $request['name'],
                'chrome_web_origin' => $request['chrome_web_origin'],
            ]);
        }

        return Helper::RETURN_ERROR_FORMAT(422,"Web app update failed");
    }

    public function formatConfigData($configData, string $appId)
    {
        try {
            $script = "";

            if ($configData) {
                if ($configData->type == 1) {
                $script = '&lt;script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""> &lt;/script&gt;
                   &ltscript&gt;
                      window.OneSignal = window.OneSignal || [];
                      OneSignal.push(function() {
                          OneSignal.init({
                              appId: "' . $appId . '",
                              allowLocalhostAsSecureOrigin: true,
                                    notifyButton: {
                                    enable: true,
                                    size: "' . $configData->bellPrompt->size . '",
                                    theme:"' . $configData->bellPrompt->theme . '",
                                    position: "' . $configData->bellPrompt->position . '",
                                    text: {
                                        "tip.state.unsubscribed": "' . $configData->bellPrompt->message . '",
                                    }
                              },
                          });
                      });
                 &lt;/script&gt;
                 ';

                } else {

                $script = '
                 &lt;script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""&gt &lt/script&gt;
                   &lt;script&gt;
                      window.OneSignal = window.OneSignal || [];
                      OneSignal.push(function() {
                          OneSignal.init({
                              appId: "' . $appId . '",
                              allowLocalhostAsSecureOrigin: true,
                             promptOptions: {
                                slidedown: {
                                    prompts: [
                                        {
                                        type: "push",
                                        autoPrompt: true,
                                        icon:"' . $configData->notification_icon . '",
                                        text: {
                                            actionMessage: "'.$configData->slidePrompt->message.'",
                                            acceptButton: "'.$configData->slidePrompt->acceptButton.'",
                                            cancelButton: "'.$configData->slidePrompt->cancelButton.'",
                                        }
                                        },

                                    ]
                                }
                            }
                          });
                      });
                 &lt;/script&gt;
                 ';
                }
            } else {
                $script = '
                &lt;script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""&gt; &lt;/script&gt;
                   &lt;script&gt;
                      window.OneSignal = window.OneSignal || [];
                      OneSignal.push(function() {
                          OneSignal.init({
                              appId: "' . $appId . '",
                              allowLocalhostAsSecureOrigin: true,
                                    notifyButton: {
                                    enable: true,
                                    size: "medium",
                                    theme:"default",
                                    position: "bottom-right",
                                    text: {
                                        "tip.state.unsubscribed": "Subscribe to notifications",
                                    }
                              },
                          });
                      });
                 &lt/script&gt;
                 ';
            }


            return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Web apps configuration data found', $script);

        } catch (\Exception $exception) {
            Log::error('Error in : ', [$exception->getMessage(), $exception->getLine()]);
            return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_BAD_REQUEST, 'Web apps configuration get failed');
        }
    }

    public function getConfigData(string $appId)
    {
        try {
            $selectAppsData = ['app_id', 'notification_alert_config_code','app_rest_api_key','chrome_web_origin'];
            $where = ['app_id' => $appId];
            $response = App::make(WebAppRepository::class)->getSpecificAppData($where, $selectAppsData);

            if ($response) {
                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Web apps configuration data found', $response);
            }

            return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_BAD_REQUEST, 'Web apps configuration data not found');
        } catch (\Exception $exception) {
            Log::error('Error in : ', [$exception->getMessage(), $exception->getLine()]);
            return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_BAD_REQUEST, 'Web apps configuration cget failed');
        }
    }
}
