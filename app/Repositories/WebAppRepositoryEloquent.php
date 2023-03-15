<?php

namespace App\Repositories;


use App\Contracts\Repositories\WebAppRepository;
use App\Models\WebApp;
use App\Repositories\BaseRepository\BaseRepository;

class WebAppRepositoryEloquent extends BaseRepository implements WebAppRepository
{
    public function statusChangeForDelete($webAppId)
    {
        return $this->model->where(['id' => $webAppId])->update(['status' => WebApp::DELETE]);
    }

    /**
     * @param array $where
     * @param int $pageSize
     * @return mixed
     */
    public function getUserWebAppData(array $where = [], int $pageSize = 15): mixed
    {
        return $this->model->where($where)->paginate($pageSize);
    }

    /**
     * @param $where
     * @param $update
     * @return mixed
     */
    public function updateWebApp($where, $update): mixed
    {
        return $this->model->where($where)->update($update);
    }

    /**
     * Get selected filed data by where
     * @param array $where
     * @param array $select
     * @return mixed
     */
    public function getSelectDataForDataTable(string $fromDate, string $toDate, array $where = [], array $select)
    {
        $collection = $this->model
            ->select($select)
            ->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate)
            ->orderBy('created_at', 'desc')
            ->with('user');


        if (!empty($where) or $where != null or (count($where) === 0)) {
            $collection = $collection->where($where);
        }

        return $collection;
    }

    /**
     * Get all count data by condition
     * @param array $where
     * @param array $select
     * @return mixed
     */
    public function getAllCountDataByWhere(array $where = [], array $select = [])
    {
        return $this->model->where($where)->select()->first();
    }

    /**
     * @param array $select
     * @param array $where
     * @return mixed
     */
    public function basicSelectDataForDataTable(array $select, array $where): mixed
    {
        return $this->model
            ->select($select)
            ->where($where)
            ->orderBy('created_at', 'desc');

    }

    /**
     * Get all data by condition
     * @param array $where
     * @param array $select
     * @return mixed
     */
    public function getAllData(array $where = [], array $select = [])
    {
        return $this->model
            ->select($select)
            ->where($where)
            ->get();
    }

    public function getSpecificAppData(array $where, array $select)
    {

        return $this->model
            ->select($select)
            ->where($where)
            ->first();
    }

    protected function model(): WebApp
    {
        return new WebApp();
    }
}


