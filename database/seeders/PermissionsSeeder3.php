<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class PermissionsSeeder3 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data =[

            ['name' => 'wallets.index'],
            ['name' => 'wallets.create'],
            ['name' => 'wallets.update'],
            ['name' => 'wallets.destroy'],



        ];

        Permission::insert(
            $data
        );


        $data2 = [
            ['role_id'=>1, 'permission_id'=>348],
            ['role_id'=>1, 'permission_id'=>349],
            ['role_id'=>1, 'permission_id'=>350],
            ['role_id'=>1, 'permission_id'=>351],
        ];

        \DB::table('role_permission')->insert($data2);

        /*Setting::create([
            'name'   => 'min_order_price',
            'value' => 5,
            'description'   => 'الحد الادني للطلب',
        ]);*/
    }
}
