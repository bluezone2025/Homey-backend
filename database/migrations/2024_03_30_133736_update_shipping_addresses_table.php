<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_addresses', function (Blueprint $table) {
            //
            $table->string('region')->nullable();
            $table->string('piece')->nullable();
            $table->string('avenue')->nullable();
            $table->string('street')->nullable();
            $table->string('flat_number')->nullable();
            $table->string('floor')->nullable();
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
            //
            $table->dropColumn('region');
            $table->dropColumn('piece');
            $table->dropColumn('avenue');
            $table->dropColumn('street');
            $table->dropColumn('flat_number');
            $table->dropColumn('floor');
        });
    }
}
