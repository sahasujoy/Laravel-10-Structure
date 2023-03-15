<?php

namespace App\Http\Controllers\V1\Admin\User;

use App\Contracts\Repositories\DefaultLimitRepository;
use App\Contracts\Services\UserContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    /**
     * @var UserContract
     */
    private $userService;

    public function __construct(UserContract $userService)
    {
        $this->userService = $userService;

    }

    /**
     * User Manage View Page
     * @return Application|Factory|View
     */
    public function userView()
    {
        $breadcrumbs = [
            ['link' => "admin/user", 'name' => "User-manage"]
        ];
        $pageConfigs = ['pageHeader' => true, 'title' => 'Users'];

        $where = ['type' => DEFAULT_LIMIT_PACKAGE_TYPE__DEFAULT ];// 1 =  default
        $select = ['apps_limit', 'monthly_limit'];
        $defaultLimit = App::make(DefaultLimitRepository::class)->getDefaultLimit($select, $where);

        return view('admin.user.user-manage', ['pageConfigs' => $pageConfigs, 'defaultLimit' => $defaultLimit, 'breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Get all user list with datatable
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function getUser(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        return $this->userService->getAllUserDataTable($request);
    }

    /**
     * Delete user from user table
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteUser(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        return response()->json($this->userService->deleteUser($request));
    }

    /**
     * User status change
     * @param Request $request
     * @return JsonResponse
     */
    public function statusUpdate(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        return response()->json($this->userService->statusUpdate($request));

    }

    /**
     * Get specific user information
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserInformationForSpecificUser(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        $useId = decrypt($request->user_id);
        return response()->json($this->userService->getUserInformationForSpecificUser($useId));

    }

    /**
     * Update specific user information
     * @param Request $request
     * @return JsonResponse
     */
    public function updateUserInformation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $request['user_id'] = decrypt($request['user_id']);

        return response()->json($this->userService->updateProfileInformationData($request));

    }

    /**
     * Reset user password
     * @param Request $request
     * @return JsonResponse
     */
    public function resetUserPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        $request['user_id'] = decrypt($request->user_id);

        return response()->json($this->userService->resetUserPassword($request));
    }

    /**
     * Create new user
     * @param Request $request
     * @return JsonResponse
     */
    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:12',
            'type' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $response = $this->userService->registrationUser($request);

        return response()->json($response);
    }

    /**
     * Allocated limitation for specific user
     * @param Request $request
     * @return JsonResponse
     */
    public function allocateBalanceLimit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'apps_limit' => 'required',
            'monthly_limit' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        $userId = decrypt($request->user_id);
        $appsLimit = $request->apps_limit;
        $monthlyLimit = $request->monthly_limit;
        $type = $request->type;

        return response()->json($this->userService->getAndSetAdminDefinePackageValue($userId, $appsLimit, $monthlyLimit, $type));

    }

    public function getUserList(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        return response()->json($this->userService->getUserList());
    }

}
