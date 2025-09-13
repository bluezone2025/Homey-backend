<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $cats = [

            // min cat
            [
                'name' => 'ios_version',
                'description' => 'ios version',
                'value'    => "",
            ],

            [
                'name' => 'android_version',
                'description' => 'android version',
                'value'    => "",
            ],

            [
                'name' => 'ios_url',
                'description' => 'ios url',
                'value'    => "",
            ],

            [
                'name' => 'android_url',
                'description' => 'android url',
                'value'    => "",
            ],




        ];


        Setting::insert($cats);
    }
}
