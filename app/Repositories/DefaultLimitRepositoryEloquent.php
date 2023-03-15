<?php

namespace App\Repositories;


use App\Contracts\Repositories\DefaultLimitRepository;
use App\Models\DefaultLimit;
use App\Repositories\BaseRepository\BaseRepository;

class DefaultLimitRepositoryEloquent extends BaseRepository implements DefaultLimitRepository
{
    protected function model(): DefaultLimit
    {
        return new DefaultLimit();
    }

    public function getDefaultLimit(array $select,array $where)
    {
        return $this->model
            ->select($select)
            ->where($where)
            ->first();
    }

    /**
     * update of create default limit data
     * @param array $where
     * @param array $attributes
     * @return mixed
     */
    public function updateOrCreateData(array $where, array $attributes)
    {
        return $this->model
            ->updateOrCreate($where, $attributes);
    }

    /**
     * @param array $select
     * @return mixed
     */
    public function getFirstDefaultLimitData(array $select)
    {
        return $this->model
            ->select($select)
            ->first();
    }
}



