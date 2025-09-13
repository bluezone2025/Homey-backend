<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'combination',
        'price',
        'discount_price',
        'quantity',
    ];

    protected $casts = [
        'combination' => 'array',
    ];

    protected $appends = ['in_sale','final_regular_price','final_discount_price'];

    public function getInSaleAttribute(){
        if ($this->discount_price && $this->discount_price > 0){
            return 1;
        }
        return 0;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFullCombinationAttribute()
    {
        $combo = $this->combination ?? [];
        $result = [];

        foreach ($combo as $item) {
            $attr = Attribute::find($item['attr_id']);
            $opt = Option::find($item['opt_id']);

            $result[] = [
                'attribute' => $attr ? [
                    'id' => $attr->id,
                    'name_ar' => $attr->name_ar,
                    'name_en' => $attr->name_en,
                    'is_free' => $attr->is_free,
                ] : null,
                'option' => $opt ? [
                    'id' => $opt->id,
                    'value_ar' => $opt->name_ar,
                    'value_en' => $opt->name_en
                ] : null
            ];
        }

        return $result;
    }

     public function getFinalRegularPriceAttribute()
    {
         $minPrice = $this->price;
            return get_price_helper2($minPrice, true);
    }



    public function getFinalDiscountPriceAttribute()
    {

            if ($this->discount_price !== null) {
                return get_price_helper2($this->discount_price, true);
            }

    }

}
