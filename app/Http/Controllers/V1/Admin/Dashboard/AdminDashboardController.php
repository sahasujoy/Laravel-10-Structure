<?php

namespace App\Http\Controllers\V1\Admin\Dashboard;

use App\Contracts\Services\AdminDashboardContract;
use App\Contracts\Services\UserContract;
use App\Contracts\Services\WebAppContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdminDashboardController extends Controller
{

    private AdminDashboardContract $adminDashboardService;
    private WebAppContract $webAppService;

    public function __construct(AdminDashboardContract $adminDashboardService, WebAppContract $webAppService)
    {

        $this->adminDashboardService = $adminDashboardService;
        $this->webAppService = $webAppService;
    }

    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => "/admin/", 'name' => "Dashboard"]
        ];
        $pageConfigs = ['pageHeader' => true, 'title' => 'Dashboard'];
        $users = App::make(UserContract::class)->getUserList();

        return view('admin.dashboard.admin-dashboard',
            [
                'users' => $users,
                'pageConfigs' => $pageConfigs,
                'breadcrumbs' => $breadcrumbs,

            ]
        );
    }


    /**
     * Get State Count Report For Dashboard
     * @param Request $request
     * @return JsonResponse
     */
    public function getStateCountReport(Request $request)
    {
        $response = $this->adminDashboardService->getDashboardStateDataCountReport($request);

        return response()->json($response);
    }

    /**
     * Get State Count Report For Dashboard
     * @param Request $request
     * @return JsonResponse
     */
    public function getWebProjectListDataTable(Request $request)
    {
        return $this->webAppService->getWebProjectListDataTable($request);
    }
}
