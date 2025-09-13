<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration {

	public function up()
	{
		// admins
		Schema::table('admins', function(Blueprint $table) {
			$table->foreignId('role_id')->references('id')->on('roles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		// end admins




        // statements
		Schema::table('statements', function(Blueprint $table) {
			$table->foreignId('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		// end statements


        // Kurly
		Schema::table('kurlies', function(Blueprint $table) {
			$table->foreignId('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		// end Kurly


		// options

		Schema::table('options', function(Blueprint $table) {
			$table->foreignId('attribute_id')->references('id')->on('attributes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('option_values', function(Blueprint $table) {
			$table->foreignId('option_id')->references('id')->on('options')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('option_values', function(Blueprint $table) {
			$table->foreignId('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		// end options


        //images
		Schema::table('images', function(Blueprint $table) {
			$table->foreignId('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
        // end images
        //

        //areas
		Schema::table('areas', function(Blueprint $table) {
            $table->foreignid('country_id')
                ->references('id')->on('countries')
                ->onDelete('cascade')->onUpdate('cascade');
		});
        // end areas

        //shipping ِaddresses
		Schema::table('shipping_addresses', function(Blueprint $table) {
			$table->foreignId('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('shipping_addresses', function(Blueprint $table) {
			$table->foreignId('area_id')->references('id')->on('areas')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
        // end shipping_addresses

        //orders
		Schema::table('orders', function(Blueprint $table) {
			$table->foreignId('user_id')->references('id')->on('users')
						->onDelete(null)
						->onUpdate('cascade');
		});
		Schema::table('orders', function(Blueprint $table) {
			$table->foreignId('shipping_address_id')->references('id')->on('shipping_addresses')
						->onDelete(null)
						->onUpdate('cascade');
		});
        // end orders

        //ratings
		Schema::table('ratings', function(Blueprint $table) {
			$table->foreignId('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('ratings', function(Blueprint $table) {
			$table->foreignId('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		// end ratings

        //likes
		Schema::table('likes', function(Blueprint $table) {
			$table->foreignId('product_id')->references('id')->on('products')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('likes', function(Blueprint $table) {
			$table->foreignId('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		// end likes
	}

	public function down()
	{
		Schema::table('products', function(Blueprint $table) {
			$table->dropForeign('products_category_id_foreign');
		});
		Schema::table('statements', function(Blueprint $table) {
			$table->dropForeign('statements_product_id_foreign');
		});
		Schema::table('options', function(Blueprint $table) {
			$table->dropForeign('options_product_id_foreign');
		});
		Schema::table('images', function(Blueprint $table) {
			$table->dropForeign('images_product_id_foreign');
		});
	}
}
