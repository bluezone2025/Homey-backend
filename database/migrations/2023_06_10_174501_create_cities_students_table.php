<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities_students', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar' , 50);
            $table->string('name_en' , 50);
            $table->string('slug' , 50);
            $table->double('shipping_price' )->default(0);
            $table->double('shipping_time' )->default(0);
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries_students');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete()->cascadeOnUpdate();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities_students');
    }
}
