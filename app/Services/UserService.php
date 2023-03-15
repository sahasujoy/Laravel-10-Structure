<?php

namespace App\Services;


use App\Contracts\Repositories\DefaultLimitRepository;
use App\Contracts\Repositories\ProcessOverallStateCountDailyRepository;
use App\Contracts\Repositories\ResetPasswordRepository;
use App\Contracts\Repositories\UserBalanceLimitsRepository;
use App\Contracts\Repositories\UserRepository;
use App\Contracts\Services\UserContract;
use App\Enums\DefaultLimitsEnum;
use App\Enums\DefaultLimitStatusEnum;
use App\Enums\UserBalanceEnum;
use App\Enums\UserBalanceLimitTypeEnum;
use App\Enums\UserEnum;
use App\Helpers\Helper;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

class UserService implements UserContract
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUserDataTable(Request $request)
    {
        $response = $this->getAllUser($request);

        return Datatables::of($response)
            ->addColumn('user_info', function ($response) {

                $userID = encrypt($response->id);

                //'email', 'first_name', 'last_name', 'phone', 'type', 'status'
                $email = $response->email;
                $status = '<span class="v-chip v-theme--light text-success v-chip--density-default v-chip--size-small v-chip--variant-outlined"
                                                draggable="false"><!----><span class="v-chip__underlay"></span>Active</span>';
                if($response->status == 0){
                    $status = '<span class="v-chip v-theme--light text-danger v-chip--density-default v-chip--size-small v-chip--variant-outlined"
                                                draggable="false"><!----><span class="v-chip__underlay"></span>Inactive</span>';

                }

                $type = 'Admin';
                if($response->type == 1){
                    $type = "Registration";
                }

                $phone = isset($response->phone) ? $response->phone : "Phone Number Not Found";
                $name = isset($response->first_name) ? $response->first_name . " " : "No Name ";
                $name .= isset($response->last_name) ? $response->last_name : "";
                $profileImage = asset('images/portrait/small/avatar-s-11.jpg"');
                if(!empty($response->avatar)){
                    $profileImage = $response->avatar;
                }

                // Uages Limit Data
                $monthlyCurrentBalance = 0;
                $monthlyUsage = 0;
                $appCurrentBalance = 0;
                $appUsage = 0;

                foreach ($response->userBalanceLimit as $balanceLimit) {

                    if ($balanceLimit->balance_key == 1) {// app/project limit
                        $appCurrentBalance = $balanceLimit->current_balance;
                        $appUsage = $balanceLimit->balance - $appCurrentBalance;
                    }
                    if ($balanceLimit->balance_key == 2) {// monthly limit
                        $monthlyCurrentBalance = $balanceLimit->current_balance;
                        $monthlyUsage = $balanceLimit->balance - $monthlyCurrentBalance;
                    }
                }
                $appData = '0/0';
                $monthlyData = '0/0';
                if($monthlyCurrentBalance){
                    $monthlyData = $monthlyCurrentBalance ."/".$monthlyUsage;
                }
                if($appCurrentBalance){
                    $appData = $appCurrentBalance ."/".$appUsage;
                }
                /// Status

                return '<div class="card user-card mb-0">
                            <div class="card-body p-1">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                        <div class="user-avatar-section">
                                            <div class="d-flex justify-content-start">
                                                <img class="img-fluid rounded" src=" ' . $profileImage . ' " height="60" width="60" alt="User avatar">
                                                <div class="d-flex flex-column ml-1">
                                                    <div class="user-info mb-1">
                                                        <h4 class="mb-0"> ' . $name . ' </h4>
                                                        <span class="card-text"> ' . $email . ' </span>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary waves-effect waves-float waves-light
                                                        edit-user" id="edit-user" data-id = "' . $userID . '">Edit</a>
                                                        <button href="javascript:void(0)" class="btn  btn-sm btn-outline-danger ml-1 waves-effect" data-id = "' . $userID . '"  id="delete-user">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center user-total-numbers">
                                            <div class="d-flex align-items-center mr-2">
                                                <div class="color-box bg-light-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign text-primary"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                                </div>
                                                <div class="ml-1">
                                                    <h5 class="mb-0"> ' . $appData . ' </h5>
                                                    <small>App/Project Limit/Usages</small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="color-box bg-light-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up text-success"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                                                </div>
                                                <div class="ml-1">
                                                    <h5 class="mb-0"> ' . $monthlyData . ' </h5>
                                                    <small>Monthly Limit/Usages</small>
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

                                             <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                   <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" tag="i" class="v-icon notranslate v-theme--light v-icon--size-default iconify iconify--tabler mr-1" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M3 19h18"></path><rect width="14" height="10" x="5" y="6" rx="1"></rect></g></svg>
                                                   <span class="card-text user-info-title font-weight-bold mb-0">Create by</span>
                                                </div>
                                                <p class="card-text mb-0"> ' . $type . ' </p>
                                            </div>

                                            <div class="d-flex flex-wrap">
                                                <div class="user-info-title">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone mr-1"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                                    <span class="card-text user-info-title font-weight-bold mb-0">Contact</span>
                                                </div>
                                                <p class="card-text mb-0">' . $phone . '</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
            })
            ->addColumn('action', function ($response) {

                $userID = encrypt($response->id);

                $appBalance = 0;
                $monthlyNotificationBalance = 0;

                foreach ($response->userBalanceLimit as $balanceLimit) {
                    if ($balanceLimit->balance_key == 1) {
                        $appBalance = $balanceLimit->balance;
                    }
                    if ($balanceLimit->balance_key == 2) {
                        $monthlyNotificationBalance = $balanceLimit->balance;
                    }
                }

                $status = '<a href="javascript:void(0)" class="btn btn-sm dropdown-item" id="active-user" data-id = "' . $userID . '">
                                    <div class="avatar bg-light-primary">
                                         <i class="fa fa-solid fa-check-circle" class="avatar-icon"></i>
                                    </div>
                                    Active</a>';
                if($response->status == 1){// active user constant value
                    $status = '<a href="javascript:void(0)" class="btn btn-sm dropdown-item" id="deactive-user" data-id = "' . $userID . '">
                                    <div class="avatar bg-light-primary">
                                         <i class="fa fa-ban" class="avatar-icon"></i>
                                    </div>
                                    Deactivate</a>';
                }

                $action = '<div class="btn-group">
                            <a href="" class="btn btn-sm     " data-toggle="dropdown">
                                <span class="">
                                    <i class="fa fa-ellipsis-v" class="avatar-icon"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">

                                <a href="javascript:void(0)" class="btn btn-sm dropdown-item edit-user" id="edit-user" data-id = "' . $userID . '">
                                    <div class="avatar bg-light-primary">
                                        <i class="fa fa-edit"></i>
                                    </div>
                                    Edit
                                </a>
                                <a href="'. route('user-force-login', [$userID]).'" class="btn btn-sm dropdown-item " target="blank">
                                    <div class="avatar bg-light-primary">
                                        <i class="fa fa-arrow-alt-circle-right"></i>
                                    </div>
                                    Force Login</a>
                                <a href="javascript:void(0)" class="btn btn-sm dropdown-item" id="limit-allocation"
                                data-app-limit="'.$appBalance.'" data-monthly-notification-limit="'.$monthlyNotificationBalance.'" data-id = "' . $userID . '">
                                    <div class="avatar bg-light-primary">
                                        <i class="fa fa-solid fa-store" class="avatar-icon"></i>
                                    </div>
                                    Limit allocation</a>
                                ' . $status . '
                                <a href="javascript:void(0)" class="btn btn-sm dropdown-item" id="change-user-password" data-id = "' . $userID . '">

                                    <i class="fa fa-solid fa-lock-open p-0" class="avatar-icon"></i>
                                    Reset password</a>
                                <a href="javascript:void(0)" class="btn btn-sm dropdown-item" id="delete-user" data-id = "' . $userID . '">
                                    <div class="avatar bg-light-primary">
                                        <i class="fa fa-user-minus" class="avatar-icon"></i>
                                    </div>
                                    Delete</a>
                            </div>
                        </div>';

                return $action;
            })
            ->rawColumns(['action', 'user_info'])
            ->make(true);
    }

    public function getAllUser(Request $request)
    {
        try {
            return $this->userRepository->getAllUser(['id', 'email', 'first_name', 'last_name', 'phone', 'type', 'status']);
        } catch (Exception  $e) {
            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_EXPECTATION_FAILED, 'Failed to get user data', []);
        }
    }

    /**
     * Create New user
     * @param Request $request
     * @return array
     */
    public function registrationUser(Request $request): array
    {
        try {

            if (!isset($request['password']) && empty($request['password'])) {
                $request['password'] = Helper::generateRandomString(8, $pass = true);
            }

            $userId = $this->createUser(
                $request['first_name'],
                $request['email'],
                $request['type'],
                $request['last_name'],
                $request['password'],
                $request['phone'],
            );

            if ($userId) {

                $dateTime = date("Y-m-d");
                //Update overall state count reports [Date and app id wise total_player and total_messageable players]
                $dataUpdate = [
                    'total_user' => 1
                ];
                $dataInsert = [
                    'user_id' => $userId,
                    'daily_date' => $dateTime,
                    'total_user' => 1
                ];

                $this->updateOrCreateOverallStateCount($userId, $dateTime, $dataUpdate, $dataInsert );

                //todo // Mail send for user
                $name = $request['first_name'];
                $htmlData['password'] = $request['password'];
                $htmlData['name'] = $name;


                $to = $request['email'];
                $subject = 'Welcome To OLK9 push notification ';
                $htmlTemplate = view('mail.registration')->with($htmlData)->render();

                $mail = new MailService();
                $mail->sendMailViaSendGrid($subject, $to, $name, $htmlTemplate);

                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_CREATED, 'User created successfully and check your mail address for password');
            }

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'User registration failed');

        } catch (Exception $e) {
            Log::error('User registration failed', [$e->getMessage(), $e->getLine()]);

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_EXPECTATION_FAILED);
        }
    }

    /**
     * Independent method for insert data in user table
     * @param $firstName
     * @param $email
     * @param $type
     * @param $last_name
     * @param $password
     * @param $phone
     * @return mixed
     */
    public function createUser(
        $firstName,
        $email,
        $type,
        $last_name = null,
        $password = null,
        $phone = null
    )
    {
        try {



            $data = [
                'first_name' => !is_null($firstName) ? $firstName : "",
                'last_name' => !is_null($last_name) ? $last_name : null,
                'email' => !is_null($email) ? $email : "",
                'phone' => !is_null($phone) ? $phone : null,
                'type' => ($type == USER_TYPE__DEFAULT) ? USER_TYPE__DEFAULT : USER_TYPE__REGISTRATION,
                'password' => Hash::make($password)
            ];

            $user =  $this->userRepository->createRegisterUser($data);
            if ($user) {
                //todo // Default package / plan insert
                $this->getAndSetDefaultPackage($user->id);
                return $user->id;
            }

        } catch (Exception $e) {
            Log::error('User registration failed', [$e->getMessage(),$e->getLine()]);

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_EXPECTATION_FAILED);
        }
    }

    /**
     * Delete user from user table
     * @param Request $request
     * @return array
     */
    public function deleteUser(Request $request): array
    {
        try {
            $userId = decrypt($request['user_id']);

            $response = $this->userRepository->deleteUser(['id' => $userId]);

            if ($response) {
                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'User Deleted Successfully', $response);
            }

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'User Deleted Failed');

        } catch (Exception $e) {
            Log::error("Delete User : ", [$e->getMessage()]);
            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'User Deleted Failed');
        }
    }

    /**
     * Update user status
     * @param Request $request
     * @return array
     */
    public function statusUpdate(Request $request): array
    {
        try {
            $userId = decrypt($request->user_id);
            $response = $this->userRepository->statusUpdate(
                ['id' => $userId],
                ['status' => $request->status]
            );

            if ($response) {
                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'User Updated Successfully', $response);
            }

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'User Updated Failed');

        } catch (Exception $e) {
            Log::error("Update User Status : ", [$e->getMessage()]);
            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'User Updated Failed .');
        }
    }

    public function getUserCount(Request $request)
    {
        return App::make(UserRepository::class)->getUserCount($request['from_date'], $request['to_date']);
    }

    /**
     * Get User Information for a specific user
     * @param $userId
     * @return array
     */
    public function getUserInformationForSpecificUser(int $userId): array
    {
        try {

            $responseData = $this->getSpecificDataByCondition($userId);

            return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'User data found', $responseData);

        } catch (Exception  $e) {
            Log::info('error in getUserInformationForSpecificUser',[$e->getMessage(),$e->getLine()]);
            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_EXPECTATION_FAILED, 'Failed to get user data', []);
        }
    }

    public function getSpecificDataByCondition(int $userId)
    {
        $where = ['id' => $userId];
        $select = ['id', 'email', 'first_name', 'last_name', 'phone', 'type', 'status', 'avatar'];

        return $this->userRepository->getSpecificDataByCondition($select, $where);
    }

    /**
     * User Profile Information Data Update
     * @param Request $request
     * @return array
     */
    public function updateProfileInformationData(Request $request): array
    {
        try {
            $user = $this->updateProfileDataUpdate($request);

            if ($user) {
                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'User profile data successfully updated');
            }

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'User profile data update failed');
        } catch (Exception $e) {
            Log::error('User profile data update failed', [$e->getMessage()]);

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_EXPECTATION_FAILED);
        }
    }

    /**
     * Update Profile Data Insert Function
     * @param Request $request
     * @return mixed
     */
    private function updateProfileDataUpdate(Request $request): mixed
    {
        $userId = ($request['user_id']);

        $data = [
            'first_name' => !is_null($request->first_name) ? $request->first_name : "",
            'last_name' => !is_null($request->last_name) ? $request->last_name : "",
            'phone' => !is_null($request->phone) ? $request->phone : ""
        ];
        $where = [
            'id' => $userId
        ];

        return $this->userRepository->updateUserDataByCondition($where, $data);
    }

    public function resetUserPassword(Request $request): array
    {
        try {
            $user = $this->updateUserPassword($request);

            if ($user) {
                //todo // Mail send for user
                $name = $request['first_name'];
                $htmlData['password'] = $request['password'];
                $htmlData['name'] = $name;


                $to = $request['email'];
                $subject = 'User Password Change ';
                $htmlTemplate = view('mail.registration')->with($htmlData)->render();

                $mail = new MailService();
                $mail->sendMailViaSendGrid($subject, $to, $name, $htmlTemplate);

                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Password successfully updated');
            }

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'Password update failed');
        } catch (Exception $e) {
            Log::error('User profile data update failed', [$e->getMessage(), $e->getLine()]);

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_EXPECTATION_FAILED);
        }
    }

    private function updateUserPassword(Request $request): mixed
    {
        try {
            $userId = ($request['user_id']);

            $data = [
                'password' => !is_null($request->new_password) ? Hash::make($request->new_password) : "",
            ];

            $where = [
                'id' => $userId
            ];

            return $this->userRepository->updateUserDataByCondition($where, $data);

        } catch (Exception $exception) {
            Log::error('Update user password failed', [$exception->getMessage(), $exception->getLine()]);

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_EXPECTATION_FAILED);
        }
    }


    public function getUserList()
    {
        return $this->userRepository->getUserList();
    }

    /**
     * Image upload form
     * @param Request $request
     * @return array
     */
    public function imageUploadForm(Request $request): array
    {

        if ($request->file('profile_image')) {

            $file = $request->file('profile_image');

            $fileName = Helper::getCustomFileName($file);

            $response = $this->profileImageUpload($request->file('profile_image'), $fileName);

            $this->imageUpdate($request->user_id, $response['data']['url']);

            return Helper::RETURN_SUCCESS_FORMAT(\Illuminate\Http\Response::HTTP_OK, 'Profile image update successfully');
        }

        return Helper::RETURN_ERROR_FORMAT(Response::HTTP_EXPECTATION_FAILED, 'Failed to upload image', []);
    }

    /**
     * Image Upload To S3 Server
     * @param $file
     * @param $fileName
     * @return array
     */
    public function profileImageUpload($file, $fileName): array
    {
        $s3Service = new S3ServiceAWS();

        $response = $s3Service->setCustomUrl('upload/user/profile/')->uploadFileToS3($file, $fileName);


        return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Profile image successfully upload', $response);

    }

    /**
     * Update admin profile image
     * @param $title
     * @param $imageUrl
     * @return mixed
     */
    public function imageUpdate($userId, $imageUrl)
    {
        $where = ['id' => $userId];
        $data = ['avatar' => $imageUrl];

        return $this->userRepository->updateUserDataByCondition($where, $data);
    }

    public function forgotPasswordEmailSend(Request $request): array
    {
        try {
            // email check
            $user = App::make(UserRepository::class)->getUserInformationByUserEmail($request['email'], ['id', 'email']);

            if (!isset($user)) {
                return Helper::RETURN_ERROR_FORMAT(Response::HTTP_UNPROCESSABLE_ENTITY, 'No associated Account found');
            }

            if ($user) {
                $resetLink = env('APP_URL') . '/reset-password/' . encrypt($user->email);
                // code generate
                $token = Helper::generateNumber(6);
                // insert data in db and date will be utc
                $this->insertResetPassword($user, $token);
                // Mail send with token
                $this->sendMail($user, $token, $resetLink);

                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Please check you email');
            }

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'Password reset failed');

        } catch (Exception $e) {
            Log::error('User forgot password Failed: ', [$e->getMessage(), $e->getLine()]);

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_EXPECTATION_FAILED, 'Password reset failed');
        }
    }

    public function forgotPasswordCodeCheck(Request $request)
    {
        try {
            // code and email exist check
            $passwordReset = App::make(ResetPasswordRepository::class)->getDataByTokenAndEmail($request->token_code, $request->email);

            if (is_null($passwordReset)) {
                return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'Invalid request. Please request again !!');
            }

            if ($passwordReset->type != FORGET_PASSWORD_TYPE_ADMIN) {
                return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'Unauthorized request. Please request again !!');
            }

            if (!($passwordReset->expire_time >= Carbon::now())) {
                return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'Token Expired. Please request for new token code');
            }

            if (($passwordReset->is_used) == FORGET_PASSWORD_USED) {

                return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'Your verification code is already used');
            }

            if ($passwordReset->is_used == FORGET_PASSWORD_NOT_USED) {

                $user = App::make(UserRepository::class)->getUserInformationByUserEmail($request['email'], ['id', 'email']);

                $data = [
                    'is_used' => FORGET_PASSWORD_USED
                ];

                App::make(ResetPasswordRepository::class)->updateResetPasswordById($passwordReset->id, $data);

                $request['user_id'] = $user->id;
                $this->updateUserPassword($request);

                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'You have successfully verified code', [
                    'id' => $passwordReset->id,
                    'email' => $request['email'],
                ]);

            }
        } catch (Exception $exception) {
            Log::error('forgot Password Code Check Failed: ', [$exception->getMessage(), $exception->getLine()]);

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_EXPECTATION_FAILED, 'Forgot password code check failed');
        }
    }

    private function insertResetPassword($user, $token)
    {
        App::make(ResetPasswordRepository::class)->insertResetPasswordRequest([
            'email' => $user->email,
            'token' => $token,
            'type' => FORGET_PASSWORD_TYPE_USER,
            'expire_time' => Carbon::now()->addMinutes(10),
            'is_used' => FORGET_PASSWORD_NOT_USED
        ]);
    }

    private function sendMail($user, $token, $resetLink)
    {
        $name = $user->first_name;
        $htmlData['password'] = $token;
        $htmlData['name'] = $name;
        $htmlData['resetLink'] = $resetLink;

        $to = $user->email;
        $subject = 'Forgot password';
        $htmlTemplate = view('mail.forgotPassword')->with($htmlData)->render();

        $mail = new MailService();
        $mail->sendMailViaSendGrid($subject, $to, $name, $htmlTemplate);
    }

    /**
     * Set default package to an user
     * @param int $user_id
     * @return bool|void
     */
    public function getAndSetDefaultPackage(int $user_id)
    {
        try {

            $select = ['apps_limit', 'monthly_limit', 'status'];
            $where = [
                'type' => DEFAULT_LIMIT_PACKAGE_TYPE__DEFAULT,
                'status' => STATUS__ACTIVE
            ];

            $getDefaultPackage = App::make(DefaultLimitRepository::class)->getDefaultLimit($select, $where);
            if ($getDefaultPackage) {
                $apps_limit = $getDefaultPackage->apps_limit;
                $monthly_limit = $getDefaultPackage->monthly_limit;
                // Balance insert
                $responsePerDay = $this->createUserBalance($user_id, $apps_limit, $apps_limit, $monthly_limit, $monthly_limit);

                if ($responsePerDay) {
                    return true;
                }
                return false;
            }

        } catch (\Exception $e) {
            Log::error('Error in createUserBalance', [$e->getMessage(), $e->getLine()]);
            return false;
        }
    }

    /**
     * Insert User Balance Data Using THis function
     * @param $user_id
     * @param $per_day_limit
     * @param $per_day_current_balance
     * @param $monthly_limit
     * @param $monthly_current_balance
     * @return false
     */
    private function createUserBalance($user_id, $apps_limit, $apps_current_balance, $monthly_limit, $monthly_current_balance)
    {
        try {
            $balance_key_apps = UserBalanceEnum::from(1)->value;
            $balance_key_monthly = UserBalanceEnum::from(2)->value;
            $limit_type = UserBalanceLimitTypeEnum::from(1)->value;

            $data = [
                [
                    'user_id' => $user_id,
                    'balance_key' => $balance_key_apps,
                    'balance' => $apps_limit,
                    'current_balance' => $apps_current_balance,
                    'limit_type' => $limit_type
                ], [
                    'user_id' => $user_id,
                    'balance_key' => $balance_key_monthly,
                    'balance' => $monthly_limit,
                    'current_balance' => $monthly_current_balance,
                    'limit_type' => $limit_type
                ]
            ];


            return App::make(UserBalanceLimitsRepository::class)->insertUserBalance($data);

        } catch (\Exception $e) {
            Log::error('Error in createUserBalance', [$e->getMessage(), $e->getLine()]);

            return false;
        }

    }


    /**
     * Set default package to an user
     * @param int $user_id
     * @return array
     */
    public function getAndSetAdminDefinePackageValue(int $user_id, int $apps_limit, int $monthly_limit, $type = 1)
    {
        try {

            $select = ['current_balance', 'balance'];
            $where = [
                'balance_key' => UserBalanceEnum::BALANCE_KEY_DAILY,
                'user_id' => $user_id
            ];

            $getAppLimitBalance = App::make(UserBalanceLimitsRepository::class)->getUserBalanceLimit($select, $where);

            $where = [
                'balance_key' => UserBalanceEnum::BALANCE_KEY_MONTHLY,
                'user_id' => $user_id
            ];
            $getMonthlyLimitBalance = App::make(UserBalanceLimitsRepository::class)->getUserBalanceLimit($select, $where);

            if ($getAppLimitBalance) {

                $appsCurrentBalance = $apps_limit;
                $perMonthlyCurrentBalance = $monthly_limit;

                if($type == 2){
                    $appLimitBalance = $getAppLimitBalance->balance;
                    $appCurrentBalance = $getAppLimitBalance->current_balance;

                    $monthlyLimitBalance = $getMonthlyLimitBalance->balance;
                    $monthlyCurrentBalance = $getMonthlyLimitBalance->current_balance;

                    $perDayLimitUsages = $appLimitBalance - $appCurrentBalance;
                    $appsCurrentBalance = $apps_limit - $perDayLimitUsages;

                    $perMonthlyLimitUsages = $monthlyLimitBalance - $monthlyCurrentBalance;
                    $perMonthlyCurrentBalance = $monthly_limit - $perMonthlyLimitUsages;

                }

                App::make(UserBalanceLimitsRepository::class)->deleteByWhere(['user_id' => $user_id]);
                // Balance insert

                $responsePerDay = $this->createUserBalance($user_id, $apps_limit, $appsCurrentBalance, $monthly_limit, $perMonthlyCurrentBalance);

                if ($responsePerDay) {
                    return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'User balance update Successfully');
                }
                return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'User balance update failed');
            }

        } catch (\Exception $e) {
            Log::error('Error in getAndSetAdminDefinePackageValue', [$e->getMessage(), $e->getLine()]);
            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'User balance update failed');
        }
    }


    private function updateOrCreateOverallStateCount($userId, $dateTime, $dataUpdate, $dataInsert)
    {
        $where = ['user_id' => $userId,  'daily_date' => $dateTime];
        $select = ['id'];
        // check data exits
        $dailyProcessData = App::make(ProcessOverallStateCountDailyRepository::class)->getSpecificDataByWhere($where, $select);

        if ($dailyProcessData) {
            App::make(ProcessOverallStateCountDailyRepository::class)->updateByWhere($where, $dataUpdate);
        } else {
            App::make(ProcessOverallStateCountDailyRepository::class)->createData($dataInsert);
        }
    }


}
