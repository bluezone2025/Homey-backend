<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cats = [

            // min cat
            [
                'name_ar' => 'لوازم مدرسية للأطفال',
                'name_en' => \Str::slug('لوازم مدرسية للأطفال'),
                'slug'    => \Str::slug('لوازم مدرسية للأطفال'),
                'parent_id' => 0,
                'sort'    => 100,
            ],

            // min cat
            [
                'name_ar' => 'إلكترونيات',
                'name_en' => \Str::slug('إلكترونيات'),
                'slug'    => \Str::slug('إلكترونيات'),
                'parent_id' => 0,
                'sort'    => 99,
            ],

            // min cat
            [
                'name_ar' => 'ساعات',
                'name_en' => \Str::slug('ساعات'),
                'slug'    => \Str::slug('ساعات'),
                'parent_id' => 0,
                'sort'    => 98,
            ],


            // min cat
            [
                'name_ar' => 'سماعات',
                'name_en' => \Str::slug('سماعات'),
                'slug'    => \Str::slug('سماعات'),
                'parent_id' => 0,
                'sort'    => 97,
            ],

            // cat > cat
            [
                'name_ar' => 'المنتجات المكتبية',
                'name_en' => \Str::slug('المنتجات المكتبية'),
                'slug'    => \Str::slug('المنتجات المكتبية'),
                'parent_id' =>1 ,
                'sort'    => 100,
            ],

            // cat > cat
            [
                'name_ar' => 'ملابس',
                'name_en' => \Str::slug('ملابس'),
                'slug'    => \Str::slug('ملابس'),
                'parent_id' =>1 ,
                'sort'    => 99,
            ],

            // cat > cat
            [
                'name_ar' => 'كتب',
                'name_en' => \Str::slug('كتب'),
                'slug'    => \Str::slug('كتب'),
                'parent_id' =>1 ,
                'sort'    => 98,
            ],

            // cat > cat > cat
            [
                'name_ar' => 'شنط مدرسية',
                'name_en' => \Str::slug('شنط مدرسية'),
                'slug'    => \Str::slug('شنط مدرسية'),
                'parent_id' => 5 ,
                'sort'    => 100,
            ],

            // cat > cat > cat
            [
                'name_ar' => 'مقلمة',
                'name_en' => \Str::slug('مقلمة'),
                'slug'    => \Str::slug('مقلمة'),
                'parent_id' => 5 ,
                'sort'    => 99,
            ],

            // cat > cat > cat
            [
                'name_ar' => 'ادوات هندسية',
                'name_en' => \Str::slug('ادوات هندسية'),
                'slug'    => \Str::slug('ادوات هندسية'),
                'parent_id' => 5 ,
                'sort'    => 98,
            ],


            // cat > cat > cat
            [
                'name_ar' => 'اقلام',
                'name_en' => \Str::slug('اقلام'),
                'slug'    => \Str::slug('اقلام'),
                'parent_id' => 5 ,
                'sort'    => 97,
            ],

            // cat > cat > cat
            [
                'name_ar' => 'ادوات تلوين',
                'name_en' => \Str::slug('ادوات تلوين'),
                'slug'    => \Str::slug('ادوات تلوين'),
                'parent_id' => 5 ,
                'sort'    => 96,
            ],

            // cat > cat > cat
            [
                'name_ar' => 'ملابس بنات',
                'name_en' => \Str::slug('ملابس بنات'),
                'slug'    => \Str::slug('ملابس بنات'),
                'parent_id' => 6 ,
                'sort'    => 95,
            ],

            // cat > cat > cat
            [
                'name_ar' => 'ملابس اولاد',
                'name_en' => \Str::slug('ملابس اولاد'),
                'slug'    => \Str::slug('ملابس اولاد'),
                'parent_id' => 6 ,
                'sort'    => 94,
            ],


        ];


        Category::insert($cats);
    }
}
