<?php

namespace App\Http\Controllers\V1\User\DeliveryReport;

use App\Contracts\Services\BroadcastContract;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryReportController extends Controller
{
    private BroadcastContract $broadcastContract;

    /**
     * @param BroadcastContract $broadcastContract
     */
    public function __construct(BroadcastContract $broadcastContract)
    {
        $this->broadcastContract = $broadcastContract;
    }

    public function index($appId)
    {
        $app = Helper::getAppInfo(['app_id' => $appId], ['app_name']);

        $breadcrumbs = [
            ['link' => "web/app/v", 'name' => "Web Apps"],
            ['name' => $app->app_name ]
        ];
        $pageConfigs = ['pageHeader' => true, 'title' => 'Delivery Report'];

        $button = '<a href="' . route('web-app-message',$appId) . '" type="button" class="btn btn-primary waves-effect waves-float waves-light">
                    <i class="mr-50" data-feather="plus-circle"></i>
                    <span>New Message</span>
                </a>';

        return view('delivery-report.delivery-report')->with([
            'appId' => $appId,
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'button' => $button,
        ]);
    }

    public function list(Request $request)
    {
        $request['user_id'] = auth()->id();

        return $this->broadcastContract->deliveryReportList($request['user_id'], $request['app_id']);
    }

}
