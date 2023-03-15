<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface UserContract
{
    public function registrationUser(Request $request);

    public function getUserCount(Request $request);

    public function getAllUser(Request $request);

    public function getAllUserDataTable(Request $request);

    public function deleteUser(Request $request);

    public function statusUpdate(Request $request);

    public function getUserInformationForSpecificUser(int $userId);

    public function getSpecificDataByCondition(int $userId);

    public function updateProfileInformationData(Request $request);

    public function resetUserPassword(Request $request);

    public function imageUploadForm(Request $request);

    public function getUserList();

    public function forgotPasswordEmailSend(Request $request);

    public function forgotPasswordCodeCheck(Request $request);

    public function getAndSetAdminDefinePackageValue(int $user_id, int $apps_limit, int $monthly_limit, $type = 1);

}
