<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpCategory extends Model
{
    protected $guarded = [];


    public function articals()
    {
        return $this->hasMany(Artical::class);
    }
}
