<?php

namespace App\Services;

use App\Contracts\Repositories\TaskRepository;
use App\Contracts\Services\TaskContract;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

class TaskService implements TaskContract
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function registrationTask(Request $request)
    {
        try {
            $data = [
                'task_name' => $request['task_name'],
                'duration' => $request['duration'],
                'status' => $request['status']
            ];

            $task = $this->taskRepository->createTask($data);
            if ($task) {
                //todo // Default package / plan insert
//                $this->getAndSetDefaultPackage($task->id);
                return $task->id;
            }

        } catch (Exception $e) {
            Log::error('Task insertion failed', [$e->getMessage(), $e->getLine()]);

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_EXPECTATION_FAILED);
        }
    }

    public function getAllTaskDataTable(Request $request)
    {
        $response = $this->getAllTask($request);

        return Datatables::of($response)
            ->addColumn('task_info', function ($response) {

                $taskID = encrypt($response->id);

                $task_name = $response->task_name;
                $duration = isset($response->duration) ? $response->duration : "Duration Not Found";
                $status = isset($response->status) ? $response->status : "No Status";

                /// Status

                return '<div class="card user-card mb-0">
                            <div class="card-body p-1">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                        <div class="user-avatar-section">
                                            <div class="d-flex justify-content-start">

                                                <div class="d-flex flex-column ml-1">
                                                    <div class="user-info mb-1">
                                                        <h4 class="mb-0"> ' . $task_name . ' </h4>
                                                        <span class="card-text"> ' . $duration . ' </span>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary waves-effect waves-float waves-light
                                                        edit-user" id="edit-user" data-id = "' . $taskID . '">Edit</a>
                                                        <button href="javascript:void(0)" class="btn  btn-sm btn-outline-danger ml-1 waves-effect" data-id = "' . $taskID . '"  id="delete-task">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                                        <div class="user-info-wrapper">

                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check mr-1"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                    <span class="card-text user-info-title font-weight-bold mb-0">Status</span>
                                                </div>
                                                <p class="card-text mb-0"> ' . $status . ' </p>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            })
            ->rawColumns(['task_info'])
            ->make(true);
    }

    public function getAllTask(Request $request)
    {
        try {
            return $this->taskRepository->getAllTask(['id', 'task_name', 'duration', 'status']);
        } catch (Exception  $e) {
            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_EXPECTATION_FAILED, 'Failed to get task data', []);
        }
    }

    public function deleteTask(Request $request): array
    {
        try {
            $taskId = decrypt($request['task_id']);

            $response = $this->taskRepository->deleteTask(['id' => $taskId]);

            if ($response) {
                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Task Deleted Successfully', $response);
            }

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'Task Deleted Failed');

        } catch (Exception $e) {
            Log::error("Delete Task : ", [$e->getMessage()]);
            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'Task Deleted Failed');
        }
    }

    public function getTaskList()
    {
        return $this->taskRepository->getTaskList();
    }
}
