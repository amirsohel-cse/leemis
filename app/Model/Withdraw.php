<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $guarded = [];
    
    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
}