<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $product = Product::all();

        $product->each(function ($product){

            $product->categories()->attach([random_int(5 , 14)]);
        });
    }
}
