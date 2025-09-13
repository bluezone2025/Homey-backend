<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoxOrder extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $appends = ['imaget','user_name','user_address'];

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function getUserNameAttribute(){
        if ($this->shipping_address){
            return $this->shipping_address->name;
        }

        return $this->user->name??" ";
    }

    public function getUserAddressAttribute(){
        if ($this->shipping_address){
            return $this->shipping_address->phone;
        }

        return $this->user->phone ?? "";
    }

    public function box(){

        return $this->belongsTo(Box::class)->withTrashed();
    }

    public function shipping_address(){

        return $this->belongsTo(ShippingAddress::class , 'shipping_address_id')->with('area');
    }

    public function getImagetAttribute()
    {
        if ($this->box){
            $product_images='<div class="row">';
            $product_images.="<div class='col-md-6'> <img class='img-item-one' src='".asset('assets/images/boxes/min/'.$this->box->default_image)."' ></div>";
            $product_images.='</div>';
            return $product_images;
        }else{
            return "";
        }


    }

    public function getAdminStatusAttribute(){
        $status = $this->attributes['admin_status'];
        return __("aliases.box_status.$status");
    }
}
