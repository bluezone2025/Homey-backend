<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Category::create([
            'name_ar' =>'رئيسي',
            'name_en' =>'Basic',
            'basic_category_id' =>1,
        ]);

        \App\Category::create([
            'name_ar' =>'عبايات منقبات',
            'name_en' =>'Veiled Abayas',
            'basic_category_id' =>1,
        ]);

        \App\Category::create([
            'name_ar' =>'عبايات مناسبات',
            'name_en' =>'Event Abayas',
            'basic_category_id' =>1,
        ]);

        \App\Category::create([
            'name_ar' =>'عبايات عملي',
            'name_en' =>'Practical Abayas',
            'basic_category_id' =>1,
        ]);




        \App\Category::create([
            'name_ar' =>'عبايات كاجوال',
            'name_en' =>'Casual Abayas',
            'basic_category_id' =>1,
        ]);


        \App\Category::create([
            'name_ar' =>'عبايات سوداء',
            'name_en' =>'Black Abayas',
            'basic_category_id' =>1,
        ]);

        \App\Category::create([
            'name_ar' =>'دانا لاين',
            'name_en' =>'Dana Line',
            'basic_category_id' =>1,
        ]);


        \App\Category::create([
            'name_ar' =>'عبي ملونه',
            'name_en' =>'Colored Abayas',
            'basic_category_id' =>1,
        ]);



        \App\Category::create([
            'name_ar' =>'رئيسي',
            'name_en' =>'Basic',
            'basic_category_id' =>2,
        ]);

        \App\Category::create([
            'name_ar' =>'عبايات منقبات',
            'name_en' =>'Veiled Abayas',
            'basic_category_id' =>2,
        ]);



        \App\Category::create([
            'name_ar' =>'عبايات مناسبات',
            'name_en' =>'Event Abayas',
            'basic_category_id' =>2,
        ]);

        \App\Category::create([
            'name_ar' =>'عبايات عملي',
            'name_en' =>'Practical Abayas',
            'basic_category_id' =>2,
        ]);



        \App\Category::create([
            'name_ar' =>'عبايات كاجوال',
            'name_en' =>'Casual Abayas',
            'basic_category_id' =>2,
        ]);



        \App\Category::create([
            'name_ar' =>'عبايات سوداء',
            'name_en' =>'Black Abayas',
            'basic_category_id' =>2,
        ]);

        \App\Category::create([
            'name_ar' =>'دانا لاين',
            'name_en' =>'Dana Line',
            'basic_category_id' =>2,
        ]);


        \App\Category::create([
            'name_ar' =>'عبي ملونه',
            'name_en' =>'Colored Abayas',
            'basic_category_id' =>2,
        ]);

    }
}
