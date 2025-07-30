<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = [
        'name_ar' , 'name_en' , 'code' , 'country_code' , 'currency_id' , 'delivery' ,'image_url', 'country_code_ar'
    ];

    public function currency(){
        return $this->belongsTo('App\Currency' , 'currency_id' , 'id');
    }


    public function cities(){
        return $this->hasMany('App\City' , 'country_id' , 'id');
        //has many!!

    }
}
