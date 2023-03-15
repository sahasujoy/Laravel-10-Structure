<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface AdminDashboardContract
{
    public function getDashboardStateDataCountReport(Request $request);

}
