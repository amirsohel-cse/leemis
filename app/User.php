<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $appends = ['photo_path'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'code',
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

    public function getPhotoPathAttribute()
    {
        if($this->image == null){
            return null;
        }
        
        if (file_exists('uploads/users/' . $this->image)) {
            return asset('uploads/users/' . $this->image);
        }
        

        return $this->image;

    }

    public function loginSecurity()
    {
        return $this->hasOne(LoginSecurity::class);
    }

}
