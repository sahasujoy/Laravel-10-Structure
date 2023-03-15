<?php

namespace App\Repositories;


use App\Contracts\Repositories\UserRepository;
use App\Models\User;
use App\Repositories\BaseRepository\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected function model(): User
    {
        return new User();
    }

    /**
     * Create User From Registration
     * @param array $data
     * @return mixed
     */
    public function createRegisterUser(array $data): mixed
    {
        return $this->model
            ->create($data);
    }

    public function getUserCount(string $fromDate, string $toDate)
    {
        return $this->model
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->count();
    }

    public function updateUserDataByCondition(array $where, array $data)
    {
        return $this->model
            ->where($where)
            ->update($data);
    }

    public function getSpecificDataByCondition(array $select, array $where)
    {
        return $this->model
            ->select($select)
            ->where($where)
            ->with('userBalanceLimit')
            ->first();
    }

    /**
     * Retrieve data from user model
     * @param array $data
     * @return mixed
     */
    public function getAllUser(array $data)
    {
        return $this->model
            ->with('userBalanceLimit')
            ->select($data)
            ->orderBy('created_at','desc');
    }

    /**
     * Delete user from user table
     * @param array $where
     * @return mixed
     */
    public function deleteUser(array $where)
    {
        return $this->model
            ->where($where)
            ->delete();
    }

    /**
     * Update user status in user table
     * @param array $where
     * @param array $data
     * @return mixed
     */
    public function statusUpdate(array $where, array $data)
    {
        return $this->model
            ->where($where)
            ->update($data);
    }

    public function getUserList()
    {
        return $this->model
            ->select('id','first_name','last_name')
            ->get();
    }

    public function getUserInformationByUserEmail(string $email, array $select)
    {
        return $this->model->where(['email' => $email])->first();
    }
}
