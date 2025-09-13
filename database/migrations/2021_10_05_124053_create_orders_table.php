<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('note')->nullable();
            $table->integer('products_count');
            $table->double('order_price');
            $table->double('discount')->default(0);
            $table->double('shipping_price')->default(0);
            $table->double('total_price');
            $table->enum('status'  ,['pending' , 'accept' , 'reject' , 'done' , 'shipping'])->default('pending');
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
        Schema::dropIfExists('orders');
    }
}
