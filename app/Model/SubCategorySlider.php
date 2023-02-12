<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subcategoryslider extends Model
{
    
      protected $appends = ['photo_path'];
    
     public function getPhotoPathAttribute()
    {
        return asset('storage/subcategorysliderstore/'.$this->photo);
    }
    
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }

}