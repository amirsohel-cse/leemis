<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{


    protected $guarded = [];


    public function options()
    {
        return $this->hasMany(AttributeOption::class,'category_attribute_id');
    }

    public function productAttribute()
    {
        return $this->hasMany(ProductCategoryAttribute::class,'category_attribute_id');
    }
    
}
