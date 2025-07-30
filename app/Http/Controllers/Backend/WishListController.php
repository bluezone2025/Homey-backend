<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index(){
        $products = auth()->user()->wishlist()->latest()->get();
//        dd($products);
        return view('front.wishlist',compact('products'));

    }
    public function store(){
//        dd(request('productId'));
        if (!auth()->user()->wishlistsHas(request('productId'))){
            auth()->user()->wishlist()->attach(request('productId'));
            return response()->json(['message'=>'Added successfully to your wish list']);
        }
    }

    public function destroy(){
        auth()->user()->wishlist()->detach(request('productId'));

    }

}
