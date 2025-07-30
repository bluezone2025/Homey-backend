<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $guarded = [];
    public function  getImgFullPathAttribute()
    {
        return asset('storage\\'.$this->logo) ;
    }
    public function product_brands()
    {
        return $this->hasMany('App\Models\ProductBrand', 'brand_id', 'id');
    }
    public function products(){
        return $this->hasMany('App\Product' , 'brand_id' , 'id');
    }
}
