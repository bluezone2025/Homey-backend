<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BasicCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\BasicCategory::create([

            'name_ar'=>'جاهز',
           'name_en' =>'Ready For Sale',
            'image_url'=>'uploads/basic_categories/images//16293313503963.jpg',

        ]);

        \App\BasicCategory::create([

            'name_ar'=>'أوردر',
            'name_en' =>'Order',
            'image_url'=>'uploads/basic_categories/images//16293313845021.jpg',

        ]);
    }
}
