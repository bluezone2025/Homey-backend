<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BestSeller extends Model
{
    protected $table = 'best_sellers';


    protected $fillable = [
        'product_id' , 'rate'
    ];


    public function product(){
        return $this->belongsTo('App\Product' , 'product_id' , 'id');
    }
}
