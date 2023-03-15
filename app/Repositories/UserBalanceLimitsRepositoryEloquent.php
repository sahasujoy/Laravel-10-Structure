<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserBalanceLimitsRepository;
use App\Models\UserBalanceLimit;
use App\Repositories\BaseRepository\BaseRepository;

class UserBalanceLimitsRepositoryEloquent extends BaseRepository implements UserBalanceLimitsRepository
{
    protected function model(): UserBalanceLimit
    {
        return new UserBalanceLimit();
    }


    /**
     * Insert data in table
     * @param array $data
     * @return mixed
     */
    public function insertUserBalance(array $data): mixed
    {

        return $this->model
            ->insert($data);
    }

    /**
     * Get specific user balance limit
     * @param array $select
     * @param array $where
     * @return mixed
     */
    public function getUserBalanceLimit(array $select, array $where): mixed
    {
        return $this->model
            ->select($select)
            ->where($where)
            ->first();
    }

    /**
     * Get user all balance limit
     * @param array $select
     * @param array $where
     * @return mixed
     */
    public function getUserAllBalanceLimit(array $select, array $where): mixed
    {
        return $this->model
            ->select($select)
            ->where($where)
            ->get();
    }

    /**
     * Reduce user current balance
     * @param array $where
     * @param string $field
     * @param int $value
     * @return mixed
     */
    public function decrementSingleDataByWhere(array $where, string $field, int $value): mixed
    {
        return $this->model->where($where)->decrement($field, $value);
    }

    /**
     * Get user all balance limit
     * @param array $select
     * @param array $where
     * @return mixed
     */
    public function getAllUserBalanceLimitData(array $where, array $select): mixed
    {
        return $this->model
            ->select($select)
            ->where($where)
            ->get();
    }

    public function updateByWhere($where, $data)
    {
        return $this->model->where($where)->update($data);
    }

    public function deleteByWhere($where)
    {
        return $this->model->where($where)->delete();
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function getUserBalance($userId): mixed
    {
        return $this->model->where(['user_id' => $userId])->first();
    }
}
