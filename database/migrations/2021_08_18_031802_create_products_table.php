<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->text('description_en');
            $table->text('description_ar');
            $table->boolean('appearance')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('new')->nullable();
            $table->integer('price');
            $table->integer('delivery_period')->nullable();
            $table->string('img');
            $table->string('height_img')->nullable();
            $table->unsignedBigInteger('basic_category_id');
            $table->foreign('basic_category_id')->references('id')->on('basic_categories')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

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
        Schema::dropIfExists('products');
    }
}
