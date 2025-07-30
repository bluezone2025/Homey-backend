<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'title_ar' , 'title_en' , 'description_en' , 'description_ar' ,'description_en1' , 'description_ar1' , 'appearance' , 'img1' ,'img2'
    ];



}
