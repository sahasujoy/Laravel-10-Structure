<?php

namespace App\Http\Controllers\V1\User\Profile;

use App\Contracts\Services\UserContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\Registration\CreateUserRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserRegistrationController extends Controller
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
    public function create()
    {
        $pageConfigs = ['blankPage' => true];

        return view('user.auth.register', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * Store a newly created user in database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(CreateUserRequest $request)
    {
//        $validator = Validator::make($request->all(), [
//            'first_name' => 'required',
//            'last_name' => 'required',
//            'email' => 'required|email|unique:users',
//            'password' => 'required|min:6|max:12',
//            'type' => 'required',
//        ]);
//
//        if (!$validator->passes()) {
//            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
//        }

        $response = $this->userService->registrationUser($request);

        return response()->json($response);
    }


}
