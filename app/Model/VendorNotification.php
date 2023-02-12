<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VendorNotification extends Model
{
    protected $fillable = ['order_code','order_id','order_product_id','name','read_at','type','vendor_id'];
}
