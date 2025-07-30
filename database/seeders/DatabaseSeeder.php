<?php
namespace Database\Seeders;
use App\Models\Permission;
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
//        $this->call(RolesTableSeeder::class);
//        $this->call(UsersTableSeeder::class);
//        $this->call(PagesTableSeeder::class);
//        $this->call(SettingsTableSeeder::class);
//        $this->call(BasicCategoryTableSeeder::class);
//        $this->call(CategoryTableSeeder::class);
//        $this->call(SizeTableSeeder::class);
//        $this->call(HeightTableSeeder::class);


        $this->call(PermissionsTableSeeder::class);
        $this->call(DeliveryTimeNoteSeeder::class);


    }
}
