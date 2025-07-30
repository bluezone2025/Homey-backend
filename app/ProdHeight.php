<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdHeight extends Model
{
    protected $table = 'prod_heights';
    protected $fillable = [
      'product_id' ,'size_id' , 'height_id' , 'quantity' ,
    ];
    protected $guarded=[];

    public function height(){
        return $this->belongsTo('App\Height' , 'height_id' , 'id');
    }
    
}
