<?php

namespace App\Http\Controllers\V1\User\Dashboard;

use App\Contracts\Services\UserContract;
use App\Contracts\Services\UserDashboardContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $request['user_id'] = auth()->user()->id;

        return view('user.dashboard.user-dashboard');
    }

    public function getUserDataGraphReport(Request $request)
    {
        $request['user_id'] = auth()->user()->id;

        $response = App::make(UserDashboardContract::class)->getUserDataGraphReport($request);
        return response()->json($response);
    }

    public function getTotalCleanAndProcessImageDifferenceWithPercentage(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }
        $request['user_id'] = auth()->user()->id;

        $response =  App::make(UserDashboardContract::class)->getTotalCleanAndProcessImageDifferenceWithPercentage($request);

        return response()->json($response);

    }

    public function getImageProcessCountReportDataForSpecificUser(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        $request['user_id'] = auth()->user()->id;

        return App::make(UserDashboardContract::class)->getSpecificUserReportDataCountTable($request);

    }

    public function getTotalImageProcessCleanCount(Request $request)
    {
        $request['user_id'] = auth()->user()->id;

        $totalImage = 0;
        $totalCleanImage = 0;
        $totalNotCleanImage = 0;

        $reports = App::make(UserDashboardContract::class)->getUserStatisticsReport($request);

        foreach ($reports as $report) {
            $totalImage += $report->sum_process_image;
            $totalCleanImage += $report->sum_clean_image;
            $totalNotCleanImage += $report->sum_failed_process_image;
        }

        $response = [
            'totalImage' => $totalImage,
            'totalCleanImage' => $totalCleanImage,
            'totalNotCleanImage' => $totalNotCleanImage,
        ];

        return response()->json($response);
    }
}
