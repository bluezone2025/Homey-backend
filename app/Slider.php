<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    protected $table = 'sliders';
    public $timestamps = true;
    protected $fillable = array('name_ar', 'name_en', 'description_ar',"description_en",'img','app_img');
    protected $appends = ["img_full_path","app_img_full_path"] ;


    public function  getImgFullPathAttribute()
    {
        return asset("storage"."/".$this->img) ;
    }

    public function  getAppImgFullPathAttribute()
    {
        return asset("storage".'/'.$this->app_img) ;
    }

}