<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{

    protected $guarded = [];



    public function categoryAttribute()
    {
        return $this->belongsTo(CategoryAttribute::class);
    }

    public function productCategoryAttribute()
    {
        return $this->hasMany(ProductCategoryAttribute::class);
    }
}
