<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Wallet;
use App\MyDataTable\MDT_Method_Action;
use App\MyDataTable\MDT_Query;
use \Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CartItemsController extends Controller
{
    use MDT_Query, MDT_Method_Action;

    public function __construct()
    {
        #$this->middleware('haveRole:wallets.index')->only('index');
        #$this->middleware('haveRole:wallets.create')->only(['create' , 'store']);

    }


    public function index(Request $request)
    {
        $query = CartItem::query();
        if ($search = $request->get('search')) {
            $query->where('username', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->orWhereHas('product', function ($q) use ($search) {
                    $q->where('name_ar', 'like', "%$search%");
                });
        }
        // Group by 'ip_address', 'username', and 'phone', calculate the total price, and get the latest 'updated_at'
        $cart_items = $query->groupBy('ip_address', 'username', 'phone')
            ->selectRaw('ip_address, username, phone, SUM(price * quantity) as total_price, MAX(updated_at) as last_updated_at') // Add MAX(updated_at)
            ->orderBy('last_updated_at', 'desc') // Order by the latest 'updated_at'
            ->get();



        return view('admin.pages.cart-items.index', compact('cart_items'));
    }

    public function show($ip_address,$username,$phone)
    {
        $query = CartItem::query();

        if ($username != "no" and $phone !="no")
        {
            $cart_items = $query->where('ip_address',$ip_address)->where('username',$username)->where('phone',$phone)->orderBy('id', 'desc')->get();
        }else{

            $cart_items = $query->where('ip_address',$ip_address)->where('username',null)->where('phone',null)->orderBy('id', 'desc')->get();

        }

        return view('admin.pages.cart-items.show', compact('cart_items'));
    }


}
