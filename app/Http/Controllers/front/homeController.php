<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Country;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Ad;
use App\Models\Icon;
use App\Models\ProductCategory;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Google_Client;
use Google_Service_Oauth2;

class homeController extends Controller
{
    const COUNT_ROWS = 10;

    public function product($id, Request $request)
    {
        $subCategory = null;
        $mainCategory = null;

        if (isset($request->sub)) {
            $Category1 = Category::select('id', 'parent_id', 'name_' . app()->getLocale())->firstWhere('id', $request->sub);
            if ($Category1->parent_id == 0) {
                $mainCategory = $Category1;
            } else {
                $subCategory = $Category1;
                $mainCategory = Category::select('id', 'name_' . app()->getLocale())->firstWhere('id', $Category1->parent_id);
            }
        }

        $product = Product::where('id', $id)->first();
        $attributes = $product->getVariantAttributes();

        /* session()->forget('cart');

         $cart = session()->get('cart'); */

        /* dd($cart);  */ 

        if (!$product) {
            return response([
                'status' => 'fail',
                'data' => __('api.errors.pr_notfound'),
            ]);
        }else{
            $result = Product::with([
                'categories',
                'statements',
                'images',
                'kurly'
            ])/*->aov($id)*/->where('id', $id)->first();
        }

        if ($result->is_brand == 0) {
            $category_ids = ProductCategory::where('product_id', $id)->pluck('category_id');
            $list = Product::where('is_brand', 0)->whereHas('categories', function ($q) use ($category_ids) {
                $q->whereIn('categories.id', $category_ids);
            })->where('id', '!=', $id)->customSelect()->latest()->simplePaginate(10)->items();
        } else {
            $students_id = $product->students()->first()->id;
            $list = Product::where('is_brand', 1)->whereHas('students', function ($q) use ($students_id) {
                $q->where('students.id', $students_id);
            })->where('id', '!=', $id)->customSelect()->latest()->simplePaginate(10)->items();
        }
        $ads_2 = Ad::where('position', 2)->get();

//        dd($product->variants->min('quantity'));
//        dd($product->variants->max('quantity'));


        return view("front.product_show", compact("result",'attributes', 'ads_2',"id", "list", 'subCategory', 'mainCategory'));
    }

    public function getVariantDetails(Request $request)
    {

        $product = Product::findOrFail($request->product_id);
        $variant = null;
        $price = $product->regular_price;
        $salePrice = $product->sale_price;
        $quantity = $product->quantity;

        //dd($request->get('attributes'));
        // Find matching variant if attributes are selected
        if ($product->variants && $request->get('attributes')) {

            $variant = $product->variants()->get()->first(function($v) use ($request) {
                $combinationMatches = true;
                foreach ($request->get('attributes') as $attrId => $optId) {
                    $found = collect($v->combination)->contains(function($item) use ($attrId, $optId) {
                        return $item['attr_id'] == $attrId && $item['opt_id'] == $optId;
                    });
                    if (!$found) {
                        $combinationMatches = false;
                        break;
                    }
                }
                return $combinationMatches;
            });

            //dd($variant);

            if ($variant) {
                $price = $variant->price ?? $product->final_regular_price;
                $salePrice = $variant->discount_price ?? 0;
                $quantity = $variant->quantity ?? $quantity;
            }
        }else{
            $price = $product->final_regular_price;
            $salePrice = $product->final_sale_price;
            $quantity = $product->quantity;
        }


        // Calculate discount if on sale
        $discountPercent = 0;
        if ($salePrice && $salePrice < $price) {
            $discountPercent = 100 - round(($salePrice / $price) * 100);
        }
        //dd($variant,$price);

        return response()->json([
            'success' => true,
            'variant_id' => $variant ? $variant->id : null,
            'price' => $salePrice ?: $price,
            'regular_price' => $price,
            'discount_price' => $salePrice,
            'discount_percent' => $discountPercent,
            'formatted_price' => get_price_helper($salePrice ?: $price, true),
            'formatted_regular_price' => get_price_helper($price, true),
            'quantity' => $quantity
        ]);
    }

    public function home(Request $request)
    {



        $vendors = Category::with('subCategories')->where('parent_id', 0)->inRandomOrder()->take(10)->get();

        $newProducts = Product::customSelect()
            ->join(DB::raw('(SELECT MIN(id) as id FROM products GROUP BY name_ar) as unique_products'), 'products.id', '=', 'unique_products.id')
            ->inRandomOrder()
            ->take(self::COUNT_ROWS)
            ->get();

        $maleBrands = Student::where('is_active', 1)->where('gender', 1)->orderByRaw('ISNULL(row_no), row_no ASC')->take(4)->get();
        $femaleBrands = Student::where('is_active', 1)->where('gender', 2)->orderByRaw('ISNULL(row_no), row_no ASC')->take(4)->get();
        $Brands = Student::where('is_active', 1)->where('gender', '=', 3)->orderByRaw('ISNULL(row_no), row_no ASC')->get();
        $trends = Student::where('is_active', 1)->where('gender', '=', 2)->orderByRaw('ISNULL(row_no), row_no ASC')->get();

        $recommendedProducts = Product::customSelect(['products.is_recommended'])
            ->where('is_recommended', 1)
            ->join(DB::raw('(SELECT MIN(id) as id FROM products GROUP BY name_ar) as unique_products'), 'products.id', '=', 'unique_products.id')
            ->inRandomOrder()
            ->take(self::COUNT_ROWS)
            ->get();

        $bestDiscount = Product::customSelect()
            ->where('in_sale', 1)
            ->join(DB::raw('(SELECT MIN(id) as id FROM products GROUP BY name_ar) as unique_products'), 'products.id', '=', 'unique_products.id')
            ->inRandomOrder()
            ->take(self::COUNT_ROWS)
            ->get();

        $informations = Icon::where('type', 'information')->get(['title', 'link']);
        $sliders = Slider::all();
        $ads_1 = Ad::where('position', 1)->take(3)->get();
        $ads_2 = Ad::where('position', 2)->get();
        $ads_3 = Ad::where('position', 3)->get();
        $ads_4 = Ad::where('position', 4)->get();
        $ads_5 = Ad::where('position', 5)->get();
        $ads_6 = Ad::where('position', 6)->get();
        $ads_7 = Ad::where('position', 7)->get();
        $ads_8 = Ad::where('position', 8)->get();
        $ads_9 = Ad::where('position', 9)->get();
        $ads_10 = Ad::where('position', 10)->get();

        //        dd($trends);

        return view("front.index")->with([
            'newProducts' => $newProducts,
            'recommendedProducts' => $recommendedProducts,
            'offers' => $bestDiscount,
            'informations' => $informations,
            'sliders' => $sliders,
            'ads_1' => $ads_1,
            'ads_2' => $ads_2,
            'ads_3' => $ads_3,
            'ads_4' => $ads_4,
            'ads_5' => $ads_5,
            'ads_6' => $ads_6,
            'ads_7' => $ads_7,
            'ads_8' => $ads_8,
            'ads_9' => $ads_9,
            'ads_10' => $ads_10,
            'vendors' => $vendors,
            'maleBrands' => $maleBrands,
            'femaleBrands' => $femaleBrands,
            'Brands' => $Brands,
            'trends' => $trends,

        ]);
    }

   public function productByType(Request $request, $type)
{
    $perPage = 32; 
    $query = Product::query();

    $type = $request->get('type',$type); 

/*     $search = $request->get('search');
 */    $sort = $request->get('sort');

    switch ($type) {
        case 'topRating':
            $query->orderBy('ratings', 'desc');
            break;

        case 'bestProducts':
            $query->where('is_best', 1)->latest('id');
            break;

        case 'recommendedProducts':
            $query->where('is_recommended', 1)->latest('id');
            break;

        case 'offers':
        case 'trendat_picks':
            $query->where(function ($q) {
                $q->where('in_sale', 1)->orWhere('sale_price', '!=', 0);
            })->latest('id');
            break;

        case 'bestPrice':
            $query->orderBy('regular_price', 'asc');
            break;

        case 'topLikes':
            $query->orderBy('likes_count', 'desc');
            break;

        case 'newProducts':
            $query->orderBy('created_at', 'desc');
            break;

        default:
            $query->latest('id');
            break;
    }
    $sort = $request->query('sort', 'default');
    $sort_value=trans('site.Basic arrangement');

    // If a sort option is provided, clear previous ordering and apply new sorting.
    if ($sort !== 'default') {
        // Clear any ordering that was previously set.
        $query->reorder();




        // Apply sort modifications
        switch ($sort) {
            case 'oldest':
                $query->orderBy('id', 'asc');
                $sort_value=trans('site.oldest');
                break;
            case 'newest':
                $query->latest('id');
                $sort_value=trans('site.newest');

                break;
          case 'highest_price':
            $query->orderByRaw("
                CASE 
                    WHEN (in_sale = 1 OR sale_price != 0) AND fina_actual_sale_price IS NOT NULL AND fina_actual_sale_price > 0
                        THEN fina_actual_sale_price
                    WHEN fina_actual_regular_price IS NOT NULL
                        THEN fina_actual_regular_price
                    ELSE 0
                END DESC
            ");
            $sort_value = trans('site.Highest price then lowest');
            break;

           case 'lowest_price':
            $query->orderByRaw("
                CASE 
                    WHEN (in_sale = 1 OR sale_price != 0) AND fina_actual_sale_price IS NOT NULL AND fina_actual_sale_price > 0
                        THEN fina_actual_sale_price
                    WHEN fina_actual_regular_price IS NOT NULL
                        THEN fina_actual_regular_price
                    ELSE 999999999
                END ASC
            ");
            $sort_value = trans('site.Lowest price then highest');
            break;


            // ... other cases
        }


    }

    $name = __('site.' . $type);
    $productCount=$query->count();

   

    // إذا الطلب AJAX نرجع HTML فقط للمنتجات مع بيانات الصفحة
    if ($request->ajax()) {
        $products = $query->paginate($perPage);
        return response()->json([
            'html' => view('front.partials.products_items', ['populars' => $products])->render(),
            'next_page' => $products->nextPageUrl(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'sort'=>$sort,
            'productCount'=>$productCount,
             'name' => $name,
        ]);
    }

    // الطلب الأساسي (غير AJAX)
    $products = $query->paginate($perPage);


    
    return view('front.template')->with([
        'populars' => $products,
        'name' => $name,
        'sort'=>$sort,
        'productCount'=>$productCount,
        
    ]);
}

    public function vendor(Request $request, $id)
    {
        $records = Category::findOrFail($id);
        $ParentCategory = null;

        if ($records->parent_id == 0) {
            $subCategories_header = Category::where('parent_id', $id)->get();
            $subCategories = $records->subCategories->map->id->all();
            $allCategories = array_merge($subCategories, [$id]);

            $populars = Product::whereHas('categories', function ($q) use ($allCategories) {
                $q->whereIn('categories.id', $allCategories);
            })->inRandomOrder();
        } else {
            $subCategories_header = Category::where('parent_id', $records->parent_id)->get();
            $ParentCategory = Category::select('id', 'name_' . app()->getlocale())->where('id', $records->parent_id)->first();
            $populars = $records->products();
        }
//        dd($records);

//        $prod=Product::find(5472);
//        dd($prod->checkQuantity());
    $perPage=32;

    $sort = $request->query('sort', 'default');
    $sort_value=trans('site.Basic arrangement');

    // If a sort option is provided, clear previous ordering and apply new sorting.
    if ($sort !== 'default') {
        // Clear any ordering that was previously set.
        $populars->reorder();




        // Apply sort modifications
        switch ($sort) {
            case 'oldest':
                $populars->orderBy('id', 'asc');
                $sort_value=trans('site.oldest');
                break;
            case 'newest':
                $populars->latest('id');
                $sort_value=trans('site.newest');

                break;
          case 'highest_price':
            $populars->orderByRaw("
                CASE 
                    WHEN (in_sale = 1 OR sale_price != 0) AND fina_actual_sale_price IS NOT NULL AND fina_actual_sale_price > 0
                        THEN fina_actual_sale_price
                    WHEN fina_actual_regular_price IS NOT NULL
                        THEN fina_actual_regular_price
                    ELSE 0
                END DESC
            ");
            $sort_value = trans('site.Highest price then lowest');
            break;

           case 'lowest_price':
            $populars->orderByRaw("
                CASE 
                    WHEN (in_sale = 1 OR sale_price != 0) AND fina_actual_sale_price IS NOT NULL AND fina_actual_sale_price > 0
                        THEN fina_actual_sale_price
                    WHEN fina_actual_regular_price IS NOT NULL
                        THEN fina_actual_regular_price
                    ELSE 999999999
                END ASC
            ");
            $sort_value = trans('site.Lowest price then highest');
            break;


            // ... other cases
        }


    }

if ($request->ajax()) {
        $products = $populars->paginate($perPage);
        return response()->json([
            'html' => view('front.partials.products_items', ['populars' => $products])->render(),
            'next_page' => $products->nextPageUrl(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
             'records'=>$records,
            'id'=>$id,
            'subCategories_header'=>$subCategories_header,
            'ParentCategory'=>$ParentCategory,
        ]);
    }

    // الطلب الأساسي (غير AJAX)
    $products = $populars->paginate($perPage);


    
    return view('front.vendor')->with([
        'records'=>$records,
        'id'=>$id,
        'subCategories_header'=>$subCategories_header,
        'ParentCategory'=>$ParentCategory,
        'populars' => $products,
         'sort'=>$sort,
    
        
    ]);


        return view("front.vendor", compact("records", "id", "populars", 'subCategories_header', 'ParentCategory'));
    }

    public function brand(Request $request, $id)
    {
        $records = Student::findOrFail($id);
        $ads = Ad::wherein('position', [9, 10])->get();
        $offers = $records->products()->where("in_sale", 1)->get();
        $search = $request->get('search', null);

         $perPage = 32; 

         $query = $records->products();

    
        
          $sort = $request->query('sort', 'default');
         $sort_value=trans('site.Basic arrangement');

    // If a sort option is provided, clear previous ordering and apply new sorting.
    if ($sort !== 'default') {
        // Clear any ordering that was previously set.
        $query->reorder();




        // Apply sort modifications
        switch ($sort) {
            case 'oldest':
                $query->orderBy('id', 'asc');
                $sort_value=trans('site.oldest');
                break;
            case 'newest':
                $query->latest('id');
                $sort_value=trans('site.newest');

                break;
          case 'highest_price':
            $query->orderByRaw("
                CASE 
                    WHEN (in_sale = 1 OR sale_price != 0) AND fina_actual_sale_price IS NOT NULL AND fina_actual_sale_price > 0
                        THEN fina_actual_sale_price
                    WHEN fina_actual_regular_price IS NOT NULL
                        THEN fina_actual_regular_price
                    ELSE 0
                END DESC
            ");
            $sort_value = trans('site.Highest price then lowest');
            break;

           case 'lowest_price':
            $query->orderByRaw("
                CASE 
                    WHEN (in_sale = 1 OR sale_price != 0) AND fina_actual_sale_price IS NOT NULL AND fina_actual_sale_price > 0
                        THEN fina_actual_sale_price
                    WHEN fina_actual_regular_price IS NOT NULL
                        THEN fina_actual_regular_price
                    ELSE 999999999
                END ASC
            ");
            $sort_value = trans('site.Lowest price then highest');
            break;


            // ... other cases
        }


    }




    $productCount=$query->count();

    // إذا الطلب AJAX نرجع HTML فقط للمنتجات مع بيانات الصفحة
    if ($request->ajax()) {
        $products = $query->paginate($perPage);
        return response()->json([
            'html' => view('front.partials.brand_products', ['populars' => $products])->render(),
            'next_page' => $products->nextPageUrl(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'sort'=>$sort,
            'productCount'=>$productCount,
             'records'=>$records,
        ]);
    }

    // الطلب الأساسي (غير AJAX)
    $products = $query->paginate($perPage);
    
    return view('front.brand')->with([
        'records'=>$records,
        'populars' => $products,
        'sort'=>$sort,
        'productCount'=>$productCount,
        
    ]);
    }
     public function brands(Request $request)
    {
        $perPage = 32;
        $type = $request->get('type');
        $search = $request->get('search');

        $studentsQuery = Student::where('is_active',1);
        

        /*if ($type) {
            $studentsQuery->where('gender', $type);
        } else {
            $studentsQuery->where('gender', '!=', 3);
        }*/

        if ($search) {
            $studentsQuery->where('name_ar', 'like', '%' . $search . '%');
        }
        
        if ($type) {
            $studentsQuery->where('gender',$type);
        }
        $students = $studentsQuery
            ->orderByRaw('ISNULL(row_no), row_no ASC')
            ->paginate($perPage); // عدد العناصر في كل صفحة

           
        // ✅ لو الطلب AJAX (من الـ Scroll):
    if ($request->ajax()) {
            $view = view('front.partials.brands_items', compact('students'))->render();

            return response()->json([
                'html' => $view,
                'total' => $students->total(),
                'next_page' => $students->hasMorePages(),
                'current_page' => $students->currentPage(),
                'last_page' => $students->lastPage(),
            ]);
        }

        return view("front.brands", compact("students", "type"));
    }

    public function vendors()
    {
        $vendors = Category::with('subCategories')->where('parent_id', 0)->get();
        return view("front.vendors", compact("vendors"));
    }

    public function getCategories(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::when($search, function($query) use ($search) {
            return $query->where('name_ar', 'like', '%'.$search.'%')
                ->orWhere('id', 'like', '%'.$search.'%');
        })
            ->select('id', 'name_ar')
            ->paginate(10);

        return response()->json([
            'data' => $categories->map(function($category) {
                return [
                    'id' => $category->id,
                    'text_ar' => $category->name_ar,
                    'text' => $category->name_ar
                ];
            }),
            'total' => $categories->total()
        ]);
    }

    public function getBrands(Request $request)
    {
        $search = $request->input('search');

        $brands = Student::when($search, function($query) use ($search) {
            return $query->where('name_ar', 'like', '%'.$search.'%')
                ->orWhere('id', 'like', '%'.$search.'%');
        })
            ->select('id', 'name_ar')
            ->paginate(10);

        return response()->json([
            'data' => $brands->map(function($brand) {
                return [
                    'id' => $brand->id,
                    'text_ar' => $brand->name_ar,
                    'text' => $brand->name_ar
                ];
            }),
            'total' => $brands->total()
        ]);
    }

    public function getProducts(Request $request)
    {
        $search = $request->input('search');

        $products = Product::when($search, function($query) use ($search) {
            return $query->where('name_ar', 'like', '%'.$search.'%')
                ->orWhere('id', 'like', '%'.$search.'%');
        })
            ->select('id', 'name_ar')
            ->paginate(10);

        return response()->json([
            'data' => $products->map(function($product) {
                return [
                    'id' => $product->id,
                    'text_ar' => $product->name_ar,
                    'text' => $product->name_ar // For Select2 compatibility
                ];
            }),
            'total' => $products->total()
        ]);
    }

    // ProductController.php
    public function getSingleProduct($id)
    {
        $product = Product::findOrFail($id);
        return response()->json([
            'id' => $product->id,
            'name_ar' => $product->name_ar,
            'text_ar' => $product->name_ar,
            'text' => $product->name_ar // Add this for Select2 compatibility
        ]);
    }

// BrandController.php
    public function getSingleBrand($id)
    {
        $brand = Student::findOrFail($id);
        return response()->json([
            'id' => $brand->id,
            'name_ar' => $brand->name_ar,
            'text_ar' => $brand->name_ar,
            'text' => $brand->name_ar // Add this for Select2 compatibility
        ]);
    }

// CategoryController.php
    public function getSingleCategory($id)
    {
        $category = Category::findOrFail($id);
        return response()->json([
            'id' => $category->id,
            'name_ar' => $category->name_ar,
            'text_ar' => $category->name_ar,
            'text' => $category->name_ar // Add this for Select2 compatibility
        ]);
    }


    public function validateCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
            'subtotal' => 'required|numeric|min:0'
        ]);

        $couponCode = $request->coupon_code;
        $subtotal = $request->subtotal;
        $userId = $request->user_id;

        $coupon = Coupon::where('code', $couponCode)
            ->where('is_active', true)
            ->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => __('site.Coupon not found or inactive')
            ]);
        }

        // Check if coupon has expired
        if ($coupon->end_date && now()->gt($coupon->end_date)) {
            return response()->json([
                'success' => false,
                'message' => __('site.Coupon has expired')
            ]);
        }

        // Check minimum price requirement
        if ($coupon->min_price && $subtotal < $coupon->min_price) {
            return response()->json([
                'success' => false,
                'message' => __('site.Minimum order amount for this coupon is :amount',
                    ['amount' => get_price_helper($coupon->min_price, true)])
            ]);
        }

        // Check usage limit
        if ($coupon->limit_use && $coupon->use >= $coupon->limit_use) {
            return response()->json([
                'success' => false,
                'message' => __('site.This coupon has reached its usage limit')
            ]);
        }

        // Check user limit if user is logged in
        if ($userId && $coupon->limit_user) {
            $userUsage = \App\Models\Order::where('user_id', $userId)
                ->where('coupon_code', $couponCode)
                ->count();

            if ($userUsage >= $coupon->limit_user) {
                return response()->json([
                    'success' => false,
                    'message' => __('site.You have reached the usage limit for this coupon')
                ]);
            }
        }




        return response()->json([
            'success' => true,
            'message' => __('site.Coupon applied successfully'),
            'coupon' => [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'discount' => $coupon->discount,
                'type_discount' => $coupon->type_discount,
                'min_price' => $coupon->min_price
            ]
        ]);
    }


     public function redirectToGoogle()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope('email');
        $client->addScope('profile');
        $authUrl = $client->createAuthUrl();
        //dd($authUrl);

        return redirect($authUrl); // redirect to Google login
    }

    public function handleGoogleCallback(Request $request)
    {
        dd($request);
        $code = $request->get('code'); 
        if (!$code) {
            return response()->json([
                'status' => false,
                'msg' => 'code_missing'
            ]);
        }

        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

        $accessToken = $client->fetchAccessTokenWithAuthCode($code);
        $client->setAccessToken($accessToken);

        $service = new Google_Service_Oauth2($client);
        $googleUser = $service->userinfo->get();

        // attatch to database
        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {
            $user = User::create([
                'name'  => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make(Str::random(16)),
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->picture,
                'email_verified_at' => now(),
            ]);
        } else {
            // update data if user exist
            if (!$user->google_id) $user->google_id = $googleUser->id;
            if ($googleUser->picture) $user->avatar = $googleUser->picture;
            $user->save();
        }

        // get JWT token

          if (! $token = auth()->attempt(['email' => $user->email, 'password' => $user->password])) {
            return response([
                'status'  => Response_Fail,
                'message' => __('auth.password'),
            ]);
        }


        \auth()->user()->device_token =  (string)$request->device_token;
        
        \auth()->user()->save();

        return $this->createNewToken($token);

    }

}
