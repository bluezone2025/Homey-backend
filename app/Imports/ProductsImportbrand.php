<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImportbrand implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      if($row[0] == null){
        return null;
      }else{
      if($row[19] != null){
        $ids_cat=  explode(",",$row[19]);

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

          'name_ar'             => $row[0],
          'name_en'             => $row[1],
          'description_ar'      => $row[15],
          'description_en'      => $row[16],
          'about_brand_ar'      => $row[17],
          'about_brand_en'      => $row[18],
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
          'is_brand'            =>1

        ]);

        // dd($product);
        //start save statements
        if ($row[12]!= null&&$row[13]!= null) {

            $product->statements()->insert([
              'product_id'=>$product->id,
              'name_ar'=>$row[12],
              'name_en'=>$row[13]
            ]);

        }
        //start save kurly
        if ($row[10]!= null&&$row[11]!= null) {

            $product->kurly()->insert([
              'product_id'=>$product->id,

              'name_ar'=>$row[10],
              'name_en'=>$row[11]
            ]);

        }
          $product->students()->attach([auth('student')->id()]);
        // dd($product->id);
        if($row[19] != null){
          // foreach ($ids_cat as  $value) {
            $product->categories()->attach($ids_cat);

          // }

        }
        return $product;
      }
    }
}
