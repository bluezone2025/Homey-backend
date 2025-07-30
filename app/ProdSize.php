<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdSize extends Model
{

    protected $table = 'prod_sizes';
    protected $fillable = [
        'product_id' , 'size_id'
    ];

    public function size(){
        return $this->belongsTo('App\Size' , 'size_id'  , 'id');
    }

    public function heights(){
        return $this->hasMany('App\ProdHeight' , 'size_id'  , 'id');
    }

    public function isAvailable(){

        $heights= ProdHeight::where(['size_id' => $this->size_id , 'product_id' => $this->product_id ])->get();

        $index = 0;
        foreach ($heights as $height){
            if ($height->quantity < 1){
                $index++;
            }
        }

//        return $heights->count() ;

        if($heights->count() > $index){
            return  true;
        } else {
            return false;
        }
    }


    protected $guarded=[];
}
