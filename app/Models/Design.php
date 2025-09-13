<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Design extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function toArray()
    {
        $data["id"] = $this->id;
        $data["design_name"] = $this->design_name;
        $data["user_name"] = $this->user_name;
        $data["phone"] = $this->phone;
        $data["email"] = $this->email;
        $data["note"] = $this->note;
        $data["status"] = $this->status;
        $data["count_rate"] = $this->count_rate;
        $data["images"] = $this->images;
        $data["img"] = $this->images->first()!= null ? $this->images->first()->src :null;


        return $data;
    }


    public function images(){

        return $this->hasMany(DesignImage::class);
    }
    public function ratings(){

        return $this->hasMany(DesignRating::class);
    }

    public function getCountRateAttribute(){
      return  DB::table('design_ratings')->where('design_id',$this->id)
                  ->where('status',1)->avg('rating');


    }

}
