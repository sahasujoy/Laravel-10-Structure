<?php

namespace App\Contracts\Services;

interface UserBalanceLimitContract
{
    public function getUserBalance($userId);

    public function checkUserBalanceLimitForSpecificUser(int $userId);

    public function decrementSingleDataByUserIdAndKey(int $userId, int $type, int $value);

    public function userLimitCutter(int $userId);

}
