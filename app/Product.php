<?php

namespace App;

use App\Models\Brand;
use App\Models\ProductBrand;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    protected $fillable = [
        'title_en'  , 'title_ar','brand_name_ar','brand_name_en' , 'description_en','description_ar',
        'appearance','best_selling','featured','new','price','delivery_period','img','height_img',
        'basic_category_id','category_id','size_guide_id','has_offer','before_price','has_reception',
        'brand_id'



    ];
    protected $guarded=[];

    protected $appends = ['quantity_attribute'];
    public function getQuantityAttributeAttribute()
    {

        return $this->getQuantityAttribute();

    }
    public function brands()
    {
            return $this->belongsToMany(Brand::class , 'product_brands');
    }
    public function brand(){
        return $this->belongsTo('App\Models\Brand' , 'brand_id' , 'id');
    }

    public function category(){
        return $this->belongsTo('App\Category' , 'category_id' , 'id');
    }


    public function basic_category(){
        return $this->belongsTo('App\BasicCategory' , 'basic_category_id' , 'id');
    }
    public function size_guide(){
        return $this->belongsTo('App\SizeGuide' , 'size_guide_id' , 'id');
    }


    public function images(){
        return $this->hasMany('App\ProdImg' , 'product_id' , 'id');
    }

    public function product_hights(){
        return $this->hasMany('App\ProdHeight' , 'product_id'  , 'id');
    }
    public function order_items(){
        return $this->hasMany('App\OrderItem' , 'product_id'  , 'id');
    }
    public function getTotalPrice(){
        $sum=0;
        foreach ($this->order_items as $order){
            $sum+=$order->quantity*$this->price;
        }
        return $sum;
    }
    public function getTotalQuantity(){
        $sum=0;
        foreach ($this->order_items as $order){
            $sum+=$order->quantity;
        }
        return $sum;
    }
    public function getQuantityAttribute(){

        return $this->product_hights->sum('quantity');
    }
    public function product_sizes(){
        return $this->hasMany('App\ProdSize' , 'product_id'  , 'id');
    }
     public function sizes(){
             return $this->belongsToMany('App\Size', 'prod_sizes')->withPivot('id');

    }


    public function getPrice($price){
        $currencies = Currency::all();
        foreach ($currencies as $currency){
            if ($this->country()->currency_id == $currency->id){
                $price= $price*$currency->rate;
            }
        }
        return $price;
    }
      public function likes(){

        return $this->hasMany('App\WishList', 'product_id' , 'id');
    }
      /////////////////// custom function //////////////////
    ///                                              ////
    ////////////////////////////////////////////////////

    public function getImgSrcAttribute(){

        return asset("assets/images/products/");
    }
    public function getInSaleColAttribute(){

      if (is_null($this->end_sale) ) {

          return 'active';
      }

      if ($this->end_sale >=  Carbon::now()->format('Y-m-d')) {

          return 'unactive';
      }

      return  'unactive';
    }

    public function getInSaleAttribute($value){

        if (is_null($this->end_sale) && $value === 1) {

            return true;
        }

        if ($this->end_sale >=  Carbon::now()->format('Y-m-d') && $value === 1) {

            return true;
        }

        return  false;

    }

    public function scopeInStock($q)
    {
        return $q->where('quantity', '>', 0);
    }


}
