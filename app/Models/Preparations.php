<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preparations extends Model
{
    use HasFactory;

    protected $table = 'preparations';
    protected $guarded=[];

    public function category(){
        return $this->belongsTo('App\Category' , 'category_id' , 'id');
    }
    public function basic_category(){
        return $this->belongsTo('App\BasicCategory' , 'basic_category_id' , 'id');
    }
}
