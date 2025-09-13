<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Update4StudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            //
            $table->string('name_en')->after('id')->nullable();
        });

        Schema::table('notifications', function (Blueprint $table) {
            //
            $table->string('notify_url')->after('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
            $table->dropColumn('name_en');
        });

        Schema::table('notifications', function (Blueprint $table) {
            //
            $table->dropColumn('notify_url');
        });
    }
}
