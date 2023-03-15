<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultLimit extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'apps_limit',
        'monthly_limit',
        'status',
    ];

}
