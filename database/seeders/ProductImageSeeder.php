<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for ($i =0  ; $i <= 200 ; $i++){

            Product::inRandomOrder()->first()->images()->create([

                'src' => 'test.jpg'

            ]);
        }
    }
}
