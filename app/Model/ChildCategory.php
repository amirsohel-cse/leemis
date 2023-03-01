<?php

namespace App\Model;

use App\Model\ChildCategoryTranslation;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $fillable = ['sub_category_id','name','slug','status'];


    public function getTranslation($field = '') {
        $lang = session()->get('lang') ? session()->get('lang') : 'cn';
        $product_translations = $this->hasMany(ChildCategoryTranslation::class)->where('lang', $lang)->first();
        return $product_translations != null ? $product_translations->$field : $this->$field;
    }


    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }
}
