<?php

namespace App\Model;

use App\model\CategoryTranslation;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $appends = ['photo_path'];

    public function getTranslation($field = '') {
        $lang = session()->get('lang') ? session()->get('lang') : 'cn';
        $product_translations = $this->hasMany(CategoryTranslation::class)->where('lang', $lang)->first();
        return $product_translations != null ? $product_translations->$field : $this->$field;
    }


    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class,'category_id','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function getPhotoPathAttribute()
    {
        return asset('uploads/category-images/'.$this->photo);
    }

    public function attributes()
    {
        return $this->hasMany(CategoryAttribute::class);
    }

}
