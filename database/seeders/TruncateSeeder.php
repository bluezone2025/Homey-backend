<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\BoxOrder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;

class TruncateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*echo "start truncate\n";
        Schema::disableForeignKeyConstraints();
        \DB::table('product_order')->truncate();
        \DB::table('orders')->truncate();
        \DB::table('box_orders')->truncate();
        /*\DB::table('shipping_addresses')->truncate();
        \DB::table('show_notifications')->truncate();*/
        //\DB::table('notifications')->whereIn('type',['Order','Box'])->delete();
        /*\DB::table('user_search')->truncate();
        \DB::table('fcm_tokens')->truncate();
        \DB::table('likes')->truncate();
        \DB::table('ratings')->truncate();
        \DB::table('wish_list')->truncate();
        \DB::table('users')->truncate();*/
        /*Schema::enableForeignKeyConstraints();
        echo "end truncate\n";*/

        $box_orders = BoxOrder::where('status','paid')->pluck('box_id')->toArray();
        $boxes = Box::whereIn('id',$box_orders)->get();
        foreach ($boxes as $box){
            $box->quantity = 0;
            $box->save();
        }
    }
}
