<?php

namespace App\Http\Controllers\V1\Admin\Profile;

use App\Contracts\Services\AdminContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\Profile\UserProfileRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller
{

    private AdminContract $adminService;

    public function __construct(AdminContract $adminService)
    {

        $this->adminService = $adminService;
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Application|Factory|View
     */
    public function profileView()
    {
        $userId = auth()->guard('admin')->user()->id;
        $userInfo = $this->adminService->getSpecificDataByCondition($userId);
        $data['userInfo'] = $userInfo;
        $data['profile_image'] = asset('images/portrait/small/avatar-s-11.jpg');
        if ($userInfo and isset($userInfo->avatar) and !empty($userInfo->avatar)) {
            $data['profile_image'] = $userInfo->avatar;
        }

        return view('admin.profile.setting')->with($data);
    }


    /**
     * User Profile Information Update
     * @param UserProfileRequest $request
     * @return JsonResponse
     */
    public function userProfileInformationUpdate(UserProfileRequest $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        // Decrypt user id value
        $request['user_id'] = auth()->guard('admin')->user()->id;

        $response = $this->adminService->updateProfileInformationData($request);

        return response()->json($response);
    }

    public function resetUserPassword(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password'
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }
        // Decrypt user id value
        $request['user_id'] = auth()->guard('admin')->user()->id;

        $response = $this->adminService->resetUserPassword($request);

        return response()->json($response);
    }


    /**
     * User Profile Information Update
     * @return JsonResponse
     */
    public function imageUploadForm(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        $validator = Validator::make($request->all(), [
            'profile_image' => 'mimes:jpeg,jpg,png,gif|required|max:800' // max 10000kb
        ]);

        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        }

        // Decrypt user id value
        $request['user_id'] = auth()->guard('admin')->user()->id;

        $response = $this->adminService->imageUploadForm($request);

        return response()->json($response);
    }
}
