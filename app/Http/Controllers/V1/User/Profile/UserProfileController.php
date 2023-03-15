<?php

namespace App\Http\Controllers\V1\User\Profile;

use App\Contracts\Services\UserContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\Profile\UserProfileRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UserProfileController extends Controller
{

    private UserContract $userService;

    public function __construct(UserContract $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Application|Factory|View
     */
    public function profileView()
    {
        $breadcrumbs = [
            ['link' => "app", 'name' => "Apps"]
        ];

        $pageConfigs = ['pageHeader' => true, 'title' => 'Setting'];

        $button = '<a href="' . route('user-dashboard') . '" type="button" class="btn btn-primary waves-effect waves-float waves-light">
                    <i class="mr-50" data-feather="arrow-left-circle"></i>
                    <span>Back to home</span>
                </a>';
        $userId = auth()->user()->id;

        $userInfo = $this->userService->getSpecificDataByCondition($userId);

        $data['userInfo'] = $userInfo;
        $data['profile_image'] = asset('images/portrait/small/avatar-s-11.jpg');
        if ($userInfo and isset($userInfo->avatar) and !empty($userInfo->avatar)) {
            $data['profile_image'] = $userInfo->avatar;
        }

        $data['pageConfigs'] = $pageConfigs;
        $data['button'] = $button;

        return view('user.profile.setting')->with($data);
    }


    /**
     * Get User Information for a specific user
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function getUserInformationForSpecificUser(Request $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        // Decrypt user id value
        $userId = Crypt::decrypt($request->user_id);
        $response = $this->userService->getUserInformationForSpecificUser($userId);

        return response()->json($response);
    }

    /**
     * User Profile Information Update
     * @return JsonResponse
     */
    public function userProfileInformationUpdate(UserProfileRequest $request)
    {
        if (!$request->ajax()) {
            return $this->redirectFailure('home', 'Direct access is denied.');
        }

        // Decrypt user id value
        $request['user_id'] = auth()->user()->id;
        $response = $this->userService->updateProfileInformationData($request);

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
        $request['user_id'] = auth()->user()->id;

        $response = $this->userService->imageUploadForm($request);

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
            return response()->json(['status' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => $validator->errors()->toArray()]);
        }
        // Decrypt user id value
        $request['user_id'] = auth()->user()->id;;

        $response = $this->userService->resetUserPassword($request);

        return response()->json($response);
    }
}
