<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = ['_token'];
    public function getNameAttribute()
          {
              return app()->getLocale()=='ar'? $this->name_ar : $this->name_en;
          }
    public function areas(){

        return $this->hasMany(Area::class);
    }
    public function currency(){
          return $this->belongsTo(Currency::class , 'currency_id' , 'id');
      }

    protected $appends = ['src'];

    public function getSrcAttribute(){

        return asset('assets/images/flags');
    }
}
