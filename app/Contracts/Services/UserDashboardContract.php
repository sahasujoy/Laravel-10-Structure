<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface UserDashboardContract
{
    public function getUserDataGraphReport(Request $request);

    public function getDailyTotalLimitAndUsagesData(Request $request);

    public function getMonthlyTotalLimitAndUsagesData(Request $request);

}
