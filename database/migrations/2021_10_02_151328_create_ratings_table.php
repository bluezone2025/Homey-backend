<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatingsTable extends Migration {

    public function up()
    {
        Schema::create('ratings', function(Blueprint $table) {
            $table->id();
            $table->integer('rating');
            $table->string('comment' , 255)->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('ratings');
    }
}
