<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBalanceLimit extends Model
{
    use HasFactory;

    const BALANCE_KEY_FOR_APP = 1;

    protected $fillable = [
        'balance_key',
        'user_id',
        'balance',
        'current_balance',
        'limit_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
