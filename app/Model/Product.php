<?php

namespace App\Model;

use App\ProductCategoryAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        'product_specification' => 'array',
        'color' => 'array',
        'specification' => 'array'
    ];
    protected $guarded = [];
    
    protected $appends = ['photo_path','plain_description','rating_avg'];

   

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function sub_categories()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }
    public function child_categories()
    {
        return $this->belongsTo(ChildCategory::class, 'childcategory_id', 'id');
    }
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'product_id', 'id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function avgReviewRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'product_id', 'id');
    }
    
    
    public function getPhotoPathAttribute()
    {
        return asset($this->photo);
    }
    
     public function getRatingAvgAttribute()
    {
        return $this->ratings()->avg('rating');
    }
    
     public function getPlainDescriptionAttribute()
    {
        return strip_tags($this->details);
    }

    public function attributeOptions()
    {
        return $this->hasMany(ProductCategoryAttribute::class);
    }
    
     public static function boot() {

        parent::boot();

        self::creating(function ($model) {
    
            $model->code = random_int(100000, 999999);
    
        });
        
       
     }

    
}
