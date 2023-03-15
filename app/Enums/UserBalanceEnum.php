<?php

namespace App\Enums;
enum UserBalanceEnum: int
{
    case BALANCE_KEY_DAILY = 1;
    case BALANCE_KEY_MONTHLY = 2;

    public function balanceKey(): string
    {
        return match ($this) {
            UserBalanceEnum::BALANCE_KEY_DAILY => 1,
            UserBalanceEnum::BALANCE_KEY_MONTHLY => 2,
        };
    }
}

enum UserBalanceLimitTypeEnum: int
{
    case BALANCE_LIMIT_TYPE_DEFAULT = 1;
    case BALANCE_LIMIT_TYPE_ADMIN = 2;

    public function balanceLimitType(): string
    {
        return match ($this) {
            UserBalanceLimitTypeEnum::BALANCE_LIMIT_TYPE_DEFAULT => 1,
            UserBalanceLimitTypeEnum::BALANCE_LIMIT_TYPE_ADMIN => 2,
        };
    }
}



