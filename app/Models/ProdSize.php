<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdSize extends Model
{

    protected $table = 'prod_sizes';
    protected $fillable = [
        'product_id' , 'size_id'
    ];

    public function size(){
      // dd('fff');
        return $this->belongsTo(Option::class , 'size_id'  , 'id');
    }

    public function colors(){
        return $this->hasMany('App\Models\ProdColor' , 'size_id'  , 'id')->with('color');
    }

    public function isAvailable(){

        $colors= ProdColor::where(['size_id' => $this->size_id , 'product_id' => $this->product_id ])->get();

        $index = 0;
        foreach ($colors as $color){
            if ($color->quantity < 1){
                $index++;
            }
        }

//        return $colors->count() ;

        if($colors->count() > $index){
            return  true;
        } else {
            return false;
        }
    }


    protected $guarded=[];
}
