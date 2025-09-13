<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('box_id')->references('id')->on('boxes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('shipping_address_id')->nullable()
                ->references('id')->on('shipping_addresses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->nullable()
                ->references('id')
                ->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('total_price',10,2);
            $table->decimal('shipping_price',10,2)->default(0);
            $table->string('invoice_id')->nullable();
            $table->string('invoice_link')->nullable();
            // paid, not_paid
            $table->longText('note')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('status')->default('not_paid');
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
        Schema::dropIfExists('box_orders');
    }
}
