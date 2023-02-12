<?php

namespace App;

use App\Model\AttributeOption;
use App\Model\CategoryAttribute;
use Illuminate\Database\Eloquent\Model;

class ProductCategoryAttribute extends Model
{
    protected $guarded = [];


    public function attributeName()
    {
        return $this->belongsTo(CategoryAttribute::class, 'category_attribute_id');
    }

    public function optionname()
    {
        return $this->belongsTo(AttributeOption::class, 'attribute_option_id');
    }
}
