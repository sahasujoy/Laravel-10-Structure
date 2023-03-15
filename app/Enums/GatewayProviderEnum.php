<?php

namespace App\Enums;
enum GatewayProviderEnum: int
{
    case SENDGRID = 2; //https://sendgrid.com/
}

enum GatewayProviderStatus: int
{
    case STATUS__ACTIVE = 1;
    case STATUS__INACTIVE = 0;
}


