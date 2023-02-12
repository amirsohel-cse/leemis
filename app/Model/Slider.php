<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    
      protected $appends = ['photo_path'];
    //
    protected $fillable = ['subtitle','title','description','image_file','link','text_position'];
    
    
     public function getPhotoPathAttribute()
    {
        return asset('storage/storeSliders/'.$this->image_file);
    }

}
