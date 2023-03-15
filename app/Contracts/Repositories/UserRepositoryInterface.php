<?php

namespace App\Contracts\Repositories;

interface UserRepositoryInterface
{
    public function createUser(array $data);

    public function getAllUser(array $select);
}
