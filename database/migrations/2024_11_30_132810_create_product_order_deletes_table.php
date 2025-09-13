<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrderDeletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_order_deletes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id');
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('sale_price',10,2);
            $table->decimal('regular_price',10,2);
            $table->longText('attributes')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->integer(' points')->default(0)->nullable();
            $table->decimal('end_price',10,2)->nullable();
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
        Schema::dropIfExists('product_order_deletes');
    }
}
