<?php

namespace App\Contracts\Services;

interface MailContract
{
    public function sendMailViaSendGrid($subject, $to, $name, $message);

//    public function sendMailViaSendPostMark($userData, $requestData);

}
