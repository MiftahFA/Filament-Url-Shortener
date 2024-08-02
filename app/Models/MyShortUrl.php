<?php

namespace App\Models;

use App\Models\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AshAllenDesign\ShortURL\Models\ShortURL;

class MyShortUrl extends ShortURL
{
    use HasFactory;
    use Multitenantable;

    protected $fillable = [
        'destination_url',
        'default_short_url',
        'url_key',
        'single_use',
        'user_id',
        'forward_query_params',
        'track_visits',
        'redirect_status_code',
        'track_ip_address',
        'track_operating_system',
        'track_operating_system_version',
        'track_browser',
        'track_browser_version',
        'track_referer_url',
        'track_device_type',
        'activated_at',
        'deactivated_at',
    ];

    //add belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
