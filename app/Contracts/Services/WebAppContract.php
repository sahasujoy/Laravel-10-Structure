<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface WebAppContract
{
    public function webAppDeleteRequest($webAppId);

    public function getWebProjectListDataTable(Request $request);

    public function getUserWebAppData($userId, $appId);

    public function createWebApp(Request $request);

    public function updateWebApp(Request $request);

    public function webAppStateCountDataReportByWebAppId(string $webAppId);

    public function getSpecificAppWiseSubscriptionDataGraphReport(Request $request);

    public function basicWebProjectListDataTable($userId);

    public function getSingleWebAppData($appId, $userId);

    public function publicImageUpload(Request $request);

    public function webAppNotificationAlertConfigCode(Request $request);

    public function getConfigData(string $appId);

    public function formatConfigData($configData, string $appId);


}

//WebAppRepository
