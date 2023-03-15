<?php

namespace App\Http\Controllers\V1\User\Auth;

use App\Contracts\Repositories\UserRepository;
use App\Contracts\Services\UserBalanceLimitContract;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class UserAuthController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function loginView()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/user/auth/login', ['pageConfigs' => $pageConfigs]);
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return response()->json(Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'User login successfully'));
            }

            return response()->json(Helper::RETURN_ERROR_FORMAT(Response::HTTP_UNAUTHORIZED, 'Invalid Email/Password'));

        } catch (Exception $exception) {
//            return redirect(route("admin-login-view"))->withErrors('Failed to login');
            return response()->json(Helper::RETURN_ERROR_FORMAT(Response::HTTP_UNAUTHORIZED, 'Invalid Email/Password'));

        }
    }

    /**
     * @return Application|Factory|View
     */
    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard.dashboard');
        }

        return redirect(route("login-form"))->withSuccess('Opps! You do not have access');
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect(route('user-login-view'));
    }

    public function forceLogin($userId)
    {
        $decryptedUserId = Crypt::decrypt($userId);
        $where = ['id' => $decryptedUserId];
        $select = ['id'];
        $user = App::make(UserRepository::class)->getSpecificDataByCondition($select, $where);

        if (!empty($user)) {
            Auth::logout();
            Auth::loginUsingId($user->id);

            return redirect()->route('user-dashboard');
        } else {
            return $this->redirectFailure('login', 'Invalid User.');
        }
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserBalance(Request $request): JsonResponse
    {
        $UserBalanceLimit = App::make(UserBalanceLimitContract::class)->getUserBalance($request['user_id']);

        return response()->json($UserBalanceLimit);

    }


}
