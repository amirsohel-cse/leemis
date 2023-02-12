<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckoutInfo extends Model
{
    protected $table = 'checkout_info';

    protected $casts = ['info' => 'object'];

    protected $guarded = [];
}
