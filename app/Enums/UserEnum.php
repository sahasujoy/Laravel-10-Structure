<?php

namespace App\Enums;
enum UserEnum: int
{
    case USER_TYPE__DEFAULT = 1;
    case USER_TYPE__REGISTRATION = 2;

    public function status(): string
    {
        return match ($this) {
            UserEnum::USER_TYPE__DEFAULT => 1,
            UserEnum::USER_TYPE__REGISTRATION => 2,
        };
    }
}

