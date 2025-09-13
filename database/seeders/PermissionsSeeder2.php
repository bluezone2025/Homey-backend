<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[

            ['name' => 'box.index'],
            ['name' => 'box.create'],
            ['name' => 'box.update'],
            ['name' => 'box.destroy'],
            ['name' => 'box.trash'],
            ['name' => 'box.restore'],
            ['name' => 'box.finalDelete'],

            ['name' => 'box_order.index'],
            ['name' => 'box_order.update'],
            ['name' => 'box_order.show'],


        ];

        Permission::insert(
            $data
        );
    }
}
