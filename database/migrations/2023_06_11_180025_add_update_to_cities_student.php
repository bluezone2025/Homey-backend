<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdateToCitiesStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities_students', function (Blueprint $table) {
            //
            $table->dropColumn('name_ar');
            $table->dropColumn('name_en');
            $table->dropColumn('slug');
            $table->dropForeign('cities_students_country_id_foreign');
            $table->dropColumn('country_id');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cities_students', function (Blueprint $table) {
            //
        });
    }
}
