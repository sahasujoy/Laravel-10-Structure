<?php

namespace App\Http\Controllers\V1\Admin\Settings;

use App\Contracts\Services\AdminSettingContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class GatewayProviderSettingController extends Controller
{

    private AdminSettingContract $adminSettingContract;

    public function __construct(AdminSettingContract $adminSettingContract)
    {

        $this->adminSettingContract = $adminSettingContract;
    }


    /**
     * Provider data create or update using this func
     * @param Request $request
     * @return JsonResponse
     */
    public function gatewayProviderDataCreateOrUpdate(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        $response = $this->adminSettingContract->updateGatewayProviderData($request);

        return response()->json($response);
    }


    /**
     * Delete provider specific data [ by id ] ]
     * @param Request $request
     * @return JsonResponse
     */
    public function gatewayProviderDataDelete(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        $response = $this->adminSettingContract->deleteGatewayProviderData($request->id);

        return response()->json($response);
    }


    /**
     * Get all gateway provider list data with paginate
     * @param Request $request
     * @return JsonResponse
     */
    public function allGatewayProviderListData(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        $response = $this->adminSettingContract->getAllGatewayProviderListData($request);

        return response()->json($response);
    }


    /**
     * Provider status change
     * @param Request $request
     * @return JsonResponse
     */
    public function gatewayProviderChangeStatus(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        $response = $this->adminSettingContract->statusChangeForGatewayProviderData($request->provider_type, $request->status);

        return response()->json($response);
    }

    /**
     * View for third party provider
     * @return Application|Factory|View
     */
    public function thirdPartyProviderView()
    {
        $breadcrumbs = [
            ['link' => "admin/settings/third/party/provider", 'name' => "Setting"], ['link' => "javascript:void(0)", 'name' => "Third Party Provider Setting"]
        ];
        $pageConfigs = ['pageHeader' => true, 'title' => 'Third Party Provider Setting'];

        $getAllProvider = $this->adminSettingContract->getAllProviderData();

        return view('admin/setting/third-party-provider', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'getAllProvider' => $getAllProvider]);
    }
}
