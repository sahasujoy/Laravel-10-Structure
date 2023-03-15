<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface AdminSettingContract
{
    public function updateDefaultLimitData( $id, int $apps_limit, int $monthly_limit);

    public function getDefaultLimitData();

    public function getFirstDefaultLimitData();

    public function updateGatewayProviderData(Request $request);

    public function deleteGatewayProviderData(int $id);

    public function getAllGatewayProviderListData(Request $request);

    public function getAllProviderData();

    public function statusChangeForGatewayProviderData(int $provider_type, $status);

}
