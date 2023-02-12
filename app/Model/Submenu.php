<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $table = "submenus";
    protected $fillable=['menu','sub_menu','sub_menu_details','sub_status'];
  
}
