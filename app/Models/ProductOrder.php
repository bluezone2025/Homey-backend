<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['data'];
    protected $table = 'product_order';

    protected $casts = [
        'attributes' => 'array',
    ];
    public function product(){

        return $this->belongsTo(Product::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function getDataAttribute(){
        return true;
    }



    public function color(){
        return $this->belongsTo(ProductColor::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

}
