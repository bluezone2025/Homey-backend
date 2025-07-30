<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Coupon;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{



    public function checkCoupon(){


        $coupon = Coupon::where('code' , \request('coupon_code'))->first();

        if ($coupon) {

          

            return  response([

                'status'  => Response_Success,
                'data' =>  $coupon,
            ]);

        }


        return  response([
            'status'  => Response_Fail,
            'message' =>  'coupon not found',
        ]);


    }


}
