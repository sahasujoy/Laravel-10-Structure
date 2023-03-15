<?php

namespace App\Http\Controllers\V1\Admin\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthController extends Controller
{
    public function index()
    {
        return redirect(route('admin-dashboard'));
    }

    public function loginView()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/admin/auth/login', ['pageConfigs' => $pageConfigs]);
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);

            if (!$validator->passes()) {
                return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
            }

            $credentials = $request->only('email', 'password');

            if (Auth::guard('admin')->attempt($credentials)) {
                return response()->json(Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Agency login successfully'));
            }

            return response()->json(Helper::RETURN_ERROR_FORMAT(Response::HTTP_UNAUTHORIZED, 'Invalid Email / Password'));

        } catch (Exception $exception) {
            return response()->json(Helper::RETURN_ERROR_FORMAT(Response::HTTP_UNAUTHORIZED, 'Invalid Email / Password'));
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
        Auth::guard('admin')->logout();

        return Redirect(route('admin-login-view'));
    }

    public function forgotPassword()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/admin/auth/passwords/forget-password', ['pageConfigs' => $pageConfigs]);
    }

    protected function respondWithToken($token)
    {
        $tokenData = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->guard('agency')->user(),
            'role_name' => isset($role) ? $role['data'] : '',
            'hidden_modules_key' => isset($hidden_modules_key) ? $hidden_modules_key['data'] : [],
            'expires_in' => auth()->factory()->getTTL() * 60 * 24
        ];

        return response()->json(Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Agency login successfully', $tokenData));
    }
}
