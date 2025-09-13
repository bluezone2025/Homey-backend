<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = [];


    public function country(){

        return $this->belongsTo(Country::class);
    }

    public function student_area(){

        return $this->hasOne(cities_student::class,'city_id','id');
    }
    public function getNameAttribute()
          {
              return app()->getLocale()=='ar'? $this->name_ar : $this->name_en;
          }
}
