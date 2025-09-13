<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'rating',
        'comment',
        'status',
        'product_id',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

}
