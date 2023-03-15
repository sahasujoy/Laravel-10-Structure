<?php

namespace App\Contracts\Repositories;

interface UserRepository
{
    public function createRegisterUser(array $data);

    public function updateUserDataByCondition(array $where, array $data);

    public function getSpecificDataByCondition(array $select, array $where);

    public function getUserCount(string $fromDate, string $toDate);

    public function getAllUser(array $data);

    public function deleteUser(array $where);

    public function statusUpdate(array $where, array $data);

    public function getUserList();

    public function getUserInformationByUserEmail(string $email, array $select);
}
