<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class , 'country_id' , 'id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class , 'area_id' , 'id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class , 'specialization_id' , 'id');
    }
}
