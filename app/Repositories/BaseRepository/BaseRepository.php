<?php

namespace App\Repositories\BaseRepository;

use PharIo\Manifest\Application;

abstract class BaseRepository
{
    protected $model;
    /**
     * @var Application
     */

    /**
     * BaseRepository constructor.
     * @return void
     */
    public function __construct()
    {
        $this->makeModel();
    }

    abstract protected function model();

    private function makeModel()
    {
        $model = $this->model();
        return $this->model = $model;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function bulkCreate(array $data)
    {
        return $this->model->insert($data);
    }

    public function first($columns = ['*'])
    {
        return $this->model->first($columns);
    }

    public function firstOrNew(array $attributes = [])
    {
        return $this->model->firstOrNew($attributes);
    }

    public function firstOrCreate(array $attributes = [])
    {
        return $this->model->firstOrCreate($attributes);
    }

    public function find(int $id, array $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function findByField(string $field, $value = null, array $columns = ['*'])
    {
        return $this->model->where($field, '=', $value)->get($columns);
    }

    public function findWhere(array $where, array $columns = ['*'])
    {
        $this->applyConditions($where);

        return $this->model->get($columns);
    }

    public function findWhereIn(array $field, array $values, array $columns = ['*'])
    {
        return $this->model->whereIn($field, $values)->get($columns);
    }

    public function findWhereNotIn(array $field, array $values, array $columns = ['*'])
    {
        return $this->model->whereNotIn($field, $values)->get($columns);
    }

    public function findWhereBetween(array $field, array $values, array $columns = ['*'])
    {
        return $this->model->whereBetween($field, $values)->get($columns);
    }

    public function all(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function pluck(array $column, array $key = null)
    {
        return $this->model->pluck($column, $key);
    }

    public function count(array $where = [], array $columns = ['*'])
    {
        if ($where) {
            $this->applyConditions($where);
        }

        return $this->model->count($columns);
    }

    public function update(array $attributes, $id)
    {
        return $this->model->where('id', $id)->update($attributes);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    public function delete(int $id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function deleteWhere(array $where)
    {
        $this->applyConditions($where);

        return $this->model->delete();
    }

    public function deleteWhereIn(array $column, array $where)
    {
        return $this->model->whereIn($column, $where)->delete();
    }

    protected function applyConditions(array $where)
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                $this->model = $this->model->where($field, $condition, $val);
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
    }

    public function getOne($where = [])
    {
        return $this->model->where($where)->first();
    }
}
