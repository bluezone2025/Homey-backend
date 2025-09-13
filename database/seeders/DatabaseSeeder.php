<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Statement;
use Database\Factories\ContactFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(50)->create();
//        $this->call(CategorySeeder::class);
//        Product::factory(50)->create();
//        Rating::factory(150)->create();
//        Statement::factory(200)->create();
//        $this->call(AttributeSeeder::class);
//        Option::factory(200)->create();
//        $this->call(ProductImageSeeder::class);
//        $this->call(ProductCategoriesSeeder::class);
        //$this->call(PermissionsSeeder::class);
        $this->call(PermissionsSeeder2::class);
//        $this->call(OptionSeeder::class);
//        Contact::factory(150)->create();

    }
}
