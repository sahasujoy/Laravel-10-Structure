<?php

namespace App\Repositories;

use App\Contracts\Repositories\ResetPasswordRepository;
use App\Models\PasswordReset;
use App\Repositories\BaseRepository\BaseRepository;

class ResetPasswordRepositoryEloquent extends BaseRepository implements ResetPasswordRepository
{

    public function model()
    {
        return new PasswordReset();
    }

    public function insertResetPasswordRequest($param)
    {
        return $this->model->create($param);
    }

    public function getDataByEmail(string $email)
    {
        return $this->model->where('email', $email)
            ->orderBy('updated_at', 'desc')->first();
    }


    public function updateResetPasswordById($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    /**
     * Check data by token
     * @param int $token
     * @param string $email
     * @return mixed
     */
    public function getDataByTokenAndEmail(int $token, string $email)
    {
        return $this->model->where('token', $token)->first();
    }
}
