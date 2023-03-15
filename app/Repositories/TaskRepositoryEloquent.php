<?php

namespace App\Repositories;


use App\Contracts\Repositories\TaskRepository;
use App\Models\Task;
use App\Repositories\BaseRepository\BaseRepository;

class TaskRepositoryEloquent extends BaseRepository implements TaskRepository
{
    protected function model(): Task
    {
        return new Task();
    }

    /**
     * Create User From Registration
     * @param array $data
     * @return mixed
     */
    public function createTask(array $data): mixed
    {
        return $this->model
            ->create($data);
    }
    public function deleteTask(array $where)
    {
        return $this->model
            ->where($where)
            ->delete();
    }
    public function getAllTask(array $data)
    {
        return $this->model
            ->select($data)
            ->orderBy('created_at','desc');
    }

    public function getTaskList()
    {
        return $this->model
            ->select('id','task_name','duration')
            ->get();
    }
}
