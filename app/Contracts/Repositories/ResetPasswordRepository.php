<?php

namespace App\Contracts\Repositories;

interface ResetPasswordRepository
{
    public function insertResetPasswordRequest($param);

    public function getDataByEmail(string $email);

    public function getDataByTokenAndEmail(int $token, string $email);

    public function updateResetPasswordById($id, $data);

}
