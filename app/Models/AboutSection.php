<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'ar_title',
        'en_title',
        'image',
        'position',
        'ar_desc',
        'en_desc',
        'telegram',
        'tiktok',
        'snapchat',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'phone',
        'email',
        'address',
    ];
}
