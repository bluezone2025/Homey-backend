<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use App\Models\UserSearch;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable  implements JWTSubject
{
    use LaratrustUserTrait;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'password_view', 'job_id','phone' ,'device_token', 'country_id','activation_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


      // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function country(){
        return $this->belongsTo('App\Country'  , 'country_id' , 'id');
    }
    public function wishlist(){
        return $this->belongsToMany(Product::class,'wish_list')->withTimestamps();
    }
    public function wishlistsHas($productId){
        return self::wishlist()->where('product_id',$productId)->exists();
    }


     public function texts_search()
    {
        return $this->hasMany(UserSearch::class);
    }

     public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function getTotalPrice(){
       $sum=0;
       foreach ($this->orders as $order){
           $sum+=$order->total_price;
       }
       return $sum;
    }
    public  function getPrice($price){

        $country =$this->country;
        $new_price= $price/$country->currency->rate;
        return $new_price;
    }
}
