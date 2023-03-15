<?php

namespace App\Enums;
enum DefaultLimitsEnum: int
{
    case DEFAULT_LIMIT_PACKAGE_TYPE__DEFAULT = 1;

    public function defaultLimitKey(): string
    {
        return match ($this) {
            DefaultLimitsEnum::DEFAULT_LIMIT_PACKAGE_TYPE__DEFAULT => 1,
        };
    }
}

enum DefaultLimitStatusEnum: int
{
    case STATUS__ACTIVE = 1;
    case STATUS__INACTIVE = 0;
}
