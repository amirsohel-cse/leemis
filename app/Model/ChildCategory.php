<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $fillable = ['sub_category_id','name','slug','status'];




    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }
}
