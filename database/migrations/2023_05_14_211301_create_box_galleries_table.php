<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_galleries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('box_id')
                ->references('id')->on('boxes')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('title')->nullable();
            $table->string('image');

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
        Schema::dropIfExists('box_galleries');
    }
}
