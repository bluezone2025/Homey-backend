<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $student_id = request()->get('student_id',0);
        $status = request()->get('status','created');
        //dd($student_id,$status);
        static $isFirstRow = true;

        if ($isFirstRow) {
            $isFirstRow = false; // Skip the first row and set flag to false
            return null;
        }

        if ($row[0] == null) {
            return null;
        }

        if($row[0] == null){
            return null;
        }else{
            //dd($row);
            if ($status=="updated"){

                $product = Product::where('barcode',$row[0])->first();
                //dd($row[0]);
                if ($product){

                    $regular_price  =  (double) $row[2];
                    $sale_price     = (double) $row[3];
                    if ($row[4]){

                        $difference     = $regular_price - $sale_price;

                        $start_sale = strtotime($row[4]);
                        $start_sale = date('Y-m-d',$start_sale);
                        $product->start_sale = $start_sale;
                        // dd($start_sale);
                        $end_sale=null;
                        if($row[5]!=null){
                            $end_sale= strtotime($row[5]);
                            $end_sale = date('Y-m-d',$end_sale);
                            $product->end_sale = $end_sale;
                        }

                        $product->discount_percentage = $sale_price <= 0 ? 0 : round(($difference / $regular_price) * 100,2);

                    }

                    $product->in_sale = $row[6];
                    $product->regular_price = $regular_price;
                    $product->sale_price = $sale_price;
                    $product->quantity = $row[1];
                    $product->save();

                    // Update other products that have the same barcode with the same quantity and sizes/colors
                    $products = Product::where('barcode', $product->barcode)
                        ->where('barcode', '!=', null)
                        ->where('id', '!=', $product->id)
                        ->get();

                    if ($products->isNotEmpty()) {
                        foreach ($products as $item) {
                            // Update quantity
                            $item->in_sale = $product->in_sale;
                            $item->start_sale = $product->start_sale;
                            $item->end_sale = $product->end_sale;
                            $item->discount_percentage = $product->discount_percentage;
                            $item->regular_price = $product->regular_price;
                            $item->sale_price = $product->sale_price;
                            $item->quantity = $product->quantity;
                            $item->save();
                        }
                    }

                    return $product;
                }

                return null;
            }

            else{


                if($row[15] != null){
                    $ids_cat=  explode(",",$row[15]);

                }else{
                    return null;
                }

                // dd($ids_cat);

                $regular_price  =  (double) $row[3];
                $sale_price     = (double) $row[4];
                $difference     = $regular_price - $sale_price;
                //10 11
                //12 13
                $start_sale = strtotime($row[5]);

                $start_sale = date('Y-m-d',$start_sale);
                // dd($start_sale);
                $end_sale=null;
                if($row[6]!=null){
                    $end_sale= strtotime($row[6]);

                    $end_sale = date('Y-m-d',$end_sale);
                }

                $product = Product::create([
                    'barcode'             => $row[16],
                    'name_ar'             => $row[0],
                    'name_en'             => $row[1],
                    'description_ar'      => $row[10],
                    'description_en'      => $row[11],
                    'about_brand_ar'      => $row[12],
                    'about_brand_en'      => $row[13],
                    'regular_price'       => $regular_price,
                    'sale_price'          => $sale_price,
                    'discount_percentage' => $sale_price <= 0 ? 0 : round(($difference / $regular_price) * 100,2),
                    'in_sale'             => $row[9],
                    'is_best'             => $row[7],
                    'is_recommended'      => $row[8],
                    'img'                 => $row[14],
                    'has_options'         =>  0,
                    'start_sale'          => $start_sale,
                    'end_sale'            => $end_sale,
                    'quantity'            => $row[2],
                    'alt'                 => $row[1],
                    'slug'                => str_replace(' ','-',$row[1]),
                    'is_brand'            => $student_id? 1 : 0
                ]);

                if ($student_id){
                    $product->students()->attach([$student_id]);
                }

                // dd($product);
                //start save statements
                /*if ($row[12]!= null&&$row[13]!= null) {

                    $product->statements()->insert([
                      'product_id'=>$product->id,
                      'name_ar'=>$row[12],
                      'name_en'=>$row[13]
                    ]);

                }*/
                //start save kurly
                /*if ($row[10]!= null&&$row[11]!= null) {

                    $product->kurly()->insert([
                      'product_id'=>$product->id,

                      'name_ar'=>$row[10],
                      'name_en'=>$row[11]
                    ]);

                }*/
                // dd($product->id);
                if($row[15] != null){
                    // foreach ($ids_cat as  $value) {
                    $product->categories()->attach($ids_cat);

                    // }

                }
                return $product;
            }
        }
    }
}
