<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LoginSecurity extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(Admin::class);
    }
}