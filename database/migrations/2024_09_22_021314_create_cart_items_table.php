<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');             // Foreign key to the products table->constrained('products');
            $table->foreignId('user_id')->nullable();   // Foreign key to the users table (nullable for guests)
            $table->string('username')->nullable();   // Foreign key to the users table (nullable for guests)
            $table->string('phone')->nullable();   // Foreign key to the users table (nullable for guests)
            $table->ipAddress('ip_address')->nullable(); // User's IP address (for guests)
            $table->integer('quantity')->default(1);    // Quantity of the product in the cart
            $table->decimal('price', 8, 2);             // Product price at the time of adding
            #$table->boolean('purchased')->default(false); // Indicates if the product was purchased
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
        Schema::dropIfExists('cart_items');
    }
}
