<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'color', 'image'];

    protected $appends = ['img_src'];

    public function getImgSrcAttribute()
    {
        return $this->image ? asset("assets/images/products/min/" . $this->image) : null;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
