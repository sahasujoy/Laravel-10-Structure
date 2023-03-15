<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface TaskContract
{
    public function registrationTask(Request $request);
    public function getAllTask(Request $request);
    public function getAllTaskDataTable(Request $request);
    public function deleteTask(Request $request);
    public function getTaskList();
}
