<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveredByToShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_addresses', function (Blueprint $table) {
            DB::statement("ALTER TABLE `shipping_addresses` MODIFY COLUMN `title` VARCHAR(255) NULL;");
            DB::statement("ALTER TABLE `shipping_addresses` MODIFY COLUMN `name` VARCHAR(255) NULL;");
            DB::statement("ALTER TABLE `shipping_addresses` MODIFY COLUMN `phone` VARCHAR(255) NULL;");
            DB::statement("ALTER TABLE `shipping_addresses` MODIFY COLUMN `address` VARCHAR(255) NULL;");
            $table->string('delivered_by')->default('address')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipping_addresses', function (Blueprint $table) {
            $table->dropColumn('delivered_by');
        });
    }
}
