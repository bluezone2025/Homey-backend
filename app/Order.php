<?php

namespace App;

use App\Scopes\NotDeletedScope;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new NotDeletedScope);
    }

    protected $fillable = [
      'name' , 'email' , 'phone','owner_phone', 'country_id' ,  'city_id' , 'total_price' , 'total_quantity',
        'user_id' , 'address1' , 'address2' , 'note' ,'cash', 'postal_code' , 'national_id','region','the_plot','the_street', 'the_avenue','building_number' ,'floor','apartment_number',"invoice_link",
        "paid_by","tabby_amount",'data_url','delivered_by','delivery_time_id','is_deleted'
    ];

    public function products(){

        return $this->belongsToMany(Product::class , 'order_items')
            ->withPivot(['quantity','product_height_id','product_size_id']);
    }

    public function order_items(){
        return $this->hasMany('App\OrderItem' ,'order_id' , 'id' )->with(['product','height.height','size.size']);
    }

    public function country(){
        return $this->belongsTo('App\Country'  , 'country_id' , 'id');
    }

    public function city(){
        return $this->belongsTo('App\City'  , 'city_id' , 'id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function DeliveryTime(){
        return $this->belongsTo('App\Models\DeliveryTime'  , 'delivery_time_id' , 'id');
    }


}
