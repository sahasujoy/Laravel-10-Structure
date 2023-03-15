<?php

namespace App\Repositories;

use App\Contracts\Repositories\GatewayProviderRepository;
use App\Models\GatewayProvider;
use App\Repositories\BaseRepository\BaseRepository;

class GatewayProviderRepositoryEloquent extends BaseRepository implements GatewayProviderRepository
{
    protected function model(): GatewayProvider
    {
        return new GatewayProvider();
    }

    /**
     * update of create gateway provider data
     * @param array $where
     * @param array $attributes
     * @return mixed
     */
    public function updateOrCreateData(array $where, array $attributes)
    {
        return $this->model
            ->updateOrCreate($where, $attributes);
    }

    public function deleteWhere(array $where)
    {
        return $this->model->where($where)->delete();
    }

    public function checkDataCount()
    {
        return $this->model->select('id')->limit(2)->count();
    }

    /** Get all provider list
     * @param array $select
     * @param int $perPage
     * @return void
     */
    public function getAllProviderListWithPaginate(array $select, int $perPage = 5)
    {
        $this->model->select($select)->paginate($perPage);
    }


    /**
     * @param array $where
     * @param array $data
     * @return mixed
     */
    public function updateByCondition(array $where, array $data)
    {
        return $this->model
            ->where($where)
            ->update($data);
    }

    /** Get all provider list
     * @param array $select
     * @param int $perPage
     * @return void
     */
    public function getAllData(array $select)
    {
        return $this->model->select($select)->get();
    }

    public function getSpecificDataByWhere(array $where, array $select)
    {
        return $this->model->where($where)->select($select)->first();
    }

}



