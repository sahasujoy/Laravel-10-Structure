<?php

namespace App\Contracts\Repositories;

interface UserBalanceLimitsRepository
{
    public function insertUserBalance(array $data);

    public function getUserBalanceLimit(array $select,array $where);

    public function getUserAllBalanceLimit(array $select, array $where);

    public function decrementSingleDataByWhere(array $where, string $field, int $value);

    public function getAllUserBalanceLimitData(array $where, array $select);

    public function updateByWhere($where, $data);

    public function deleteByWhere($where);

    public function getUserBalance($userId);
}
