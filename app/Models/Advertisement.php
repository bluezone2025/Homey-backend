<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function reference()
    {
        switch ($this->advertisement_type) {
            case 'category_id':
                return $this->belongsTo(Category::class, 'reference_id');
            case 'product_id':
                return $this->belongsTo(Product::class, 'reference_id');
            case 'student_id':
                return $this->belongsTo(Student::class, 'reference_id');
            case 'brand_id':
                return $this->belongsTo(Student::class, 'reference_id');
            default:
                return null;
        }
    }
}
