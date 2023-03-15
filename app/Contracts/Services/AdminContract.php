<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface AdminContract
{
    public function resetUserPassword(Request $request);

    public function getSpecificDataByCondition(int $userId);

    public function updateProfileInformationData(Request $request);

    public function imageUploadForm(Request $request);

    public function forgotPasswordEmailSend(Request $request);

    public function forgotPasswordCodeCheck(Request $request);

}
