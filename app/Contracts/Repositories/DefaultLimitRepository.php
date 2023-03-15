<?php

namespace App\Contracts\Repositories;

interface DefaultLimitRepository
{
    public function getDefaultLimit(array $select,array $where);

    public function updateOrCreateData(array $where, array $attributes);

    public function getFirstDefaultLimitData(array $select);
}
