<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\OptionValue;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0 ; $i < 200 ; $i++){

            $attribute = Attribute::inRandomOrder()->first();

            $options = $attribute->options;

            $product = Product::inRandomOrder()->first();

            $product->attributes()->attach([$attribute->id]);

            foreach ($options as $option){

                $array = [
                    'quantity' => random_int(1 , 50),
                    'regular_price' => random_int(300 , 500),
                    'option_id' => $option->id,
                    'product_id' => $product->id,
                ];

                OptionValue::create($array);
            }

        }
    }
}
