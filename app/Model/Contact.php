<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = ['contact_title','contact_text','contact_email',
                          'contact_success_text','email','website','street','phone','fax'];
}
