<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $fillable = [
        'code' , 'percentage'];
        public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function discount($total)
    {
        // if ($this->type == 'fixed') {
        //     return $this->value;
        // } else
        // if ($this->type == 'percent') {
            return ($this->percentage / 100) * $total;
        // } else {
        //     return 0;
        // }
    }
}
