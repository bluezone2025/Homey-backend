<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['src'];

    public function getSrcAttribute(){

        return asset('assets/images/sliders');
    }

    // Slider.php
    public function brand()
    {
        return $this->belongsTo(Student::class, 'reference_id')
            ->when($this->slider_for === 'brand_id', function($query) {
                return $query;
            });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'reference_id')
            ->when($this->slider_for === 'category_id', function($query) {
                return $query;
            });
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'reference_id')
            ->when($this->slider_for === 'product_id', function($query) {
                return $query;
            });
    }
}
