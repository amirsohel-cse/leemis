<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;


class Rating extends Model
{
    protected $appends = ['user_info'];
     public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function getUserInfoAttribute()
    {
        return User::find($this->user_id);
    }
    
    
}
