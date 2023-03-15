<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessOverallStateDailyCount extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $fillable = [
        'user_id',
        'app_id',
        'daily_date',
        'total_project',
        'total_user',
        'total_notification',
        'total_players',
        'total_messageable_players',
        'total_delivered',
        'total_failed',

    ];

}
