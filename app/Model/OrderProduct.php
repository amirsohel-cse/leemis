<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $guarded=[];

    protected $casts = [
        'attributes' => 'array'
    ];

   protected $appends = ['total_sell'];


    public function product(){
        return $this->belongsTo(Product::class,'product_id','id')->withDefault();
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id','id')->withDefault();
    }
    
    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id','id')->withDefault();
    }

    public function getTotalSellAttribute()
    {
        return $this->qty * $this->product->price;
    }



}
