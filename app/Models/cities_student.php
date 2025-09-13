<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cities_student extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = ['_token'];


    public function country(){

        return $this->belongsTo(Country::class);
    }

    public function area(){

        return $this->belongsTo(Area::class,'area_id');
    }
    public function getNameAttribute()
    {
        return app()->getLocale()=='ar'? $this->name_ar : $this->name_en;
    }
}
