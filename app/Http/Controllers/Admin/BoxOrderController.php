<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\StatusOrderMail;
use App\Models\BoxOrder;
use App\Models\Order;
use App\MyDataTable\MDT_Query;
use Illuminate\Http\Request;
use App\Models\FcmTokenModel;
use App\Models\Notification;

class BoxOrderController extends Controller
{

    use MDT_Query;

    private $lang;

    public function __construct()
    {

        $this->lang = app()->getLocale();

        $this->middleware('haveRole:box_order.index')->only('index');
        $this->middleware('haveRole:box_order.update')->only('update');
        $this->middleware('haveRole:box_order.show')->only('show');
    }

    public function index()
    {
        
        // dd(Order::first()->image);

        return ($this->MDT_Query_method(// Start Query
            BoxOrder::class,
            'admin/pages/box_orders/index',
            false, // Soft Delete
            [
                'with_RS' => ['shipping_address','box','user'],
                'condition' => ['where' , 'payment_method' , '=' , "knet"],
                'condition2' => ['wherein' , 'status' , ["paid"]],
                ],'order'
            )); // end query

        }

        public function index_inpaid(){
            return $this->MDT_Query_method(// Start Query
                BoxOrder::class,
                'admin/pages/box_orders/index_inpaid',
                false, // Soft Delete
                [
                    'with_RS' => ['shipping_address'],
                    'condition' => ['wherenotin' , 'status' , ["paid"]],
                    ]
                ); // end query
        }


    public function update(Request $request, $id)
    {

        $order = BoxOrder::findOrFail($id);

        $order->admin_status = $request->get('status');
        $order->save();

        return response(['status' => 'success' , 'message' =>__('form.response.update order')]);

    }


    public function show($id)
    {
        $order = BoxOrder::with('box')->withTrashed()->findOrFail($id);


        return view('admin.pages.box_orders.show')->with([
            'order' => $order,
            'lang' => $this->lang,
        ]);
    }



    ///////////////////////////////////////////////////////
    ////                                               ////
    //// ..........  Methods Clean Code .............. ////
    ////                                               ////
    ///////////////////////////////////////////////////////


    public function columnsDB($request){


        return [
            'status'         => $request->status,
//            'order_price'    => $request->order_price,
//            'shipping_price' => $request->shipping_price,
//            'total_price'     => $request->total_price,
        ];
    }

}
