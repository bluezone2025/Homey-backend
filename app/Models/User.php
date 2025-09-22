<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */


    protected $fillable = [
        'name',
        'email',
        'phone',
        'img',
        'gender',
        'birth_day',
        'surname',
        'is_admin',
        'country_id',
        'password',
        'fcm_token',
        'activation_code',
        'email_verified_at',
        'google_id',
        'apple_id',
        'avatar' ,
        'device_id',
        'public_key',
        'is_professional'

    ];

    protected $appends =['total_wallet','total_orders','count_orders'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'public_key'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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


     ////////////////// relationship /////////////////////
    ///                                              ////
   /////////////////////////////////////////////////////

   public function wishlist()
  {
      return $this->belongsToMany(Product::class, 'wish_list', 'user_id', 'product_id')->withTimestamps();
  }

  public function country()
  {
        return $this->belongsTo(Country::class , 'country_id' , 'id');
  }

  public function wishlistsHas($itemId){


      return self::wishlist()->where('product_id',$itemId)->exists();


      }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function texts_search()
    {
        return $this->hasMany(UserSearch::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function boxOrders()
    {
        return $this->hasMany(BoxOrder::class);
    }

    public function shipping_addresses(){

        return $this->hasMany(ShippingAddress::class);
    }

    public function likes(){

        return $this->hasMany(Like::class)->select('id' , 'product_id' , 'user_id');
    }

    public function wallets(){
        return $this->hasMany(Wallet::class);
    }

    public function getTotalWalletAttribute(){

        $userWithWallets = User::where('id', $this->id) // Filter to get only user with ID 1
        ->whereHas('wallets') // Ensure user has wallets
        ->with(['wallets' => function ($query) {
            $query->select('user_id',
                \DB::raw("SUM(CASE WHEN wallet_type = 'deposit' THEN amount ELSE 0 END) as total_deposit"),
                \DB::raw("SUM(CASE WHEN wallet_type = 'withdraw' THEN amount ELSE 0 END) as total_withdraw"))
                ->groupBy('user_id');
        }])
            ->first(); // Retrieve the single result for user 1

        if ($userWithWallets){

            $totalDeposit = $userWithWallets->wallets->first()->total_deposit ?? 0;
            $totalWithdraw = $userWithWallets->wallets->first()->total_withdraw ?? 0;
        }else{

            $totalDeposit = 0;
            $totalWithdraw = 0;
        }


        return $totalDeposit - $totalWithdraw;
    }

    public function getTotalOrdersAttribute(){

        $online = Order::where('user_id',$this->id)->wherein('payment_method',['knet','tabby','wallet'])->wherein('status',["accept","done","shipping"])->sum('total_price');
        $cash = Order::where('user_id',$this->id)->where('payment_method','cash')->wherein("status",["pending","accept","done","shipping"])->sum('total_price');
        $total = $online + $cash;
        $formatted_number = number_format($total, 2);
        return $formatted_number;
    }

    public function getCountOrdersAttribute(){
        $online = Order::where('user_id',$this->id)->wherein('payment_method',['knet','tabby','wallet'])->wherein('status',["accept","done","shipping"])->count();

        $cash = Order::where('user_id',$this->id)->where('payment_method','cash')->wherein("status",["pending","accept","done","shipping"])->count();

        $total = $online + $cash;
        $formatted_number = number_format($total, 2);
        return $formatted_number;
    }
}
