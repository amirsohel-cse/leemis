<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FacebookPixel extends Model
{
    protected $fillable = [
        'facebook_account_name',
        'pixel_name',
        'pixel_id'
    ];
}
