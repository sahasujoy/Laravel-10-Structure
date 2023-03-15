<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    use HasFactory;

    const DELIVERY_STATUS_PENDING = 0;
    const DELIVERY_STATUS_RUNNING = 1;
    const DELIVERY_STATUS_SEND = 2;
    const DELIVERY_STATUS_DELIVERED = 3;
    const DELIVERY_STATUS_FAILED = 4;

    //0 = pending, 1 = running, 2 = send, 3 = `delivered, 4 = failed

    protected $fillable = [
        'notification_id',
        'user_id',
        'app_id',
        'message_title',
        'message',
        'image',
        'launch_url',
        'google_chrome',
        'google_chrome_platform_setting_icon',
        'google_chrome_platform_setting_image_url',
        'google_chrome_platform_setting_badge_url',
        'safari',
        'edge',
        'mozilla_firefox',
        'mozilla_firefox_platform_setting_icon',
        'advanced_setting',
        'advanced_setting_collapse_id',
        'advanced_setting_web_push_topic',
        'advanced_setting_priority',
        'time_to_live',
        'data',
        'contents',
        'filters',
        'include_external_user_ids',
        'include_player_ids',
        'ttl',
        'send_type',
        'send_date',
        'content_type',
        'status',
        'notification_id' ,
        'total_delivered' ,
        'total_messageable_players',
        'total_failed',
        'error_reason'
    ];
}
