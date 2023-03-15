<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatewayProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_type',
        'provider_credentials',
        'status',
    ];

    public function getProviderCredentialsDataAttribute()
    {
        return json_decode($this->attributes['provider_credentials']);
    }
}
