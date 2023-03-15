<?php

namespace App\Http\Controllers\V1\Admin\Settings;

use App\Contracts\Services\AdminSettingContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\Settings\DefaultLimitSettingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DefaultLimitSettingController extends Controller
{

    private AdminSettingContract $adminSettingContract;

    public function __construct(AdminSettingContract $adminSettingContract)
    {

        $this->adminSettingContract = $adminSettingContract;
    }

    public function settingView()
    {
        $breadcrumbs = [
            ['link' => "admin/settings/third/party/provider", 'name' => "Setting"], ['link' => "javascript:void(0)", 'name' => "Default Limit"]
        ];
        $pageConfigs = ['pageHeader' => true, 'title' => 'Default Limit Setting'];
        $getDefaultLimitData = $this->adminSettingContract->getFirstDefaultLimitData();

        return view('admin/setting/global-setting', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'getDefaultLimitData' => $getDefaultLimitData]);
    }

    /**
     * Default Limit Data Setting
     */
    public function defaultLimitSettingCreateOrUpdate(DefaultLimitSettingRequest $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        $id = isset($request->id) ? $request->id : "";
        $appsLimit = $request->apps_limit;
        $monthlyLimit = $request->monthly_limit;


        $response = $this->adminSettingContract->updateDefaultLimitData($id, $appsLimit, $monthlyLimit);

        return response()->json($response);
    }

    /**
     * Get default limit data
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function getDefaultLimitData(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        $response = $this->adminSettingContract->getDefaultLimitData();

        return response()->json($response);
    }

}
