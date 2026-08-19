<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // app/Models/Setting.php

    protected $fillable = [

        'site_name',
        'logo',
        'favicon',

        'header_code',
        'footer_code',

        'google_analytics_id',
        'facebook_pixel_id',

        'copyright_text',

        // NEW
        'company_email',
        'company_phone',
        'company_address',
        'footer_about',

        'facebook',
        'instagram',
        'youtube',
        'twitter',
        'linkedin',
        'tiktok',
        'pinterest',
        'quora',

    ];
}