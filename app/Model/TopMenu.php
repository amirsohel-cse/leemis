<?php

namespace App\Model;

use App\MenuBrand;
use App\MenuCategory;
use Illuminate\Database\Eloquent\Model;

class TopMenu extends Model
{
    protected $fillable = ['name','url','status','images'];
    
      protected $appends = ['photo_path'];

    protected $casts = ['images' => 'array'];

    protected $with = ['menuCategories','menuBrands'];

    public function menuCategories()
    {
       return $this->hasMany(MenuCategory::class,'menu_id');
    }

    public function menuBrands()
    {
        return $this->hasMany(MenuBrand::class,'menu_id');
    }
    
    public function getPhotoPathAttribute()
    {
        $asset = [];
        foreach($this->images as $image){
            array_push($asset, asset('uploads/top_menu_images/'.$image));
        }
        return $asset;
    }
    
}
