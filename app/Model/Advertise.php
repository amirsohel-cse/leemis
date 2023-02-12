<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    //
    protected $fillable = ['subtitle','title','description','image_file','link','text_position'];
    protected $appends = ['photo_path'];
    
    public function getPhotoPathAttribute()
    {
        return asset('assets/images/advertisement/'.$this->ad_image);
    }
}
