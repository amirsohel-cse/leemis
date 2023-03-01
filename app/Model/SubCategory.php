<?php

namespace App\Model;

use App\Model\SubCategoryTranslation;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['category_id','name','slug','status','photo','top_brand'];

    protected $appends = ['photo_path'];

    public function getTranslation($field = '') {
        $lang = session()->get('lang') ? session()->get('lang') : 'cn';
        $product_translations = $this->hasMany(SubCategoryTranslation::class)->where('lang', $lang)->first();
        return $product_translations != null ? $product_translations->$field : $this->$field;
    }

    public function products(){
        return $this->hasMany(Product::class,'subcategory_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function child_categories()
    {
        return $this->hasMany(ChildCategory::class, 'sub_category_id','id');
    }

    public function sub_categories()
    {
        return $this->hasMany(ChildCategory::class, 'sub_category_id','id');
    }

     public function sliders()
    {
        return $this->hasMany(SubCategorySlider::class, 'subcategory_id');
    }

    public function topBrand()
    {
       return $this->belongsTo(Brand::class,'top_brand')->withDefault();
    }

    public function getPhotoPathAttribute()
    {
        return asset('uploads/category-images/'.$this->photo);
    }
}
