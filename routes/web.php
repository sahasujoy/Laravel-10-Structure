<?php

use App\Http\Controllers\V1\Admin\User\UserController;
use App\Http\Controllers\V1\Admin\WebApp\WebAppDashboardController;
use App\Http\Controllers\V1\User\Auth\UserAuthController;
use App\Http\Controllers\V1\User\Auth\UserForgotPasswordController;
use App\Http\Controllers\V1\User\Broadcast\BroadcastController;
use App\Http\Controllers\V1\User\Dashboard\UserDashboardController;
use App\Http\Controllers\V1\User\DeliveryReport\DeliveryReportController;
use App\Http\Controllers\V1\User\Home\HomeController;
use App\Http\Controllers\V1\User\Profile\UserProfileController;
use App\Http\Controllers\V1\User\Profile\UserRegistrationController;
use App\Http\Controllers\DesignTeam\DesignController;
use App\Http\Controllers\V1\User\Reports\UserReportsController;
use App\Http\Controllers\V1\User\Segment\SegmentController;
use App\Http\Controllers\V1\User\Subscription\SubscriptionController;
use App\Http\Controllers\WebApp\WebAppController;
use App\Services\OneSignalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/notification', function () {
    return view('welcome');
});

// Main Page Route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/registration', [UserRegistrationController::class, 'create'])->name('user-registration-view');
Route::post('/registration', [UserRegistrationController::class, 'createUser'])->name('user-registration');
Route::get('/login', [UserAuthController::class, 'loginView'])->name('user-login-view');
Route::post('/login', [UserAuthController::class, 'login'])->name('user-login');
Route::get('forgot-password', [UserForgotPasswordController::class, 'forgotPassword'])->name('user-forgot-password');
Route::get('reset-password/{email}', [UserForgotPasswordController::class, 'resetPasswordView'])->name('user-reset-password');
/* Route forgot-password */
Route::post('forget/password/token/send', [UserForgotPasswordController::class, 'forgetPasswordTokenSendToEmail'])->name('user-forgot-password-token-send');
Route::post('forget/password/token/verify', [UserForgotPasswordController::class, 'forgetPasswordTokenVerify'])->name('user-forgot-password-token-verify');

Route::group(['middleware' => ['auth']], function () {

    /* Route log-out */
    Route::post('log-out', [UserAuthController::class, 'logout'])->name('user-log-out');

    /* Route Dashboards */
    Route::group(['prefix' => 'app'], function () {
//        Route::get('/', [UserDashboardController::class, 'index'])->name('user-dashboard');
        Route::get('/', [WebAppController::class, 'viewList'])->name('user-dashboard');
    });
    /* Route Dashboards */

    Route::post('p/image/upload', [WebAppController::class, 'publicImageUpload' ])->name('image-uploader');

    /* Route Profile */
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/profile-settings', [UserProfileController::class, 'profileView'])->name('user-profile-settings');
        Route::get('/get/profile/information', [UserProfileController::class, 'getUserInformationForSpecificUser'])->name('user-profile-information-data');
        Route::post('/profile/information/update', [UserProfileController::class, 'userProfileInformationUpdate'])->name('user-profile-information-data-update');
        Route::post('/user/profile/image/update', [UserProfileController::class, 'imageUploadForm'])->name('user-profile-image-update');
        Route::post('/user/reset/password/update', [UserProfileController::class, 'resetUserPassword'])->name('user-reset-password-update');

    });
    /* Route Dashboards */

});







