<?php

namespace App\Contracts\Repositories;

interface GatewayProviderRepository
{
    public function updateOrCreateData(array $where, array $attributes);

    public function deleteWhere(array $where);

    public function checkDataCount();

    public function getAllProviderListWithPaginate(array $select, int $perPage = 5);

    public function updateByCondition(array $where, array $data);

    public function getAllData(array $select);

    public function getSpecificDataByWhere(array $where, array $select);
}
