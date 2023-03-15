<?php

namespace App\Repositories;


use App\Contracts\Repositories\AdminRepository;
use App\Models\Admin;
use App\Repositories\BaseRepository\BaseRepository;

class AdminRepositoryEloquent extends BaseRepository implements AdminRepository
{
    protected function model(): Admin
    {
        return new Admin();
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
            ->first();
    }

    public function getUserInformationByUserEmail(string $email, array $select)
    {
        return $this->model->where(['email' => $email])->first();
    }

}

