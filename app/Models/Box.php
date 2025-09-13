<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Box extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $fillable = ['title_ar','title_en','description_ar','box_category_id','description_en','default_image','price','quantity','required_order','order_min_price'];
    protected $appends = ['img_src','default_img_src'];
    public function getImgSrcAttribute(){

        return asset("assets/images/boxes");
    }


    public function getDefaultImgSrcAttribute(){

        return asset("assets/images/boxes/min");
    }

    public function galleries (){
        return $this->hasMany(BoxGallery::class,'box_id');
    }

    public function images(){

        return $this->hasMany(BoxGallery::class,'box_id');
    }

    public function boxCategory(){
        return $this->belongsTo(BoxCategory::class)->withTrashed();
    }



}
