<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use function PHPUnit\Framework\isNull;

class Notification extends Model
{

    protected $fillable = [
      "id" , 'fcm_token',	'user_id','type','type_id',	'title_ar',	'title_en',	'body_ar',	'body_en',	'image'
    ];

    protected $appends = ['img_src','title','body'];
    protected $casts = [
        'fcm_token' => 'array', // Will convarted to (Array)
        'user_id' => 'array', // Will convarted to (Array)
    ];
     public function toArray()
    {
        $data["id"] =$this->id;
        $data['fcm_token']=$this->fcm_token;
        $data['user_id']=$this->user_id;
        $data['type']=$this->type;
        $data['type_id']=$this->type_id;
        $data['title']=$this->title;
        $data['body']=$this->body;
        $data['created_at']=$this->created_at!= null ? $this->created_at->diffForHumans():null;
        $data['image']=$this->img_src;
         if(auth()->user()){
            $data['is_read']=$this->is_read(auth()->user()->id);
         }else{
            $data['is_read']=$this->is_read(\request('fcm_token'));

         }
        return $data;
        
    }
    
   
    // type => Category , Brand, Product,Info
      ////////////////// relationship /////////////////////
     ///                                              ////
    /////////////////////////////////////////////////////



    /////////////////// custom function //////////////////
    ///                                              ////
    ////////////////////////////////////////////////////

    public function getImgSrcAttribute(){
        if($this->image){
            if($this->type == "Product"){
                return asset("assets/images/products/min/".$this->image);
            }
            //return asset("assets/images/notifications/".$this->image);

        }
        return null;
    }
    public function getTitleAttribute(){
       return app()->getLocale() == "en" ? $this->title_en : $this->title_ar;
          
    }
     public function getBodyAttribute(){
          return app()->getLocale() == "en" ? $this->body_en : $this->body_ar;

    }
    
    public function is_read($token_or_id){
         $is_show=ShowNotification::where('notification_id',$this->id)->where('user_id',$token_or_id)->first();
          return $is_show?true:false;

    }
    

}
