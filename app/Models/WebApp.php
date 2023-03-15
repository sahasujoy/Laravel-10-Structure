<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebApp extends Model
{
    use HasFactory;

    CONST ACTIVE = 1;
    CONST DELETE = 2;

    protected $fillable = [
        'user_id',
        'app_id',
        'app_name',
        'chrome_web_origin',
        'chrome_web_default_notification_icon',
        'chrome_web_sub_domain',
        'safari_site_origin',
        'onesignal_response',
        'players',
        'app_rest_api_key',
        'messageable_players',
        'status',
        'notification_alert_config_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNotificationAlertConfigCodeDataAttribute()
    {
        return json_decode($this->attributes['notification_alert_config_code']);
    }

}
