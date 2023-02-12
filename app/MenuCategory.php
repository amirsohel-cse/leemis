<?php

namespace App;

use App\Model\SubCategory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $guarded = [];

    protected $with = ['category'];

    public function category()
    {
        return $this->belongsTo(SubCategory::class,'category_id')->withDefault();
    }

}
