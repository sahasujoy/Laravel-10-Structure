<?php

namespace App\Contracts\Repositories;

interface AdminRepository
{
    public function updateUserDataByCondition(array $where, array $data);

    public function getSpecificDataByCondition(array $select, array $where);

    public function getUserInformationByUserEmail(string $email, array $select);
}
