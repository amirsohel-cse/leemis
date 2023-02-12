<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $casts = [
        'attributes' => 'array'
    ];
    protected $guarded  = [];



    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
