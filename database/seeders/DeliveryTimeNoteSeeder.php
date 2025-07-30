<?php

namespace Database\Seeders;

use App\Models\DeliveryTimeNote;
use Illuminate\Database\Seeder;

class DeliveryTimeNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeliveryTimeNote::create([
            'note' =>'التوصيل من 10 صباحا الى 10 مساءا',
        ]);
    }
}
