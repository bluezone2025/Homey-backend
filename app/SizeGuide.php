<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SizeGuide extends Model
{
    protected $table = 'size_guides';

    protected $guarded=[];

    public function products(){
        return $this->hasMany('App\Product' , 'size_guide_id' , 'id');
    }
}
