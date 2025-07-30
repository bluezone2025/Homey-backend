<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    protected $table='wish_list';
    protected $guarded=[];

    public function product(){
        return $this->belongsTo('App\Product' , 'product_id' , 'id');
    }
}
