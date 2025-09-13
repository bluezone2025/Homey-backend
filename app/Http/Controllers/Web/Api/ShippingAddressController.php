<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShippingAddressRequest;
use App\Models\Like;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth.guard:web-api');
    }


    public function index()
    {

        $shipping_addresses = auth()->user()
            ->shipping_addresses()
            ->with('area.country')
            ->get();

        return response([
            'status' => count($shipping_addresses) > 0 ? Response_Success : Response_Fail,
            'data' => $shipping_addresses,
        ]);
    }


    public function save(Request $request){

        $validator = \Validator::make($request->all(), (new ShippingAddressRequest())->rules());

        if ($validator->fails()) {

            return response([
                'status' => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }



        $ShippingAddress = ShippingAddress::create(
            array_merge($validator->validated() ,
                ['user_id' => auth()->id()])
        );

        return response([
            'status' => Response_Success,
            'data' => $ShippingAddress,
        ]);

    }

    public function update(Request $request){

        $validator = \Validator::make($request->all(), (new ShippingAddressRequest())->rules());

        if ($validator->fails()) {

            return response([
                'status' => Response_Fail,
                'message' => $validator->errors()->all(),
            ]);
        }


        ShippingAddress::where('id' , $request->shippingAddress_id)
            ->where('user_id'  , auth()->id())
            ->update(array_merge($validator->validated() ,['user_id' => auth()->id()]));



        return response([
            'status' => Response_Success,
        ]);
    }

    public function delete(Request $request){

        $shippingAddress = ShippingAddress::where('id' , $request->shippingAddress_id)
            ->where('user_id'  , auth()->id())
            ->first();

        if ($shippingAddress){
            // get order by shipping address
            $orders = Order::where('shipping_address_id',$request->shippingAddress_id)->count();

            if ($orders > 0){

                return response([
                    'status' => Response_Fail,
                    'message'   => __('api.can_not_delete_it_have_order')
                ]);
            }

            $shippingAddress->delete();
            return response([
                'status' => Response_Success,
            ]);

        }else{

            return response([
                'status' => Response_Fail,
                'message'   => __('api.shipping_address_not_found')
            ]);
        }

    }



}
