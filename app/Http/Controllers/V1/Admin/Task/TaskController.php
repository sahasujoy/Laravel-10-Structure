<?php

namespace App\Http\Controllers\V1\Admin\Task;

use App\Contracts\Repositories\DefaultLimitRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\TaskContract;

class TaskController extends Controller
{
    //
    private $taskService;

    public function __construct(TaskContract $taskService)
    {
        $this->taskService = $taskService;
    }
    public function taskView()
    {
        $breadcrumbs = [
            ['link' => "admin/task", 'name' => "Task-Manage"]
        ];
        $pageConfigs = ['pageHeader' => true, 'title' => 'Tasks'];

        $where = ['type' => DEFAULT_LIMIT_PACKAGE_TYPE__DEFAULT ];// 1 =  default
        $select = ['apps_limit', 'monthly_limit'];
//        $defaultLimit = App::make(DefaultLimitRepository::class)->getDefaultLimit($select, $where);

        return view('admin.task.task-manage', ['pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
    }

    public function createTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_name' => 'required',
            'duration' => 'required',
            'status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['error' => $validator->errors()->toArray()]);
        }

        $response = $this->taskService->registrationTask($request);

        return response()->json($response);
    }

    public function getTask(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        return $this->taskService->getAllTaskDataTable($request);
    }

    public function deleteTask(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        return response()->json($this->taskService->deleteTask($request));
    }
}
