<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Advertisement;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Icon;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Design;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cache;

class HomeProductsController extends Controller
{
    const COUNT_ROWS = 10;

    public function __construct() {

        $this->middleware('auth.guard:web-api')->only('idsProductLike');
    }

    public function checkUserToken(){

        if (auth()->check()){
            return response([
                'status' => Response_Success,
                'msg' => "Token valid",
            ]);
        }else{
            return response([
                'status' => Response_Fail,
                'msg' => "Token invalid",
            ]);
        }
    }

    public function generalSetting(){

        $settings = Setting::whereIn('name', ['ios_version', 'android_version', 'ios_url', 'android_url','contact_us_phone','contact_us_whatsapp','contact_us_facebook','contact_us_inst','contact_us_snap'])
            ->pluck('value', 'name')
            ->toArray();



        return response($settings);
    }

    public function index(){

        $cacheDuration = 3600; // Cache duration in seconds (1 hour)

        $offerEndingSoon = Cache::remember('offerEndingSoon', $cacheDuration, function() {
            return Product::customSelect(['products.end_sale'])
                ->join(\DB::raw('(SELECT MIN(id) as id FROM products GROUP BY name_ar) as unique_products'), 'products.id', '=', 'unique_products.id')
                //->inStock()
                ->where('end_sale', '>=', Carbon::now()->format('Y-m-d'))
                ->where('in_sale', 1)
                ->inRandomOrder()
                ->take(self::COUNT_ROWS)
                ->get();
        });

        $categories = Cache::remember('categories', $cacheDuration, function() {
            return Category::with('subCategories')
                ->where('parent_id', 0)
                ->inRandomOrder()
                ->take(20)
                ->get();
        });

        /*$newProducts = Cache::remember('newProducts', $cacheDuration, function() {
            return Product::customSelect()
                ->whereIn('id', function($query) {
                    $query->select(\DB::raw('MAX(id)'))
                        ->from('products')
                        ->groupBy('name_ar');
                })
                ->inRandomOrder()
                ->take(self::COUNT_ROWS)
                ->get();
        });*/

        // Apply similar caching to other product queries
        $bdinarProducts = Cache::remember('bdinarProducts', $cacheDuration, function() {
            return Product::customSelect()
                ->whereIn('id', function($query) {
                    $query->select(\DB::raw('MAX(id)'))
                        ->from('products')
                        ->groupBy('name_ar');
                })
                ->where('regular_price', '<=', 1)
                ->orderBy('regular_price', 'asc')
                ->take(self::COUNT_ROWS)
                ->get();
        });



// dd('ddd');
        /*
        $offerEndingSoon = Product::customSelect(['products.end_sale'])
            ->join(\DB::raw('(SELECT MIN(id) as id FROM products GROUP BY name_ar) as unique_products'), 'products.id', '=', 'unique_products.id')
            ->inStock()
            ->where('end_sale', '>=', Carbon::now()->format('Y-m-d'))
            ->where('in_sale', 1)
            #->where('is_brand', 0)
            ->inRandomOrder()
            ->take(self::COUNT_ROWS)
            ->get();
            $categories = Category::with('subCategories')
                ->where('parent_id' , 0)
                ->inRandomOrder()
                ->take(20)
                ->get();
        $newProducts = Product::customSelect()
            #->where('is_brand',0)
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('products')
                    ->groupBy('name_ar');
            })
            ->inRandomOrder()
            ->take(self::COUNT_ROWS)
            ->get();

        */

        /*$newProducts2 = Product::customSelect()
            #->where('is_brand',0)
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('products')
                    ->groupBy('name_ar');
            })
            ->orderBy('id','DESC')
            ->take(self::COUNT_ROWS)
            ->get();*/

        // Apply similar caching to other product queries
        $newProducts2 = Cache::remember('newProducts2', $cacheDuration, function() {
            return Product::customSelect()
                ->whereIn('id', function($query) {
                    $query->select(\DB::raw('MAX(id)'))
                        ->from('products')
                        ->groupBy('name_ar');
                })
                ->orderBy('id','DESC')
                ->take(self::COUNT_ROWS)
                ->get();
        });

        /*$brands = Student::where('is_active',1)->latest()
                ->simplePaginate(self::COUNT_ROWS);*/

        /*$bdinarProducts = Product::customSelect()
            #->where('is_brand',0)
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('products')
                    ->groupBy('name_ar');
            })
            ->where('regular_price','<=',1)
            ->orderBy('regular_price','asc')
            ->take(self::COUNT_ROWS)
            ->get();

        $brands = Student::where('is_active',1)
            ->orderByRaw('ISNULL(row_no), row_no ASC')
            ->simplePaginate(100);

        $maleBrands = Student::where('is_active',1)
            ->where('gender',1)
            ->orderByRaw('ISNULL(row_no), row_no ASC')
            ->simplePaginate(100);*/

        // Caching the brands and categorized students as they are unlikely to change frequently
        /*$brands = Cache::remember('brands', $cacheDuration, function() {
            return Student::where('is_active', 1)
                ->orderByRaw('ISNULL(row_no), row_no ASC')
                ->simplePaginate(100);
        });*/

        

        $brands = Cache::remember('brands', $cacheDuration, function() {
            return Student::where('is_active', 1)
                ->orderByRaw('ISNULL(row_no), row_no ASC')
                ->take(self::COUNT_ROWS)
                ->get();
        });

        $maleBrands = Cache::remember('maleBrands', $cacheDuration, function() {
            return Student::where('is_active', 1)
                ->where('gender', 1)
                ->orderByRaw('ISNULL(row_no), row_no ASC')
                ->simplePaginate(10);
        });




        /*
        $femaleBrands = Student::where('is_active',1)
            ->where('gender',2)
            ->orderByRaw('ISNULL(row_no), row_no ASC')
            ->simplePaginate(100);*/

        $femaleBrands = Cache::remember('femaleBrands', $cacheDuration, function() {
            return Student::where('is_active', 1)
                ->where('gender', 2)
                ->orderByRaw('ISNULL(row_no), row_no ASC')
                ->simplePaginate(10);
        });



        /*$marketBrands = Student::where('is_active',1)
            ->where('gender',3)
            ->orderByRaw('ISNULL(row_no), row_no ASC')
            ->simplePaginate(100);*/

       /* $marketBrands = Cache::remember('marketBrands', $cacheDuration, function() {
            return Student::where('is_active', 1)
                ->where('gender', 3)
                ->orderByRaw('ISNULL(row_no), row_no ASC')
                ->simplePaginate(10);
        });*/

        /*$brandsProducts = Product::customSelect(['is_best'])
            ->inStock()->where('is_brand',1)
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('products')
                    ->groupBy('name_ar');
            })
            ->inRandomOrder()
            ->take(self::COUNT_ROWS)
            ->get();*/

        // Apply similar caching to other product queries
        $brandsProducts = Cache::remember('brandsProducts', $cacheDuration, function() {
            return Product::customSelect(['is_best'])
                //->inStock()->where('is_brand',1)
                ->whereIn('id', function($query) {
                    $query->select(\DB::raw('MAX(id)'))
                        ->from('products')
                        ->groupBy('name_ar');
                })
                ->inRandomOrder()
                ->take(self::COUNT_ROWS)
                ->get();
        });




        /*$bestProducts = Product::customSelect(['products.is_best'])
            ->where('is_best' , 1)
            ->inStock()
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('products')
                    ->groupBy('name_ar');
            })
            #->where('is_brand',0)
            ->inRandomOrder()
            ->take(self::COUNT_ROWS)
            ->get();*/

        /*$bestProducts = Cache::remember('bestProducts', $cacheDuration, function() {
            return Product::customSelect(['products.is_best'])
                ->where('is_best' , 1)
                //->inStock()
                ->whereIn('id', function($query) {
                    $query->select(\DB::raw('MAX(id)'))
                        ->from('products')
                        ->groupBy('name_ar');
                })
                #->where('is_brand',0)
                ->inRandomOrder()
                ->take(self::COUNT_ROWS)
                ->get();
        });*/

        $recommendedProducts = Cache::remember('recommendedProducts', $cacheDuration, function() {
            return Product::customSelect(['products.is_recommended'])
                ->where('is_recommended' , 1)
                //->inStock()
                ->whereIn('id', function($query) {
                    $query->select(\DB::raw('MAX(id)'))
                        ->from('products')
                        ->groupBy('name_ar');
                })
                #->where('is_brand',0)
                ->inRandomOrder()
                ->take(self::COUNT_ROWS)
                ->get();
        });

        $indoorProducts = Cache::remember('indoorProducts', $cacheDuration, function() {
            return Product::customSelect(['products.indoor'])
                ->where('indoor' , 1)
                //->inStock()
                ->whereIn('id', function($query) {
                    $query->select(\DB::raw('MAX(id)'))
                        ->from('products')
                        ->groupBy('name_ar');
                })
                ->inRandomOrder()
                ->take(self::COUNT_ROWS)
                ->get();
        });

         $outdoorProducts = Cache::remember('outdoorProducts', $cacheDuration, function() {
            return Product::customSelect(['products.outdoor'])
                ->where('outdoor' , 1)
                //->inStock()
                ->whereIn('id', function($query) {
                    $query->select(\DB::raw('MAX(id)'))
                        ->from('products')
                        ->groupBy('name_ar');
                })
                ->inRandomOrder()
                ->take(self::COUNT_ROWS)
                ->get();
        });

        $uniquePiecesProducts = Cache::remember('uniquePiecesProducts', $cacheDuration, function() {
            return Product::customSelect(['products.unique'])
                ->where('unique' , 1)
                //->inStock()
                ->whereIn('id', function($query) {
                    $query->select(\DB::raw('MAX(id)'))
                        ->from('products')
                        ->groupBy('name_ar');
                })
                ->inRandomOrder()
                ->take(self::COUNT_ROWS)
                ->get();
        });

        /*$recommendedProducts = Product::customSelect(['products.is_recommended'])
            ->where('is_recommended' , 1)
            ->inStock()
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('products')
                    ->groupBy('name_ar');
            })
            #->where('is_brand',0)
            ->inRandomOrder()
            ->take(self::COUNT_ROWS)
            ->get();
        */

        /*$bestDiscount = Product::customSelect()
            ->where('in_sale' , 1)
            ->inStock()
            /*->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('products')
                    ->groupBy('name_ar');
            })*//*
            #->where('is_brand',0)
            ->inRandomOrder()
            ->take(self::COUNT_ROWS)
            ->get();*/

        $bestDiscount = Cache::remember('bestDiscount', $cacheDuration, function() {
            return Product::customSelect()
                ->where('in_sale' , 1)
                //->inStock()
                /*->whereIn('id', function($query) {
                    $query->select(\DB::raw('MAX(id)'))
                        ->from('products')
                        ->groupBy('name_ar');
                })*/
                #->where('is_brand',0)
                ->inRandomOrder()
                ->take(self::COUNT_ROWS)
                ->get();
        });

        /*$bestPrice = Product::customSelect()
            ->inStock()
            #->where('is_brand',0)
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('products')
                    ->groupBy('name_ar');
            })
            ->inRandomOrder()
            ->take(self::COUNT_ROWS)
            ->get();*/

        $bestPrice = Cache::remember('bestPrice', $cacheDuration, function() {
            return Product::customSelect()
                //->inStock()
                #->where('is_brand',0)
                ->whereIn('id', function($query) {
                    $query->select(\DB::raw('MAX(id)'))
                        ->from('products')
                        ->groupBy('name_ar');
                })
                ->inRandomOrder()
                ->take(self::COUNT_ROWS)
                ->get();
        });

        /*$topLikes = Product::customSelect(['products.likes_count'])
            
            ->inStock()
            #->where('is_brand',0)
            ->inRandomOrder()
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('products')
                    ->groupBy('name_ar');
            })
            ->take(self::COUNT_ROWS)
            ->get();
        */

        /*$topLikes = Cache::remember('topLikes', $cacheDuration, function() {
            return Product::customSelect(['products.likes_count'])

                //->inStock()
                #->where('is_brand',0)
                ->inRandomOrder()
                ->whereIn('id', function($query) {
                    $query->select(\DB::raw('MAX(id)'))
                        ->from('products')
                        ->groupBy('name_ar');
                })
                ->take(self::COUNT_ROWS)
                ->get();
        });*/

        /*$topRating = Product::customSelect(['products.ratings'])
            
            ->inStock()
            #->where('is_brand',0)
            ->whereIn('id', function($query) {
                $query->select(\DB::raw('MAX(id)'))
                    ->from('products')
                    ->groupBy('name_ar');
            })
            ->inRandomOrder()
            ->take(self::COUNT_ROWS)
            ->get();*/

       /* $topRating = Cache::remember('topRating', $cacheDuration, function() {
            return   Product::customSelect(['products.ratings'])

                //->inStock()
                #->where('is_brand',0)
                ->whereIn('id', function($query) {
                    $query->select(\DB::raw('MAX(id)'))
                        ->from('products')
                        ->groupBy('name_ar');
                })
                ->inRandomOrder()
                ->take(self::COUNT_ROWS)
                ->get();
        });*/


// Cache the following queries for performance
        /*$icons = Cache::remember('icons', 60, function () {
            return Icon::where('type', 'icon')->get(['title', 'img', 'link']);
        });*/

        $informations = Cache::remember('informations', 60, function () {
            return Icon::where('type', 'information')->get(['title', 'link']);
        });

        $sliders = Cache::remember('sliders', 60, function () {
            return Slider::all();
        });

        /*//$sliders = Cache::remember('sliders', 60, function () {
        $sliders = Slider::orderBy('id','desc')->get()->map(function ($slider) {

            $response = [
                'id' => $slider->id,
                'img' => $slider->img,
                'src' => $slider->src,
                'slider_for' => $slider->slider_for,
                'reference_id' => $slider->slider_reference,
                'reference_data' => null
            ];

            if ($slider->slider_for === 'brand_id' && $slider->slider_reference) {
                $brand = Student::find($slider->slider_reference);
                if ($brand) {
                    $response['reference_data'] = [
                        'name_ar' => $brand->name_ar,
                        'name_en' => $brand->name_en,
                        'id' => $brand->id
                    ];
                }
            }

            if ($slider->slider_for === 'product_id' && $slider->slider_reference) {
                $product = Product::find($slider->slider_reference);
                if ($product) {
                    $response['reference_data'] = [
                        'name_ar' => $product->name_ar,
                        'name_en' => $product->name_en,
                        'id' => $product->id
                    ];
                }
            }
            if ($slider->slider_for === 'category_id' && $slider->slider_reference) {
                $category = Category::find($slider->slider_reference);
                if ($category) {
                    $response['reference_data'] = [
                        'name_ar' => $category->name_ar,
                        'name_en' => $category->name_en,
                        'id' => $category->id
                    ];
                }
            }

            // Similar for category and product...

            return $response;
        });
        //});*/

        $ads = Cache::remember('ads', 60, function () {
            return Ad::where('position', 2)->get();
        });

         $designs = Cache::remember('designs', 60, function () {
            return Design::where('status' , 1)->get();
        });

        $advertisements = Cache::remember('advertisements', 60, function () {
            return Advertisement::select(['id', 'image', 'advertisement_type', 'reference_id', 'out_source_link'])->get()->map(function ($advertisement) {
                return [
                    'id' => $advertisement->id,
                    'image' => asset($advertisement->image),
                    'advertisement_type' => $advertisement->advertisement_type,
                    'reference' => $advertisement->reference_id ? $advertisement->reference : null,
                    'reference_id' => $advertisement->reference_id,
                    'out_source_link' => $advertisement->out_source_link,
                ];
            });
        });

        return  response([

            'status' => Response_Success,
            'data'   => [

                'sliders'             => $sliders,
                'categories'          => $categories,
                'furnitureMarkets'          => $brands,
                'lastestProducts'         => $newProducts2,
                'ads'                 => $ads,
                'indoorDecor'         => $indoorProducts,
                'outdoorDecor'         => $outdoorProducts,
                'uniquePieces'         => $uniquePiecesProducts,

               
                /*'newProducts'         => $newProducts,*/
                /*'bestProducts'        => $bestProducts,*/




                /* 'offerEndingSoon'     => $offerEndingSoon,
                'bdinarProducts'        => $bdinarProducts,
                'brandProducts'        => $brandsProducts,
                'recommendedProducts' => $recommendedProducts,
                'bestDiscount'        => $bestDiscount,
                'bestPrice'           => $bestPrice,
                'informations'        => $informations,
                'maleBrands'          => $maleBrands,
                'femaleBrands'          => $femaleBrands,
                'advertisements'          => $advertisements, */




//                'topLikes'            => $topLikes,
//                'topRating'           => $topRating,
//                'icons'               => $icons,
              
               /* 'marketBrands'          => $marketBrands,*/
               
            ],
        ]);

    }

    public function get_order(){


          //        TODO :: VALIDATION FOR BOOKING  IF  MONEY ALREADY PAID


          /* ------------------------ Configurations ---------------------------------- */
          //Test
            // $apiURL='https://apitest.myfatoorah.com';
            // $apiKey='rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';



          $apiURL ='https://api.myfatoorah.com' ;
          $apiKey = 'DmnT-XUpIpN8FtbVl6AabNBc-jHxsOlAwrCA_ANkRX5V7D6tVS4nozWQBxrllgkQ3ZErGnfzrwxNqGV2TCgJ0rQGvfEpO8maxMhz0Dt92Buh68M54Ux33SF18QcnEedoFow0E4J49xpEUyplwDzHPoLPAI03XgSWhjDiaF09TP1o49_2ChY8DF_lWUSzPQvT7eRVCXzJWmmJCg-KgEg7AYdAhZ5sakky5exKBLyzucpmXvAELMsBAQE5O8wF6CvSSKOMI064oBFlpSwwkT2vUKdJiQf3AEsxqYpp_wrEsdzW4St7Kke2-8Hy1PRDKbh-iZC3q5Hpwdlk32ZSjazAzZpwsyGDsF1-LZhhYv1eH3BWOhxFjHxIo25tHl7jVa-b9p85ptTR5BcxkQnGPNWInkgHhx2lJFCD1yJBNB8Me_bf_8X9xnc1NkkD_xfw_siJxjx8IlVxL1DHoecEJLMtLTzlpeldc2LOBXb_YZgYiNpRJRWecm2-DgjN7B-ODqI5_poHr4N-E-60RlXfO_K6eAi0KaLeiE6jcmbAoCgdm5UQnFMpyEecM1gaqC3H-V0hwQn_oORaJsuLVFlP-yfDCt9Xcg6Yy9mTQuOnzP7ymjMKI1pccNTY8vWtkLwfdIK8XeJWCgqzK9Wmu5wq7LGIgzM-bSIinT5OfvF-NTbXRMVRMEgfkj_nlfwcpswJZfaLmvNuFQdRNGDSbLCvnTc5eUpJVhFTOD1w9XZu6gIUrlFamP_1';
          /* ------------------------ Call SendPayment Endpoint ----------------------- */



         //  ### live ###
         //  $apiURL = 'https://api.myfatoorah.com';
         // $apiKey='MI8Kyj_3zfrXWEnszpDTIwCSmNlz8fyeTNLu3bhLQNCd3X7MDfaI2g6rjEPQo6prMrvy8oi351N_P5B_vqw6JxcCGaVWgOfy8Df4HQLjwKKrhvXBD35i-FOhsb4JmRK54RXWBdPpn_FbZZhaPsq4fhGNDEtGHvfLyzviLAN--DSMrsBIcEXuowr7-SwXlAWbpSzLeQNwzhrtVtZF9LXgmr16MFweC5OVjeW5mm26lfEpXLtFQyhS_4YJFcoypezYs8V5UGDAI_VHH0DPrJmSXwV6fRdesT0YqCzV1egrUKtl-79hYMj_Fif9Y2l4rTOkOiQpCey9t6nusS-uHYImVutAwnCI9TgYtUUnZtlRk4oA_9TgN7CBab11ziY2HlZrPMkrfnzBHQ3wVvezihiYGJ7TD-TGxL53FJdMIHuLIE_jtGUK_348N-ywsgG5m_EeCRdJ-639dfofpW42S_wdCh-OGh9Lq34QrLOol9zfdE-wlI3BJGVuKbyXqKWPghCGVTj27Yv70pxPCnetIV5ygrJEGW50h8EcvGTktS9jJfMOVIqJDhl_Hta18581RhSCbku1qK1ZdBCdwfrYBpov06lUFQbP7M5abkCnpqPmk4N85z8KpU6WB4yw-34B2567mI994ItrdVcsyPFYDgqxWEuQfC-XJWifDLGakAEeEyIrlzOQ';


  //Fill customer address array
          /* $customerAddress = array(
            'Block'               => 'Blk #', //optional
            'Street'              => 'Str', //optional
            'HouseBuildingNo'     => 'Bldng #', //optional
            'Address'             => 'Addr', //optional
            'AddressInstructions' => 'More Address Instructions', //optional
            ); */

          //Fill invoice item array
          /* $invoiceItems[] = [
            'ItemName'  => 'Item Name', //ISBAN, or SKU
            'Quantity'  => '2', //Item's quantity
            'UnitPrice' => '25', //Price per item
            ]; */

          $invoiceItems = array();

            array_push($invoiceItems, [
                'ItemName'  =>'name1', //ISBAN, or SKU
                'Quantity'  => 1, //Item's quantity
                'UnitPrice' => 10, //Price per item20
            ]);
            array_push($invoiceItems, [
                'ItemName'  =>'name2', //ISBAN, or SKU
                'Quantity'  => 1, //Item's quantity
                'UnitPrice' => 10, //Price per item 20
            ]);




          //Fill POST fields array
          $postFields = [
              //Fill required data
              'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
              'InvoiceValue' => 20,
              'CustomerName' => 'mohamed',
              //Fill optional data
              'DisplayCurrencyIso' => 'KWD',
              'MobileCountryCode'  => '965',
              'CustomerMobile'     => '97244282',
              'CustomerEmail'      =>  "no@gmail.com",
               'CallBackUrl'        => 'https://example.com/suc.php',
              'ErrorUrl'           =>  'https://example.com/error.php', //or 'https://example.com/error.php'
              //'Language'           => 'en', //or 'ar'
              //            'CustomerReference'  => $order->id,
              //            'CustomerCivilId'    => $order->national_id,
              //'UserDefinedField'   => 'This could be string, number, or array',
              //'ExpiryDate'         => '', //The Invoice expires after 3 days by default. Use 'Y-m-d\TH:i:s' format in the 'Asia/Kuwait' time zone.
              //'SourceInfo'         => 'Pure PHP', //For example: (Laravel/Yii API Ver2.0 integration)
              //            'CustomerAddress'    => $order->address1,
              //            'InvoiceItems'       => $order->order_items,
              'InvoiceItems'       => $invoiceItems,

          ];

          //Call endpoint
          $data = $this->sendPayment($apiURL, $apiKey, $postFields);

          //You can save payment data in database as per your needs
          $invoiceId = $data->InvoiceId;
          $paymentLink = $data->InvoiceURL;

          // $order->invoice_id = $invoiceId;
          // $order->invoice_link = $paymentLink;
          // $order->save();


          return response()->json(
              [
                  'success' => true,
                  'link' => $paymentLink,
                  'data' => $data,
              ]
          );



    }

    public function sendPayment($apiURL, $apiKey, $postFields)
      {
          $json = $this->callAPI("$apiURL/v2/SendPayment", $apiKey, $postFields);
          return $json->Data;
      }


      public  function handleError($response)
      {

          $json = json_decode($response);
          if (isset($json->IsSuccess) && $json->IsSuccess == true) {
              return null;
          }

          //Check for the errors
          if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
              $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
              $blogDatas = array_column($errorsObj, 'Error', 'Name');

              $error = implode(', ', array_map(function ($k, $v) {
                  return "$k: $v";
              }, array_keys($blogDatas), array_values($blogDatas)));
          } else if (isset($json->Data->ErrorMessage)) {
              $error = $json->Data->ErrorMessage;
          }

          if (empty($error)) {
              $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
          }

          return $error;
      }

      public   function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST')
      {

          $curl = curl_init($endpointURL);
          curl_setopt_array($curl, array(
              CURLOPT_CUSTOMREQUEST => $requestType,
              CURLOPT_POSTFIELDS => json_encode($postFields),
              CURLOPT_HTTPHEADER => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
              CURLOPT_RETURNTRANSFER => true,
          ));

          $response = curl_exec($curl);
          $curlErr = curl_error($curl);

          curl_close($curl);

          if ($curlErr) {
              //Curl is not working in your server
              die("Curl Error: $curlErr");
          }

          $error = $this->handleError($response);
          if ($error) {
              die("Error: $error");
          }

          return json_decode($response);
      }

    public function idsProductLike(){

        $likes = auth()->user()->likes->map->product_id;

        return response([
            'status'=> count($likes) > 0 ? Response_Success : Response_Fail,
            'data'  => $likes,
        ]);
    }

    public function addToCart(Request $request){
        //$user = auth()->check();
        //dd(auth()->check());
        $ip = \request()->ip();
        $product_id = $request->get('product_id');
        $product = Product::find($product_id);
        $qut = $request->get('quantity');

        $cart_item = CartItem::where('ip_address',$ip)
            ->where('product_id',$product_id)->first();
        if ($cart_item){
            $cart_item->update([
                'quantity'=>$qut,
                'user_id' => auth()->check() ? auth()->id() : null,   // Store user_id for logged-in users
                'username' => auth()->check() ? auth()->user()->name : null,   // Store user_id for logged-in users
                'phone' => auth()->check() ? auth()->user()->phone : null,   // Store user_id for logged-in users
                ]);
        }else{
            CartItem::create([
                'product_id' => $product_id,
                'user_id' => auth()->check() ? auth()->id() : null,   // Store user_id for logged-in users
                'username' => auth()->check() ? auth()->user()->name : null,   // Store user_id for logged-in users
                'phone' => auth()->check() ? auth()->user()->phone : null,   // Store user_id for logged-in users
                'ip_address' => request()->ip(), // Store IP for guests
                'quantity' => $qut,
                'price' => $product->if_sale ? $product->sale_price :$product->regular_price,
            ]);
        }

        return response([
            'status'=> Response_Success ,
            'data'  => null,
        ]);
    }
}
