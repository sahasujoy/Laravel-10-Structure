<?php

namespace App\Contracts\Repositories;

interface WebAppRepository
{
    public function statusChangeForDelete($webAppId);

    public function getUserWebAppData(array $where = [], int $pageSize = 15);

    public function updateWebApp($where, $update);

    public function getSelectDataForDataTable(string $fromDate, string $toDate, array $where, array $select);

    public function basicSelectDataForDataTable(array $select, array $where);

    public function getAllCountDataByWhere(array $where = [], array $select = []);

    public function getAllData(array $where = [], array $select = []);

    public function getSpecificAppData(array $where, array $select);

}
