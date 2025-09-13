<?php

namespace App\Models;

use App\Notifications\Student\Auth\ResetPassword;
use App\Notifications\Student\Auth\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Student extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;

    protected $appends = ['img_src' ,'name', 'end_points','total_paid_orders','total_products','trendat_percentage_calc','student_percentage_calc','url','total_orders'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_ar','name_en','row_no', 'email', 'password', 'phone', 'university', 'img', 'limit_products' , 'date', 'major', 'cover', 'university_id', 'facebook', 'instagram', 'linkedin', 'twitter',
        'trendat_percentage',
        'student_percentage',
        'gender',
        'discount','discount_date',
        'discount_percentage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

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

    public function products(){

        return $this->belongsToMany(Product::class , 'product_student');
    }

    public function getUrlAttribute(){


        return asset('/') . 'blogs/?id=' . $this->id;

    }

    public function getTotalPaidOrdersAttribute(){


        $ordersIds = ProductOrder::where('student_id', $this->id)
            ->distinct('order_id')
            ->pluck('order_id')
            ->toArray();

        // Retrieve order IDs for the current month

        $orders_total_ids = Order::where(function ($query) use ($ordersIds) {
            $query->whereIn('id', $ordersIds)  // Orders associated with the student
            ->wherein('payment_method', ['knet', 'tabby', 'wallet'])  // Specific payment methods
            ->where('status', '!=', 'pending');  // Non-pending status
        })
            ->orWhere(function ($query) use ($ordersIds) {
                $query->where('payment_method', 'cash')  // Cash payments
                ->whereIn('id', $ordersIds);

            })
            ->pluck('id')->toArray();

// Calculate the total price for the current month
        $orders = \DB::table('product_order')
            ->where('student_id', $this->id)
            ->whereIn('order_id', $orders_total_ids)  // Filter by order_id list
            ->selectRaw('SUM(end_price) as total_price')  // Calculate total price
            ->value('total_price');  // Get the sum value


        /*$orders = Order::where('brand_id',$this->id)->where('payment_method','cash')
            ->where('status','!=','reject')
            ->orWhere(function ($qb){
                $qb->where('brand_id',$this->id);
                $qb->where('payment_method','knet')->where('status','!=','pending');
            })
            ->sum('order_price');*/




        //return 0;
        return number_format($orders,2);
    }

    public function getTotalOrdersAttribute(){



        $ordersIds = ProductOrder::where('student_id', $this->id)
            ->distinct('order_id')
            ->pluck('order_id')
            ->toArray();

        // Retrieve order IDs for the current

        $orders_total_ids = Order::where(function ($query) use ($ordersIds) {
            $query->whereIn('id', $ordersIds)  // Orders associated with the student
            ->wherein('payment_method', ['knet', 'tabby', 'wallet'])  // Specific payment methods
            ->where('status', '!=', 'pending');  // Non-pending status
        })
            ->orWhere(function ($query) use ($ordersIds) {
                $query->where('payment_method', 'cash')  // Cash payments
                ->whereIn('id', $ordersIds);

            })
            ->pluck('id')->toArray();


        /*$orders = Order::where('brand_id',$this->id)->where('payment_method','cash')
            ->where('status','!=','reject')
            ->orWhere(function ($qb){
                $qb->where('brand_id',$this->id);
                $qb->where('payment_method','knet')->where('status','!=','pending');
            })
            ->count();*/




        //return 0;
        return count($orders_total_ids);
    }

    public function getTotalProductsAttribute(){


        /*return ProductOrder::where('student_id',$this->id)
            ->with('order',function($q){
                $q->where('payment_method','knet')->where('status','!=','pending');
                $q->orwhere(function ($qb){
                    //$qb->where('student_id',$this->id);
                    $qb->where('payment_method','cash')->where('status','!=','reject');
                });
            })->get()->sum(function ($productOrder) {
                return $productOrder->quantity;
            });*/


        $ordersIds = ProductOrder::where('student_id', $this->id)
            ->distinct('order_id')
            ->pluck('order_id')
            ->toArray();

        // Retrieve order IDs for the current month

        $orders_total_ids = Order::where(function ($query) use ($ordersIds) {
            $query->whereIn('id', $ordersIds)  // Orders associated with the student
            ->wherein('payment_method', ['knet', 'tabby', 'wallet'])  // Specific payment methods
            ->where('status', '!=', 'pending');  // Non-pending status
        })
            ->orWhere(function ($query) use ($ordersIds) {
                $query->where('payment_method', 'cash')  // Cash payments
                ->whereIn('id', $ordersIds);

            })
            ->pluck('id')->toArray();

// Calculate the total price for the current month
        $orders = \DB::table('product_order')
            ->where('student_id', $this->id)
            ->whereIn('order_id', $orders_total_ids)  // Filter by order_id list
            ->count();  // Get the sum value


        /*$orders = Order::where('brand_id',$this->id)
            ->where('payment_method','cash')
            ->where('status','!=','reject')
            ->orWhere(function ($qb){
                $qb->where('brand_id',$this->id);
                $qb->where('payment_method','knet')->where('status','!=','pending');
            })->sum('products_count');*/

        return $orders;

    }



    public function getTrendatPercentageCalcAttribute(){

        $ordersIds = ProductOrder::where('student_id', $this->id)
            ->distinct('order_id')
            ->pluck('order_id')
            ->toArray();

        // Retrieve order IDs for the current month

        $orders_total_ids = Order::where(function ($query) use ($ordersIds) {
            $query->whereIn('id', $ordersIds)  // Orders associated with the student
            ->wherein('payment_method', ['knet', 'tabby', 'wallet'])  // Specific payment methods
            ->where('status', '!=', 'pending');  // Non-pending status
        })
            ->orWhere(function ($query) use ($ordersIds) {
                $query->where('payment_method', 'cash')  // Cash payments
                ->whereIn('id', $ordersIds);

            })
            ->pluck('id')->toArray();

// Calculate the total price for the current month
        $orders = \DB::table('product_order')
            ->where('student_id', $this->id)
            ->whereIn('order_id', $orders_total_ids)  // Filter by order_id list
            ->selectRaw('SUM(end_price) as total_price')  // Calculate total price
            ->value('total_price');  // Get the sum value


        /*$orders = Order::where('brand_id',$this->id)->where('payment_method','cash')
            ->where('status','!=','reject')
            ->orWhere(function ($qb){
                $qb->where('brand_id',$this->id);
                $qb->where('payment_method','knet')->where('status','!=','pending');
            })
            ->sum('order_price');*/


        return number_format($orders * ($this->trendat_percentage / 100),2);
    }

    public function getStudentPercentageCalcAttribute(){

        $ordersIds = ProductOrder::where('student_id', $this->id)
            ->distinct('order_id')
            ->pluck('order_id')
            ->toArray();

        // Retrieve order IDs for the current month

        $orders_total_ids = Order::where(function ($query) use ($ordersIds) {
            $query->whereIn('id', $ordersIds)  // Orders associated with the student
            ->wherein('payment_method', ['knet', 'tabby', 'wallet'])  // Specific payment methods
            ->where('status', '!=', 'pending');  // Non-pending status
        })
            ->orWhere(function ($query) use ($ordersIds) {
                $query->where('payment_method', 'cash')  // Cash payments
                ->whereIn('id', $ordersIds);

            })
            ->pluck('id')->toArray();

// Calculate the total price for the current month
        $orders = \DB::table('product_order')
            ->where('student_id', $this->id)
            ->whereIn('order_id', $orders_total_ids)  // Filter by order_id list
            ->selectRaw('SUM(end_price) as total_price')  // Calculate total price
            ->value('total_price');  // Get the sum value


        /*$orders = Order::where('brand_id',$this->id)->where('payment_method','cash')
            ->where('status','!=','reject')
            ->orWhere(function ($qb){
                $qb->where('brand_id',$this->id);
                $qb->where('payment_method','knet')->where('status','!=','pending');
            })
            ->sum('order_price');*/

        return number_format($orders * ($this->student_percentage / 100),2);
    }




    /////////////// custom function /////////////////////
    ///                                              ////
    ////////////////////////////////////////////////////

    public function getImgSrcAttribute(){

        return asset("assets/images/student/");
    }

    public function getEndPointsAttribute(){

        if (Cache::has('points_end')){

            $points_end = Cache::get('points_end');

        } else {

            $points_end =  Setting::where('name' , 'points_end')->first()->value;

            Cache::put('points_end', $points_end);
        }


        return floor($this->points/$points_end);
    }

    public function getNameAttribute()
    {
        return app()->getLocale()=='ar'? $this->name_ar : $this->name_en;
    }

}
