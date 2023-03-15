<?php

namespace App\Http\Controllers\V1\User\Subscription;

use App\Contracts\Services\PlayerContract;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    private PlayerContract $playerContract;

    public function __construct(PlayerContract $playerContract)
    {
        $this->playerContract = $playerContract;
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function index($appId)
    {
        $app = Helper::getAppInfo(['app_id' => $appId], ['app_name']);

        $breadcrumbs = [
            ['link' => "web/app/v", 'name' => "Web Apps"],
            ['name' => $app->app_name]
        ];
        $pageConfigs = ['pageHeader' => true, 'title' => 'Subscription'];

        $button = '<a href="' . route('web-app-message',$appId) . '" type="button" class="btn btn-primary waves-effect waves-float waves-light">
                    <i class="mr-50" data-feather="plus-circle"></i>
                    <span>New Message</span>
                </a>';

        return view('subscription.report-subscription')->with([
            'appId' => $appId,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'button' => $button,
        ]);
    }

    public function subscriptionList(Request $request)
    {

        $request['user_id'] = auth()->id();

        return $this->playerContract->playerList($request['user_id'], $request['app_id']);

    }

    public function subscriptionListOneSignal(Request $request)
    {

        $request['user_id'] = auth()->id();

        return response()->json($this->playerContract->deviceList($request));

    }

}
