<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];

    public function users(){

        return $this->belongsToMany(User::class, 'coupon_user');
    }

    public function authActive(){

        return $this->belongsToMany(User::class, 'coupon_user')
            ->where('user_id' , auth()->id());
    }
}
