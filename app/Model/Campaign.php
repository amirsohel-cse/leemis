<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['type','file'];
    
    protected $appends = ['photo_path'];
    
    public function getPhotoPathAttribute(){
        return asset('storage/storeLogo/'.$this->file);
    }
}
