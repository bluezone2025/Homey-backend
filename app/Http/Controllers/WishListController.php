<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class WishListController extends Controller
{
    //

    public function index(){
        $items = Auth::guard('web')->user()->wishlist()->latest()->get();
        // dd($items);
    return view('wishlist',compact('items'));

    }
    public function store(Request $request){

        if(!Auth::guard('web')->check()){
            return response()->json(['status'=>'error','message'=>trans('site.Please log in first')]);

        }
        if (!Auth::guard('web')->user()->wishlistsHas(request('productId'))){

            Auth::guard('web')->user()->wishlist()->attach(request('productId'));
            return response()->json(['status'=>'success','message'=>trans('site.Added to favorites successfully')]);
        }else{
            return response()->json(['status'=>'error','message'=>trans('site.The product is already in favorites')]);

        }
    }

    public function destroy(){
        Auth::guard('web')->user()->wishlist()->detach(request('productId'));
        if(app()->getlocale()=='ar'){
            return response()->json(['status'=>'success','message'=>trans('site.Deleted from favorites successfully')]);
        }
        else{
           return response()->json(['message'=>trans('site.Successfully removed from your favorites')]);

        }

    }
}
