<?php

namespace App\Services;


use App\Contracts\Repositories\UserBalanceLimitRepository;
use App\Contracts\Repositories\UserBalanceLimitsRepository;
use App\Contracts\Services\UserBalanceLimitContract;
use App\Enums\UserBalanceEnum;
use App\Helpers\Helper;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserBalanceLimitService implements UserBalanceLimitContract
{
    private UserBalanceLimitsRepository $userBalanceLimitsRepository;

    public function __construct(UserBalanceLimitsRepository $userBalanceLimitsRepository)
    {
        $this->userBalanceLimitsRepository = $userBalanceLimitsRepository;
    }


    /**
     * @param $userId
     * @return array
     */
    public function getUserBalance($userId): array
    {
        $response = $this->userBalanceLimitsRepository->getUserBalance($userId);

        if ($response) {
            return Helper::RETURN_SUCCESS_FORMAT(200, 'User Balance', $response);
        }

        return Helper::RETURN_ERROR_FORMAT(422);

    }



    /**
     * Check user balance limit for specific user
     * @param $userId
     * @return void
     */
    public function checkUserBalanceLimitForSpecificUser(int $userId): array
    {
        $select = ['current_balance', 'balance_key'];
        $where = ['user_id' => $userId];
        $data = [];
        $data['app_current_balance'] = 0;
        $data['app_limit_is_available'] = false;
        $data['monthly_current_balance'] = 0;
        $data['monthly_limit_is_available'] = false;

        $getUserAllBalanceLimit = $this->userBalanceLimitsRepository->getUserAllBalanceLimit($select, $where);
        if ($getUserAllBalanceLimit) {
            foreach ($getUserAllBalanceLimit as $item) {
                if ($item->balance_key == UserBalanceEnum::from(1)->value) {
                    $data['app_current_balance'] = $item->current_balance;
                    if ($item->current_balance > 0) {
                        $data['app_limit_is_available'] = true;
                    }

                } else {
                    $data['monthly_current_balance'] = $item->current_balance;
                    if ($item->current_balance > 0) {
                        $data['monthly_limit_is_available'] = true;
                    }
                }
            }
        }

        return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Get user balance limit data', $data);
    }

    /**
     * Check user balance limit for specific user
     * @param int $userId
     * @param int $type
     * @return array
     */
    public function decrementSingleDataByUserIdAndKey(int $userId, int $type = 1, $value = 1)
    {
        $where = ['user_id' => $userId, 'balance_key' => $type];
        $filed = 'current_balance';
        return $this->userBalanceLimitsRepository->decrementSingleDataByWhere($where, $filed, $value);
    }

    /**
     * @param int $userId
     * @return array
     */
    public function userLimitCutter(int $userId): array
    {
        $limit = $this->checkUserBalanceLimitForSpecificUser($userId);

        //       daily limit check

        if ($limit['data']['app_current_balance'] == 0) {
            return Helper::RETURN_ERROR_FORMAT(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, 'Your daily limit finished !!');
        }

        //       monthly limit check

        if ($limit['data']['monthly_current_balance'] == 0) {
            return Helper::RETURN_ERROR_FORMAT(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, 'Your monthly limit finished !!');
        }


        $this->decrementSingleDataByUserIdAndKey($userId);
        $this->decrementSingleDataByUserIdAndKey($userId, 2);

        return Helper::RETURN_SUCCESS_FORMAT(ResponseAlias::HTTP_OK, '1 credit debit from your account', []);


    }

}
