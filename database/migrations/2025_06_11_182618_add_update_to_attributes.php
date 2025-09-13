<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdateToAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attributes', function (Blueprint $table) {
            //
            $table->dropColumn('frontend_type');
            $table->dropColumn('is_required');
            $table->boolean('is_paid')->default(false)->after('id'); // Determines if attribute requires paid variants
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attributes', function (Blueprint $table) {
            $table->enum('frontend_type',['select','radio','text','text_area','img']);
            $table->tinyInteger('is_required')->default(0);
            $table->dropColumn('is_paid');
        });
    }
}
