<?php

namespace App\Enums;
enum EmailGatewayEnum: int
{
    case SENDGRID = 1;
    case POSTMARK = 2;
}



