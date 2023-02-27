<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    protected $table = 'product_translations';

    protected $casts = [
        'specification' => 'array'
    ];
}
