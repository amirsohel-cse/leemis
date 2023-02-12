<?php

namespace App\Vendor;

use App\Model\Vendor;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
    protected $fillable = ['file' ,'vendor_id'];
    
    protected $appends = ['banner_image'];
    
    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id','id');
    }
    
    
       public function getBannerImageAttribute()
    {
        
        if($this->file == null){
            return null;
        }
        
        return asset('storage/storeFavicon/'.$this->file);
    }
}
