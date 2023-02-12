<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    protected $fillable = ['image_file','product_id'];



    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    protected $guarded=[];


}
