<?php

namespace App\Services;

use App\Contracts\Repositories\AdminRepository;
use App\Contracts\Repositories\ResetPasswordRepository;
use App\Contracts\Services\AdminContract;
use App\Helpers\Helper;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminService implements AdminContract
{

    private AdminRepository $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
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
        } catch (\Exception $e) {
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
        $data = [
            'first_name' => !is_null($request['first_name']) ? $request['first_name'] : "",
            'last_name' => !is_null($request['last_name']) ? $request['last_name'] : "",
            'phone' => !is_null($request['phone']) ? $request['phone'] : ""
        ];

        $where = [
            'id' => $request['user_id']
        ];

        return $this->adminRepository->updateUserDataByCondition($where, $data);
    }


    public function resetUserPassword(Request $request): array
    {
        try {
            $user = $this->updateUserPassword($request);

            if ($user) {
                return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Password successfully updated');
            }

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_BAD_REQUEST, 'Password update failed');
        } catch (\Exception $e) {
            Log::error('User profile data update failed', [$e->getMessage(), $e->getLine()]);

            return Helper::RETURN_ERROR_FORMAT(Response::HTTP_EXPECTATION_FAILED);
        }
    }

    private function updateUserPassword(Request $request): mixed
    {
        $userId = ($request['user_id']);

        $data = [
            'password' => !is_null($request->new_password) ? Hash::make($request->new_password) : "",
        ];
        $where = [
            'id' => $userId
        ];

        return App::make(AdminRepository::class)->updateUserDataByCondition($where, $data);

    }

    public function getSpecificDataByCondition(int $userId)
    {
        $where = ['id' => $userId];
        $select = ['id', 'email', 'first_name', 'last_name', 'phone', 'status', 'avatar'];

        return $this->adminRepository->getSpecificDataByCondition($select, $where);
    }


    public function imageUploadForm(Request $request): array
    {

        if ($request->file('profile_image')) {

            $file = $request->file('profile_image');

            $fileName = Helper::getCustomFileName($file);

            $response = $this->profileImageUpload($request->file('profile_image'), $fileName);

            $this->imageUpdate($request->user_id, $response['data']['url']);

            return Helper::RETURN_SUCCESS_FORMAT(Response::HTTP_OK, 'Profile image update successfully');
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

        $response = $s3Service->setCustomUrl('upload/')->uploadFileToS3($file, $fileName);

        Log::info('$s3Service $response',[$response]);


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

        return $this->adminRepository->updateUserDataByCondition($where, $data);
    }

    public function forgotPasswordEmailSend(Request $request): array
    {
        try {
            // email check
            $user = App::make(AdminRepository::class)->getUserInformationByUserEmail($request['email'], ['id', 'email']);

            if (!isset($user)) {
                return Helper::RETURN_ERROR_FORMAT(Response::HTTP_UNPROCESSABLE_ENTITY, 'No associated Account found');
            }

            if ($user) {
                $resetLink = env('APP_URL') . '/admin/reset-password/' . encrypt($user->email);
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

    private function insertResetPassword($user, $token)
    {
        App::make(ResetPasswordRepository::class)->insertResetPasswordRequest([
            'email' => $user->email,
            'token' => $token,
            'type' => FORGET_PASSWORD_TYPE_ADMIN,
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
        $subject = 'Forget password';
        $htmlTemplate = view('mail.forgotPassword')->with($htmlData)->render();

        $mail = new MailService();
        $mail->sendMailViaSendGrid($subject, $to, $name, $htmlTemplate);
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


                $user = App::make(AdminRepository::class)->getUserInformationByUserEmail($request['email'], ['id', 'email']);

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

}
