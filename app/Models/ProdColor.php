<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdColor extends Model
{
    protected $table = 'prod_colors';
    protected $fillable = [
      'product_id' ,'size_id' , 'color_id' , 'quantity' ,
    ];
    protected $guarded=[];

    public function color(){
        return $this->belongsTo('App\Models\Option' , 'color_id' , 'id');
    }
    

}
