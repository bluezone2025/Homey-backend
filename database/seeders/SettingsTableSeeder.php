<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Settings::create([
            'site_name_ar' => 'عباتي سكبه',
            'logo' => null,
            'site_name_en' => 'Abati Sakbah',
            'instagram' => '',
            'telegram' => '',
            'android_link' => '',
            'ios_link' => '',
            'phone' => '',
            'whatsapp' => '',
            'youtube' => '',
            'google_plus' => '',
            'email' => '',
            'twitter' => '',
            'site_des_en' => '',
            'site_des_ar' => '',
            'facebook' => '',

        ]);

    }
}
