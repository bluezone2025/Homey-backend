<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $attrs = [

            [
                'name_ar' => 'المقاس',
                'name_en' => 'size',
                'frontend_type' => 'select',
                'is_required' => 1,
            ],

            [
                'name_ar' => 'اللون',
                'name_en' => 'color',
                'frontend_type' => 'select',
                'is_required' => 1,
            ]
        ];

        Attribute::insert($attrs);
    }
}
