<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use function PHPUnit\Framework\isNull;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    protected  $product_id;
    protected $fillable = [
      "id" ,    "name_ar",    "name_en" ,    "slug" ,    "description_ar",    "description_en" ,    "about_brand_ar" ,    "about_brand_en",    "brand_name" ,    "seller_name" ,    "discount_percentage" ,
        "regular_price" ,    "sale_price" ,    "alt" ,    "in_sale" , 'is_clothes',   "sort" ,
           "is_recommended" ,    "has_options",    "is_best",    "end_sale" ,    "start_sale",
              "is_brand" ,    "is_clothes" ,    "ratings" ,    "quantity",
           "created_at" ,    "updated_at",    "deleted_at",    "likes_count" ,    "img",'day_order','is_order','barcode',
           'fina_actual_regular_price','fina_actual_sale_price','indoor','outdoor','unique'
    ];

    protected $appends = ['img_src','final_regular_price','final_sale_price','has_paid_variant','has_variant'];

    protected $casts = [
        'is_recommended' => 'boolean',
        'is_best' => 'boolean',
        'is_clothes' => 'boolean',
        'in_sale' => 'boolean',
        'has_options' => 'boolean',

    ];

    // Always include productColors when fetching a product
    protected $with = ['productColors'];



      ////////////////// relationship /////////////////////
     ///                                              ////
    /////////////////////////////////////////////////////


    public function getHasPaidVariantAttribute()
    {

        return $this->variants()->whereNotNull('price')->where('price', '>', 0)->exists();
    }

    public function getQuantityAttribute()
    {

        if ($this->variants()->exists()){
            return (int)$this->variants()->sum('quantity');
        }

        //dd($this->quantity);
        return (int)$this->getRawOriginal('quantity');
    }


    public function getHasVariantAttribute()
    {

        return $this->variants()->exists();
    }
    public function getFinalRegularPriceAttribute()
    {
        if ($this->has_paid_variant) {
            $minPrice = $this->variants()
                ->whereNotNull('price')
                ->where('price', '>', 0)
                ->orderBy('id','asc') // optional: or any other logic like created_at, etc.
                ->first();
            if ($minPrice->price){

                return get_price_helper2($minPrice->price, true);
            }else{
                return get_price_helper2($this->regular_price,true);
            }
        }
        return get_price_helper2($this->regular_price,true);
    }



    public function getFinalSalePriceAttribute()
    {
        if ($this->has_paid_variant) {

            $variant = $this->variants()->orderBy('id','asc')->first();

            if ($variant && $variant->discount_price !== null) {
                return get_price_helper2($variant->discount_price, true);
            }


        }

        return get_price_helper2($this->sale_price,true);
    }

    public function getInSaleAttribute()
    {
        // If the product has variants, check if any of them have a discount
        if ($this->has_paid_variant) {
            $variant = $this->variants()->orderBy('id','asc')->first();
            if ($variant && $variant->discount_price !== null) {
                return true;
            }
        }else{
            if ($this->final_sale_price > 0){
                return true;
            }else{
                return false;
            }
        }

        // Otherwise, fall back to checking the product's own discount

        return false;
    }

    public function getNameAttribute()
          {
              return app()->getLocale()=='ar'? $this->name_ar : $this->name_en;
          }
    public function images(){

        return $this->hasMany(Image::class);
    }
    public function getIfSaleAttribute()
      {
          $now=strToTime(date('d-m-Y'));
         if($this->in_sale ==1 && date(strToTime($this->start_sale)) <= $now && date(strToTime($this->end_sale) )> $now ){
          return true;
        }
          elseif($this->in_sale ==1 && date(strToTime($this->start_sale)) <= $now && date(strToTime($this->end_sale) )== null){
          return true;
          }
         else{
          return false;

         }
      }
//    public function scopeIfSale($query)
//    {
//        $now = Carbon::now()->format('Y-m-d');
//
//        return $query->where('in_sale', 1)
//            ->where('start_sale', '<=', $now)
//            ->where(function ($q) use ($now) {
//                $q->whereNull('end_sale')
//                    ->orWhere('end_sale', '>', $now);
//            });
//    }
    public function statements(){

        return $this->hasMany(Statement::class);
    }

    public function kurly(){

        return $this->hasMany(Kurly::class);
    }

    public function attributes(){
          return $this->belongsToMany(Attribute::class , 'product_attribute');
    }
     public function product_sizes()
    {
        return $this->hasMany('App\Models\ProdSize', 'product_id', 'id');
    }
     public function product_colors()
    {
        return $this->hasMany('App\Models\ProdColor', 'product_id', 'id');
    }
    public function attributesClothes(){
      // dd($this);
          return $this->hasMany(ProdSize::class)->with('size');
        }
    public function students(){

        return $this->belongsToMany(Student::class , 'product_student');
    }

    public function brand(){

        return $this->belongsToMany(Student::class , 'product_student');

    }

    public function optionsValue(){

        return $this->hasMany(OptionValue::class);
    }

    public function options(){

        return $this->hasMany(OptionValue::class);
    }



    public function categories()
    {
        return $this->belongsToMany(Category::class , 'product_category');
    }

    public function subCategories()
    {
        return $this->belongsToMany(Category::class , 'product_category')->where('parent_id', '!=',0);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function orders(){

        return $this->belongsToMany(Order::class);
    }

    public function productOrder(){

        return $this->belongsToMany(ProductOrder::class,'product_order','product_id');
    }



    public function likes(){

        return $this->hasMany(Like::class);
    }



    /////////////////// custom function //////////////////
    ///                                              ////
    ////////////////////////////////////////////////////

    public function getImgSrcAttribute(){

        return asset("assets/images/products/");
    }




    public function scopeInSale($q)
    {
        if($this->end_sale == null ){
       return $q->where('start_sale', '<=', Carbon::now()->format('Y-m-d'));

        }
        return $q->where('end_sale', '>=', Carbon::now()->format('Y-m-d'))->where('start_sale', '<=', Carbon::now()->format('Y-m-d'));
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

    /*public function getInSaleAttribute($value){

        if (is_null($this->end_sale) && $value === 1) {

            return true;
        }

        if ($this->end_sale >=  Carbon::now()->format('Y-m-d') && $value === 1) {

            return true;
        }

        return  false;

    }*/

    public function scopeInStock($q)
    {
        return $q->where('quantity', '>', 0);
    }

    public function scopeCustomSelect($q , $otherColumns = []){

        /*$columns = ['id', 'name_ar' , 'name_en' , 'img' , 'regular_price', 'sale_price','quantity', 'discount_percentage', 'in_sale', 'end_sale' ,'is_order','day_order', 'created_at'];

        return $q->with('brand')->select( array_merge($columns , $otherColumns));*/

        $columns = [
            'products.id', 'products.name_ar', 'products.name_en', 'products.img',
            'products.regular_price', 'products.sale_price', 'products.quantity',
            'products.discount_percentage', 'products.in_sale', 'products.end_sale',
            'products.is_order', 'products.day_order','products.indoor',
            'products.outdoor','products.unique', 'products.created_at'
        ];

        return $q->with('brand')->select(array_merge($columns, $otherColumns));
    }

    /*public function scopeAOV($q , $product_id){
        $this->product_id = $product_id;

        return $q->with('attributes' , function($q){

            return $q->select('attributes.id' , 'name_ar' , 'name_en') // select columns  attributes

                ->with('options' , function($q){

                    return $q->select('options.id' , 'name_ar' , 'name_en' , 'attribute_id')

                        ->whereHas('values', function ($q){

                            return $q->where('product_id' , $this->product_id);

                        })->with('values' , function ($q){
                            $q->where('product_id' , $this->product_id);
                            $q->select('id', 'quantity' , 'sale_price' , 'regular_price' , 'option_id' , 'product_id' , 'option_id','parent_id');

                }); // end  RS options_values

            });  // end  RS options

        }); // end  RS Attribute
    }*/

    public function productColors()
    {
        return $this->hasMany(ProductColor::class);

    }


    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }


    // In your Product model
    public function getVariantAttributes()
    {
        $variantAttributes = collect();
        $variants = $this->variants ?? collect();

        // 1) Build attribute -> options skeleton
        foreach ($variants as $variant) {
            $combination = is_string($variant->combination) ? json_decode($variant->combination, true) : $variant->combination;

            foreach ($combination as $item) {
                $attrId  = $item['attr_id'];
                $attrName = $item['attr'];
                $optId   = $item['opt_id'];
                $optName = $item['opt'];

                if (!$variantAttributes->has($attrId)) {
                    $variantAttributes->put($attrId, [
                        'id' => $attrId,
                        'name' => $attrName,
                        'options' => collect(),
                    ]);
                }

                $options = $variantAttributes->get($attrId)['options'];

                // Add option if not exists
                if (!$options->contains(fn($o) => $o['id'] === $optId)) {
                    $options->push([
                        'id' => $optId,
                        'name' => $optName,
                        'combinations' => [], // will be filled below
                    ]);
                    // Save back options
                    $attrItem = $variantAttributes->get($attrId);
                    $attrItem['options'] = $options;
                    $variantAttributes->put($attrId, $attrItem);
                }
        }
        }

        // 2) Fill combinations quantities safely
        foreach ($variants as $variant) {
            $quantity = $variant->quantity ?? 0;
            $combination = is_string($variant->combination) ? json_decode($variant->combination, true) : $variant->combination;

            // For each option in this variant, add the other attrs' option qty into its combinations
            foreach ($combination as $item) {
                $attrId = $item['attr_id'];
                $optId  = $item['opt_id'];

                // Get options collection for this attribute
                $attrItem = $variantAttributes->get($attrId);
                if (!$attrItem) {
                    continue; // defensive
                }
                $options = $attrItem['options'];

                // Find option index
                $optionIndex = $options->search(fn($o) => $o['id'] === $optId);
            if ($optionIndex === false) {
                continue;
            }

            // Get the option array, modify, then put back
            $option = $options->get($optionIndex);
            if (!isset($option['combinations']) || !is_array($option['combinations'])) {
                $option['combinations'] = [];
            }

            if (count($combination) > 1) {
                // multi-attribute: record other attributes' option quantities
                foreach ($combination as $other) {
                    $otherAttrId = $other['attr_id'];
                    $otherOptId  = $other['opt_id'];

                    if ($otherAttrId == $attrId) {
                        continue;
                    }

                    if (!isset($option['combinations'][$otherAttrId])) {
                        $option['combinations'][$otherAttrId] = [];
                    }

                    // accumulate quantity if multiple variants map to same pair
                    $option['combinations'][$otherAttrId][$otherOptId] =
                        ($option['combinations'][$otherAttrId][$otherOptId] ?? 0) + $quantity;
                }
            } else {
                // single-attribute: store self-quantities under own attr id
                if (!isset($option['combinations'][$attrId])) {
                    $option['combinations'][$attrId] = [];
                }
                $option['combinations'][$attrId][$optId] =
                    ($option['combinations'][$attrId][$optId] ?? 0) + $quantity;
            }

            // put updated option back into options collection
            $options->put($optionIndex, $option);

            // save options back to attribute (use put on top-level collection)
            $attrItem['options'] = $options;
            $variantAttributes->put($attrId, $attrItem);
        }
        }

        // Optional: sort options by name and reindex outer collection to numeric values if you prefer
        $variantAttributes = $variantAttributes->map(function ($attr) {
            $attr['options'] = $attr['options']->sortBy('name')->values();
            return $attr;
        })->values();

        return $variantAttributes;
    }





    public function checkQuantity()

    {
        if (count($this->variants)>0) {
            return $this->variants->max('quantity');
        }


        return $this->quantity;
    }

}
