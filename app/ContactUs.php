<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class ContactUs extends Model
{

    protected $table = 'contact_messages';

    protected $fillable=[
      'name' , 'email' , 'phone' , 'subject' , 'body'
    ];
}
