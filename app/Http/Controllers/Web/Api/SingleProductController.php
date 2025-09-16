<?php

namespace App\Http\Controllers\Web\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RatingRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Rating;
use App\Models\ProdSize;
use App\Models\ProdColor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
class SingleProductController extends Controller
{

    public function getProduct($product_id)
    {
        // STEP 1: Load product
        $product = Product::with(['categories', 'statements', 'images', 'kurly', 'brand', 'variants'])
            ->find($product_id);

        if (!$product) {
            return response([
                'status' => Response_Fail,
                'data'   => __('api.errors.pr_notfound'),
            ]);
        }

        // Handle brand logic
        if ($product->is_brand == 1) {
            $student = $product->students()->first();
            if (!$student) {
                $product->is_brand = 0;
                $product->save();

                $product = Product::with(['categories', 'statements', 'images', 'kurly', 'brand', 'variants'])
                    ->find($product_id);
            }
        }

        // STEP 2: Collect all combinations from variants
        $allCombinations = collect();
        foreach ($product->variants as $variant) {
            $combination = collect($variant->combination)->map(fn($item) =>
            is_object($item) ? (array) $item : $item
        );
        $allCombinations = $allCombinations->merge($combination);
    }

        // STEP 3: Group by attribute_id (remove duplicates first)
        $grouped = $allCombinations
            ->unique(fn($item) => $item['attr_id'] . '-' . $item['opt_id'])
        ->groupBy('attr_id');

    // Preload attributes & options to avoid N+1 queries
    $attributeIds = $grouped->keys();
    $optionIds = $allCombinations->pluck('opt_id')->unique();

    $attributesData = Attribute::whereIn('id', $attributeIds)->get()->keyBy('id');
    $optionsData = Option::withTrashed()->whereIn('id', $optionIds)->get()->keyBy('id');

    // STEP 4: Build attributes with options
    $attributes = $grouped->map(function ($items, $attributeId) use ($attributesData, $optionsData) {
        $attribute = $attributesData->get($attributeId);
        if (!$attribute) return null;

        return [
            'id'       => $attribute->id,
            'name_ar'  => $attribute->name_ar,
            'name_en'  => $attribute->name_en,
            'is_free'  => $attribute->is_free,
            'options'  => $items->map(function ($item) use ($optionsData) {
                $option = $optionsData->get($item['opt_id']);
                if (!$option) return null;

                return [
                    'id'      => $option->id,
                    'name_ar' => $option->name_ar,
                    'name_en' => $option->name_en,
                ];
            })->filter()->unique('id')->values(),
        ];
    })->filter()->values();

    $data['product']    = $product;
    $data['attributes'] = $attributes;

    // STEP 5: Related products
    if ($product->is_brand == 0) {
        $category_ids = ProductCategory::where('product_id', $product_id)->pluck('category_id');

        $data['r_products'] = Product::where('is_brand', 0)
            ->whereHas('categories', fn($q) => $q->whereIn('categories.id', $category_ids))
            ->where('id', '!=', $product_id)
            ->customSelect()
            ->latest()
            ->simplePaginate(10)
            ->items();
    } else {
        $student = $product->students()->first();
        if ($student) {
            $data['r_products'] = Product::where('is_brand', 1)
                ->whereHas('students', fn($q) => $q->where('students.id', $student->id))
                ->where('id', '!=', $product_id)
                ->customSelect()
                ->latest()
                ->simplePaginate(10)
                ->items();
        } else {
            $category_ids = ProductCategory::where('product_id', $product_id)->pluck('category_id');

            $data['r_products'] = Product::where('is_brand', 0)
                ->whereHas('categories', fn($q) => $q->whereIn('categories.id', $category_ids))
                ->where('id', '!=', $product_id)
                ->customSelect()
                ->latest()
                ->simplePaginate(10)
                ->items();
        }
    }

    return response([
        'status' => $product ? Response_Success : Response_Fail,
        'data'   => $data,
    ]);
}

    public function getColorForSizeProduct(Request $request){
          $validator = \Validator::make($request->all(), [
              'product_id' => 'required|exists:products,id',
              'size_id' => 'required|integer|exists:options,id',
          ]);
          if ($validator->fails()) {
              return response()->json($validator->errors(), 422);
          }

          $product = Product::whereId($request->product_id)->first();
          if(!$product){
            return  response([
                'status'      => Response_Fail,
                'data'        => __('api.errors.pr_notfound'),
            ]);
          }

        $ids =  ProdColor::where('product_id' ,$product->id)
                            ->where('size_id',$request->size_id)->where('quantity','>',0)->pluck('color_id');

        $data=  Option::whereIn('id',$ids)->get();
                        // dd($ids);
        return  response([
            'status'      => $data->count() >= 1 ? Response_Success : Response_Fail,
            'data'        => $data,
        ]);
    }
    public function checkProduct(Request $request){
      $validator = \Validator::make($request->all(), [
          'product_id' => 'required',
          'quantity' => 'required|integer',
          'attributes' => 'nullable|array',
          'attributes.*' => 'required',
      ]);
      if ($validator->fails()) {
          return response()->json($validator->errors(), 422);
      }

      $product = Product::whereId($request->product_id)->first();
      if(!$product){
        return  response([
            'status'      => Response_Fail,
            'message'        => __('api.errors.pr_notfound'),
            'data'        => 0,
        ]);
      }

      if(!$request->has('attributes') || $request->attributes == null ){
        if($request->quantity > $product-> quantity ){
          return  response([
              'status'      => Response_Fail,
              'message'        => __('api.errors.quantity'),
              'data'        => $product-> quantity,
          ]);
        }else{
          return  response([
              'status'      => Response_Success,
              'message'        => __('api.success.quantity'),
              'data'        => $product-> quantity,
          ]);

        }

      }else{
        if($product->is_clothes){
            $attr=$request->get('attributes');
            $ProdColor=ProdColor::where('product_id',$product->id)->where('color_id',$attr[7])->where('size_id',$attr[6])->first();

            if($ProdColor){
              if( $request->quantity <= $ProdColor-> quantity ){
                return  response([
                    'status'      => Response_Success,
                    'message'        => __('api.success.quantity'),
                    'data'        => $ProdColor-> quantity,
                ]);
              }
              return  response([
                  'status'      => Response_Fail,
                  'message'        => __('api.errors.quantity'),
                  'data'        => $ProdColor-> quantity,
              ]);
            }
            return  response([
                'status'      => Response_Fail,
                'message'        => __('api.errors.quantity'),
                'data'        => 0,
            ]);

        }
        foreach ($request->get('attributes') as  $id => $option) {
            $opvalue=OptionValue::where('option_id',$option)->where('product_id',$request->product_id)->first();
            if(!$opvalue){
              return  response([
                  'status'      => Response_Fail,
                  'message'        => __('api.errors.quantity'),
                  'data'        => 0,
              ]);
            }elseif($request->quantity > $opvalue-> quantity ){
              return  response([
                  'status'      => Response_Fail,
                  'message'        => __('api.errors.quantity'),
                  'data'        => $opvalue-> quantity,
              ]);
            }

            return  response([
                'status'      => Response_Success,
                'message'        => __('api.success.quantity'),
                'data'        => $opvalue-> quantity,
            ]);

        }
      }

    }

    public function getRatings(Request $request){

        $ratings = Rating::where('product_id' , $request->product_id)
            ->where('status' , 1)
            ->latest()
            ->simplePaginate(10);

        $ratingsCount = $ratings->count();

        return  response([
            'status'      => $ratingsCount > 0 ? Response_Success : Response_Fail,
            'countItems'  => $ratingsCount ,
            'data'        =>  $ratings->items(),
        ]);
    }

    public function checkVariant(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'selected_options' => 'required|array|min:1',
            'selected_options.*.attribute_id' => 'required|integer',
            'selected_options.*.option_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::with('variants')->findOrFail($request->product_id);

        $combination = collect($request->selected_options)
            ->map(function ($item) {
                return [
                    'attribute_id' => (int) $item['attribute_id'],
                    'option_id' => (int) $item['option_id'],
                ];
            })
            ->sortBy(['attribute_id', 'option_id'])
            ->values();

        $variant = $product->variants->first(function ($variant) use ($combination) {
            $variantCombo = collect($variant->combination)
                ->map(fn($item) => [
                'attribute_id' => (int) $item['attr_id'],
                'option_id' => (int) $item['opt_id'],
            ])
            ->sortBy(['attribute_id', 'option_id'])
                ->values();

            return $variantCombo == $combination;
        });

        if (!$variant) {
            return response()->json([
                'status' => 0,
                'message' => __('Variant not available')
            ]);
        }

        return response()->json([
            'status' => 1,
            'variant' => [
                'id' => $variant->id,
                'price' => $variant->price??null,
                'discount_price' => $variant->discount_price??null,
                'quantity' => $variant->quantity??null,
            ]
        ]);
    }

}
