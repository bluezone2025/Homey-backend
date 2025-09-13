<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE sliders MODIFY link TEXT NULL');

        Schema::table('sliders', function (Blueprint $table) {

            $table->string('slider_for')->nullable()->after('type');
            $table->string('slider_reference')->nullable()->after('slider_for');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            //
            $table->dropColumn('slider_for');
            $table->dropColumn('slider_reference');
        });
    }
}
