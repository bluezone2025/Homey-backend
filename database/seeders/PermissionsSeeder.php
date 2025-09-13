<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[

            ['name' => 'section.index'],
            ['name' => 'section.create'],
            ['name' => 'section.update'],
            ['name' => 'section.destroy'],
            ['name' => 'section.trash'],
            ['name' => 'section.restore'],
            ['name' => 'section.finalDelete'],

            ['name' => 'category.index'],
            ['name' => 'category.create'],
            ['name' => 'category.update'],
            ['name' => 'category.destroy'],
            ['name' => 'category.trash'],
            ['name' => 'category.restore'],
            ['name' => 'category.finalDelete'],

            ['name' => 'product.index'],
            ['name' => 'product.create'],
            ['name' => 'product.update'],
            ['name' => 'product.destroy'],
            ['name' => 'product.trash'],
            ['name' => 'product.restore'],
            ['name' => 'product.finalDelete'],

            ['name' => 'attribute.index'],
            ['name' => 'attribute.create'],
            ['name' => 'attribute.update'],
            ['name' => 'attribute.show'],
            ['name' => 'attribute.destroy'],
            ['name' => 'attribute.trash'],
            ['name' => 'attribute.restore'],
            ['name' => 'attribute.finalDelete'],

            ['name' => 'option.index'],
            ['name' => 'option.create'],
            ['name' => 'option.update'],
            ['name' => 'option.destroy'],
            ['name' => 'option.trash'],
            ['name' => 'option.restore'],
            ['name' => 'option.finalDelete'],


            ['name' => 'rating.index'],
            ['name' => 'rating.active'],
            ['name' => 'rating.pending'],
            ['name' => 'rating.accept'],
            ['name' => 'rating.reject'],


            ['name' => 'admin.index'],
            ['name' => 'admin.create'],
            ['name' => 'admin.update'],
            ['name' => 'admin.destroy'],
            ['name' => 'admin.trash'],
            ['name' => 'admin.restore'],
            ['name' => 'admin.finalDelete'],

            ['name' => 'role.index'],
            ['name' => 'role.create'],
            ['name' => 'role.update'],
            ['name' => 'role.destroy'],
            ['name' => 'role.trash'],
            ['name' => 'role.restore'],
            ['name' => 'role.finalDelete'],
            ['name' => 'role.permission'],

            ['name' => 'user.index'],
            ['name' => 'user.create'],
            ['name' => 'user.update'],
            ['name' => 'user.destroy'],
            ['name' => 'user.trash'],
            ['name' => 'user.restore'],
            ['name' => 'user.finalDelete'],

            ['name' => 'student.index'],
            ['name' => 'student.create'],
            ['name' => 'student.update'],
            ['name' => 'student.updatePoints'],
            ['name' => 'student.destroy'],
            ['name' => 'student.trash'],
            ['name' => 'student.restore'],
            ['name' => 'student.finalDelete'],

            ['name' => 'country.index'],
            ['name' => 'country.create'],
            ['name' => 'country.update'],
            ['name' => 'country.destroy'],
            ['name' => 'country.trash'],
            ['name' => 'country.restore'],
            ['name' => 'country.finalDelete'],

            ['name' => 'area.index'],
            ['name' => 'area.create'],
            ['name' => 'area.update'],
            ['name' => 'area.destroy'],
            ['name' => 'area.trash'],
            ['name' => 'area.restore'],
            ['name' => 'area.finalDelete'],


            ['name' => 'order.index'],
            ['name' => 'order.update'],
            ['name' => 'order.show'],

            ['name' => 'coupon.index'],
            ['name' => 'coupon.update'],
            ['name' => 'coupon.show'],

            ['name' => 'contact.index'],
            ['name' => 'contact.destroy'],

            ['name' => 'slider.index'],
            ['name' => 'slider.create'],
            ['name' => 'slider.update'],
            ['name' => 'slider.destroy'],

            ['name' => 'ad.index'],
            ['name' => 'ad.create'],
            ['name' => 'ad.update'],
            ['name' => 'ad.destroy'],


            ['name' => 'icon.index'],
            ['name' => 'icon.create'],
            ['name' => 'icon.update'],
            ['name' => 'icon.destroy'],

            ['name' => 'info.index'],
            ['name' => 'info.create'],
            ['name' => 'info.update'],
            ['name' => 'info.destroy'],

            ['name' => 'info.index'],
            ['name' => 'info.create'],
            ['name' => 'info.update'],
            ['name' => 'info.destroy'],

            ['name' => 'setting.index'],
            ['name' => 'setting.update'],


        ];

        Permission::insert(
            $data
        );
    }
}
