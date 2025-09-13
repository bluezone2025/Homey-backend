<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['imaget','imaget2','producttitles','total_price2','products_count2'];

    public function products(){

        return $this->belongsToMany(Product::class , 'product_order')
            ->select(['products.id','name_ar' , 'name_en', 'slug','in_sale',
                'description_ar', 'description_en' , 'is_recommended', 'is_best' ,'barcode','brand_name',
                'in_sale', 'end_sale', 'ratings', 'likes_count', 'img','is_clothes','start_sale'])
            ->withPivot(['id','product_name' ,'regular_price','sale_price','end_price', 'quantity', 'attributes','color_id'])
            ->withTrashed();
    }





    public function products2(){

        if (auth()->guard('student')->check()){

            return $this->belongsToMany(Product::class , 'product_order')->where('student_id',auth()->guard('student')->id())
                ->select(['products.id','name_ar' , 'name_en', 'slug','in_sale',
                    'description_ar', 'description_en' , 'is_recommended', 'is_best' ,'barcode',
                    'in_sale', 'end_sale', 'ratings', 'likes_count', 'img','is_clothes','start_sale'])
                ->withPivot(['product_name' ,'regular_price','sale_price','end_price', 'quantity', 'attributes'])->withTrashed();
        }else{

            return $this->belongsToMany(Product::class , 'product_order')
                ->select(['products.id','name_ar' , 'name_en', 'slug','in_sale',
                    'description_ar', 'description_en' , 'is_recommended', 'is_best' ,'barcode',
                    'in_sale', 'end_sale', 'ratings', 'likes_count', 'img','is_clothes','start_sale'])
                ->withPivot(['product_name' ,'regular_price','sale_price','end_price', 'quantity', 'attributes'])->withTrashed();
        }
    }

    public function areStudentIdsEqual()
    {
        // Retrieve all student_id values from the pivot table for the current order
        $studentIds = $this->products->pluck('pivot.student_id')->unique();

        // Check if there is only one unique student_id value
        return $studentIds->count() === 1;
    }

    public function studentIds()
    {
        // Retrieve all student_id values from the pivot table for the current order
        $studentIds = $this->productItems()->pluck('student_id')->unique()->toArray();

        // Check if there is only one unique student_id value
        return $studentIds;
    }


    public function getDataAttribute()
    {
        return $this->pivot->attributes . ' Testing';
    }

    public function productItems(){

        return $this->hasMany(ProductOrder::class,'order_id');
    }

    public function getImagetAttribute()
    {
        $product_images='<div class="row">';
        foreach($this->products as $product){
            $product_images.="<div class='col-md-6'> <img class='img-item-one' src='".asset('assets/images/products/min/'.$product->img)."' ></div>";
        }
        $product_images.='</div>';
        return $product_images;
    }

    public function getImaget2Attribute()
    {
        if (auth('student')->check()){

            $product_images='<div class="row">';
            foreach($this->productItems()->where('student_id',auth()->guard('student')->id())->distinct()->get()->unique('product_id') as $product){
                $product_images.="<div class='col-md-6'> <img class='img-item-one' src='".asset('assets/images/products/min/'.@$product->product->img)."' ></div>";
            }
            $product_images.='</div>';
            return $product_images;

        }else{
            return null;

        }


    }

    public function getProducttitlesAttribute()
    {
        $product_images="";
        $counter = count($this->products);
        $i = 1;
        foreach($this->products as $product){
            if ($counter == $i)
                $product_images.= $product->name_ar  ;
            else
                $product_images.= $product->name_ar . "," ;

        }
        return $product_images;
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function brand(){

        return $this->belongsTo(Student::class,'brand_id');
    }

    public function shipping_address(){

        return $this->belongsTo(ShippingAddress::class , 'shipping_address_id' , 'id')->with('area');
    }

    public function getTotalPrice2Attribute(){
        if (auth()->guard('student')->check()){
            return $this->productItems()->where('student_id',auth()->guard('student')->id())->sum('end_price');
        }
        return 0;
    }

    //products_count2

    public function getProductsCount2Attribute(){
        if (auth()->guard('student')->check()){
            return $this->productItems()->where('student_id',auth()->guard('student')->id())->count();
        }
        return 0;
    }

}
