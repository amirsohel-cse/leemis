<?php

namespace App;

use App\Model\Brand;
use Illuminate\Database\Eloquent\Model;

class MenuBrand extends Model
{
    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(SubCategory::class,'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
}
