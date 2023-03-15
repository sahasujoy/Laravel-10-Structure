<?php


use App\Http\Controllers\V1\Admin\Auth\AdminAuthController;
use App\Http\Controllers\V1\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\V1\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\V1\Admin\Profile\AdminProfileController;
use App\Http\Controllers\V1\Admin\Profile\AdminRegistrationController;
use App\Http\Controllers\V1\Admin\Report\AdminReportController;
use App\Http\Controllers\V1\Admin\Settings\DefaultLimitSettingController;
use App\Http\Controllers\V1\Admin\Settings\GatewayProviderSettingController;
use App\Http\Controllers\V1\Admin\User\UserController;
use App\Http\Controllers\V1\Admin\WebApp\WebAppDashboardController;
use App\Http\Controllers\V1\User\Auth\UserAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AdminAuthController::class, 'index'])->name('admin-home');
Route::get('/login', [AdminAuthController::class, 'loginView'])->name('admin-login-view');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login-admin');
Route::get('/registration', [AdminRegistrationController::class, 'create'])->name('admin-registration-create');
Route::post('/registration', [AdminRegistrationController::class, 'store'])->name('admin-registration-store');
Route::get('forgot-password', [AdminForgotPasswordController::class, 'forgotPassword'])->name('admin-forgot-password');
Route::get('reset-password/{email}', [AdminForgotPasswordController::class, 'resetPasswordView'])->name('admin-reset-password');
/* Route forgot-password */
Route::post('forget/password/token/send', [AdminForgotPasswordController::class, 'forgetPasswordTokenSendToEmail'])->name('admin-forgot-password-token-send');
Route::post('forget/password/token/verify', [AdminForgotPasswordController::class, 'forgetPasswordTokenVerify'])->name('admin-forgot-password-token-verify');


Route::group(['middleware' => ['admin']], function () {

    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');

    /* Route log-out */
    Route::post('log-out', [AdminAuthController::class, 'logout'])->name('admin-log-out');

    /* Route Dashboards */
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
        Route::post('get/state/count/data', [AdminDashboardController::class, 'getStateCountReport'])->name('admin-dashboard-get-state-count-data');
        Route::get('get/project/datatable/list', [AdminDashboardController::class, 'getWebProjectListDataTable'])->name('admin.dashboard-get-project-datatable-list');
    });
    /* Route Dashboards */

    /* Route users */
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'userView'])->name('admin-user-view');
        Route::get('/users', [UserController::class, 'getUser'])->name('admin-user-list');
        Route::post('user/create', [UserController::class, 'createUser'])->name('create-user');
        Route::post('user/delete', [UserController::class, 'deleteUser'])->name('delete-user');
        Route::post('status/update', [UserController::class, 'statusUpdate'])->name('admin.user-status');
        Route::get('info/specific', [UserController::class, 'getUserInformationForSpecificUser'])->name('specific-user-data');
        Route::post('update', [UserController::class, 'updateUserInformation'])->name('update-user-data');
        Route::post('reset/user/password', [UserController::class, 'resetUserPassword'])->name('reset-user-password');
        Route::post('allocate/balance/limit', [UserController::class, 'allocateBalanceLimit'])->name('allocate-balance-limit');
        Route::get('list/data', [UserController::class, 'getUserList'])->name('user-list');
        Route::get('user/force/login/{id}', [UserAuthController::class, 'forceLogin'])->name('user-force-login');
    });
    /* Route Users */

    //Route Tasks
    Route::group(['prefix' => 'task'], function() {
        Route::get('/', [\App\Http\Controllers\V1\Admin\Task\TaskController::class, 'taskView'])->name('admin-task-view');
        Route::get('/tasks', [\App\Http\Controllers\V1\Admin\Task\TaskController::class, 'getTask'])->name('admin-task-list');
        Route::post('task/create', [\App\Http\Controllers\V1\Admin\Task\TaskController::class, 'createTask'])->name('admin-task-create');
        Route::post('task/delete', [\App\Http\Controllers\V1\Admin\Task\TaskController::class, 'deleteTask'])->name('admin-task-delete');
    });

    /* Route Profile */
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/profile-settings', [AdminProfileController::class, 'profileView'])->name('admin-profile-settings');
        Route::get('/get/profile/information', [AdminProfileController::class, 'getUserInformationForSpecificUser'])->name('admin-profile-information-data');
        Route::post('/profile/information/update', [AdminProfileController::class, 'userProfileInformationUpdate'])->name('admin-profile-information-data-update');
        Route::post('/reset/password/update', [AdminProfileController::class, 'resetUserPassword'])->name('admin-reset-password-update');
        Route::post('/image/update', [AdminProfileController::class, 'imageUploadForm'])->name('admin-profile-image-update');
    });
    /* Route Dashboards */


    /* Route Setting */
    Route::group(['prefix' => 'settings'], function () {

        Route::get('/', [DefaultLimitSettingController::class, 'settingView'])->name('admin-setting');
        Route::post('default/limit/data/update', [DefaultLimitSettingController::class, 'defaultLimitSettingCreateOrUpdate'])->name('default-limit-data-update');
        Route::get('get/default/limit/data', [DefaultLimitSettingController::class, 'getDefaultLimitData'])->name('get-default-limit-data');

        /* Route Third party provider */
        Route::get('third/party/provider', [GatewayProviderSettingController::class, 'thirdPartyProviderView'])->name('third-party-provider-view');
        Route::post('set/gateway/provider/data', [GatewayProviderSettingController::class, 'gatewayProviderDataCreateOrUpdate'])->name('set-gateway-provider-data');
        Route::delete('gateway/provider/data/delete', [GatewayProviderSettingController::class, 'gatewayProviderDataDelete'])->name('gateway-provider-data-delete');
        Route::post('gateway/provider/status/change', [GatewayProviderSettingController::class, 'gatewayProviderChangeStatus'])->name('gateway-provider-status-change');

    });
    /* Route Setting */
});








