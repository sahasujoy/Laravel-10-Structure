<?php

namespace App\Http\Controllers\V1\User\Reports;

use App\Contracts\Services\UserDashboardContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UserReportsController extends Controller
{
    private UserDashboardContract $userDashboardContract;

    public function __construct(UserDashboardContract $userDashboardContract)
    {
        $this->userDashboardContract = $userDashboardContract;
    }

    /**
     * User Wise Graph Report
     * @param Request $request
     * @return JsonResponse
     */
    public function getStateCountGraphReportData(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        $response = $this->userDashboardContract->getUserDataGraphReport($request);

        return response()->json($response);
    }

    /**
     * User wise report view
     * @param Request $request
     * @return Application|Factory|View
     */
    public function userImageProcessReportView(Request $request)
    {
        $pageConfigs = ['pageHeader' => false];
        return view('user/reports/user-reports', [
                'pageConfigs' => $pageConfigs
            ]
        );
    }

    public function userImageCountReportView(Request $request)
    {
        $pageConfigs = ['pageHeader' => false];
        return view('user/reports/user-image-process-count', ['pageConfigs' => $pageConfigs]);
    }

    public function getImageProcessCountReportData(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        return App::make(UserDashboardContract::class)->getSpecificUserReportDataCountTable($request);

    }


    /**
     * Daily and monthly usage report view
     * @param Request $request
     * @return Application|Factory|View
     */
    public function dailyMonthlyUsagesReportView(Request $request)
    {
        $pageConfigs = ['pageHeader' => false];
        return view('user.reports.usages', [
                'pageConfigs' => $pageConfigs
            ]
        );
    }

    public function getDailyTotalLimitAndUsagesData(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        $request['user_id'] = auth()->user()->id;

        return App::make(UserDashboardContract::class)->getDailyTotalLimitAndUsagesData($request);

    }

    public function getMonthlyTotalLimitAndUsagesData(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }
        $request['user_id'] = auth()->user()->id;

        return App::make(UserDashboardContract::class)->getMonthlyTotalLimitAndUsagesData($request);

    }
}
