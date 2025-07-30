<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\User;
use Laratrust\Models\LaratrustPermission;
use Laratrust\Models\LaratrustRole;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


//        LaratrustPermission::create(['name' => 'manage-roles','display_name'=> "Manage Roles"]);
//        LaratrustPermission::create(['name' => 'manage-admins' ,'display_name'=> "Manage Admins"]);
//        LaratrustPermission::create(['name' => 'manage-banners','display_name'=> "Manage Banners"]);
//        LaratrustPermission::create(['name' => 'manage-pages','display_name'=> "Manage Pages"]);
//        LaratrustPermission::create(['name' => 'manage-basic-categories','display_name'=> "Manage Parent Categories"]);
//        LaratrustPermission::create(['name' => 'manage-sub-categories','display_name'=> "Manage Sub Categories"]);
//        LaratrustPermission::create(['name' => 'manage-products' ,'display_name'=> "Manage Products"]);
//        LaratrustPermission::create(['name' => 'manage-today-orders','display_name'=> "Manage Today Orders"]);
//        LaratrustPermission::create(['name' => 'manage-paid-orders','display_name'=> "Manage Paid Orders"]);
//        LaratrustPermission::create(['name' => 'manage-not-paid-orders','display_name'=> "Manage Not Paid Order"]);
//        LaratrustPermission::create(['name' => 'manage-cash-orders' ,'display_name'=> "Manage Cash Order"]);
//        LaratrustPermission::create(['name' => 'manage-coupons' ,'display_name'=> "Manage Coupons"]);
//        LaratrustPermission::create(['name' => 'manage-posts' ,'display_name'=> "Manage Posts"]);
//        LaratrustPermission::create(['name' => 'manage-news' ,'display_name'=> "Manage news"]);
//        LaratrustPermission::create(['name' => 'manage-users' ,'display_name'=> "Manage Users"]);
//        LaratrustPermission::create(['name' => 'manage-countries' ,'display_name'=> "Manage Countries"]);
//        LaratrustPermission::create(['name' => 'manage-currencies' ,'display_name'=> "Manage Currencies"]);
//        LaratrustPermission::create(['name' => 'manage-settings' ,'display_name'=> "Manage Settings"]);
//        LaratrustPermission::create(['name' => 'manage-contact-us' ,'display_name'=> "Manage Contact Us"]);

        LaratrustPermission::create(['name' => 'manage-preparations' ,'display_name'=> "Manage Preparations"]);
        LaratrustPermission::create(['name' => 'manage-delivery-times' ,'display_name'=> "Manage Delivery Times"]);

        LaratrustPermission::create(['name' => 'manage-notifications' ,'display_name'=> "Manage Notifications"]);

        #$user->attachRole('admin');

        $role = LaratrustRole::where('name', 'admin')->firstOrFail();

        $role->attachPermissions(
            [
//                'manage-admins','manage-banners','manage-pages','manage-basic-categories',
//                'manage-sub-categories','manage-products','manage-paid-orders','manage-not-paid-orders',
//                'manage-cash-orders','manage-coupons','manage-posts','manage-news','manage-users',
//                'manage-countries','manage-currencies','manage-settings','manage-contact-us','manage-roles'
            'manage-preparations',
            'manage-delivery-times',
                'manage-notifications',
            ]);

    }
}
