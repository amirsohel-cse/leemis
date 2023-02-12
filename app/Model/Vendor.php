<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Vendor\Banner;

class Vendor extends Authenticatable
{

    protected $guard = 'vendor';
    
    protected $appends = ['vendor_shop_photo_path','banner_image'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone', 'shop_name', 'address', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function vendor(){
    //     return $this->belongsTo(Order::class,'vendor_id','id');
    // }
    
    public function banner()
    {
        return $this->hasOne(Banner::class,'vendor_id','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public function orders()
    {
        return $this->hasMany(OrderProduct::class);
    }
    
    public function getVendorShopPhotoPathAttribute()
    {
        if($this->shop_image == null){
            return null;
        }
        return asset('uploads/vendors/'.$this->shop_image);
    }
    
    
     public function getBannerImageAttribute()
    {
        
        if($this->banner->file == null){
            return null;
        }
        
        return asset('uploads/vendors/'.$this->banner->file);
    }
    
    
}
