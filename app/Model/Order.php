<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];



    public function orderProduct(){
        return $this->hasMany(OrderProduct::class);
    }

   
}
