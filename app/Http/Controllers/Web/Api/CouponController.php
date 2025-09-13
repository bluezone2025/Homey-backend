<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{



    public function checkCoupon(){


        $coupon = Coupon::where('code' , \request('coupon_code'))->where('is_active',1)/*->where('brand_id' , \request('brand_id'))*/->first();

        if ($coupon) {

            if ($coupon->end_date < Carbon::now()->format('Y-m-d') || $coupon->is_active === 0):

                return  response([
                    'status'  => Response_Fail,
                    'message' =>  'coupon not found',
                ]);

            endif;

            if ($coupon->min_price > \request('order_price')):


                return  response([
                    'status'  => Response_Fail,
                    'message' =>  'The total price of the order must be at least ' . $coupon->min_price . ' IDR',
                ]);

            endif;

            if ($coupon->use >= $coupon->limit_use):

                return  response([
                    'status'  => Response_Fail,
                    'message' =>  'The number of permitted use of the coupon . has been completed',
                ]);

            endif;


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
