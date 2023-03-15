<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'app_id',
        'player_id',
        'external_user_id',
        'session_count',
        'language',
        'timezone',
        'game_version',
        'device_os',
        'device_type',
        'device_model',
        'ad_id',
        'tags',
        'last_active',
        'amount_spent',
        'invalid_identifier',
        'sdk',
        'badge_count',
        'test_type',
        'ip',
    ];
}
