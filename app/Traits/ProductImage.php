<?php

namespace App\Traits;

use Illuminate\Support\Str;


trait ProductImage{
    
    public function productImageUpload($query)
    {
        $imagName = Str::random(20);
        $ext = strtolower($query->getClientOriginalExtension());
        $imageFullName = $imagName.'.'.$ext;
        $uploadPath = 'uploads/product-images/';
        $imageUrl = $uploadPath.$imageFullName;
        $success = $query->move($uploadPath, $imageFullName);
        return $imageUrl;
    }
}