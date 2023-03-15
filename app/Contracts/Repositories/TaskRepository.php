<?php

namespace App\Contracts\Repositories;

interface TaskRepository
{
    public function createTask(array $data);

    public function getAllTask(array $data);

    public function deleteTask(array $where);

    public function getTaskList();
}
