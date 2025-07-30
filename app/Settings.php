<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
protected $guarded=[];
//    protected $fillable = [
//        'logo' , 'facebook' , 'youtube' , 'site_name_ar' , 'site_name_en' , 'email',
//        'site_des_ar' , 'site_des_en' , 'ios_link' ,'android_link' ,'twitter' , 'google_plus',
//        'whatsapp' , 'instagram' , 'telegram' , 'phone'
//    ];
}
