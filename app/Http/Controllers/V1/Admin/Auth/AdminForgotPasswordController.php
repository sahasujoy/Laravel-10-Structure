<?php

namespace App\Http\Controllers\V1\Admin\Auth;

use App\Contracts\Services\AdminContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\Auth\ForgetPasswordTokenVerifyRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdminForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
     * @return Application|Factory|View
     */
    public function forgotPassword()
    {
        $pageConfigs = ['blankPage' => true];

        return view('admin.auth.passwords.forget-password', ['pageConfigs' => $pageConfigs]);
    }

    public function resetPasswordView($email)
    {
        $pageConfigs = ['blankPage' => true];

        return view('admin.auth.passwords.reset', [
            'email' => $email,
            'pageConfigs' => $pageConfigs,
            'success' => 'An otp set to your mail.Please check your mail!'
        ]);
    }

    public function forgetPasswordTokenSendToEmail(Request $request)
    {
        $response = App::make(AdminContract::class)->forgotPasswordEmailSend($request);
        return response()->json($response);
    }

    public function forgetPasswordTokenVerify(ForgetPasswordTokenVerifyRequest $request)
    {
        $response = App::make(AdminContract::class)->forgotPasswordCodeCheck($request);

        return response()->json($response);
    }

}
