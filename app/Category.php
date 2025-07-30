<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';
    protected $fillable = ['name_ar','name_en','basic_category_id'];


    public function basicCategory(){
        return $this->belongsTo('App\BasicCategory' , 'basic_category_id' , 'id');
    }
 public function  getImgFullPathAttribute()
    {
        return asset('storage\\'.$this->image_url) ;
    }


    public function products(){
        return $this->hasMany('App\Product' , 'category_id' , 'id');
    }
}
