<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'pages';

    protected $fillable = [
        'page_title_ar' , 'page_title_en' , 'page_details_ar' , 'page_details_en','image','video'
    ];
}
