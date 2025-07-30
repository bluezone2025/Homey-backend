<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
protected $guarded=[];
//    protected $fillable= [
//      'order_id' , 'product_id' , 'product_height_id' , 'product_size_id' , 'quantity'
//    ];


    protected $fillable= [
      'order_id' , 'product_id' , 'product_height_id' , 'product_size_id' , 'quantity','booking_date'
    ];

    protected $casts = [
        'booking_date' => 'datetime:Y-m-d',
    ];
    public function product(){
        return $this->belongsTo('App\Product' , 'product_id' , 'id');
    }

    public function height(){
        return $this->belongsTo('App\ProdHeight' , 'product_height_id' , 'id');
    }

    public function size(){
        return $this->belongsTo('App\ProdSize' , 'product_size_id' , 'id');
    }


    public function order(){
        return $this->belongsTo('App\Order' , 'order_id' , 'id');
    }

}
