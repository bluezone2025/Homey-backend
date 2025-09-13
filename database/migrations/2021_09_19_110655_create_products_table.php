<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->id();
			$table->string('name_ar', 50);
			$table->string('name_en', 50);
			$table->string('slug', 50);
			$table->text('description_ar');
			$table->text('description_en');
			$table->text('about_brand_ar');
			$table->text('about_brand_en');
			$table->decimal('regular_price');
			$table->decimal('sale_price')->nullable();
			$table->decimal('discount_percentage')->nullable();
			$table->tinyInteger('in_sale')->nullable()->default('0');
			$table->string('img', 100);
			$table->string('alt' , 100)->nullable();
			$table->integer('sort')->nullable()->default('0');
			$table->boolean('is_recommended')->nullable()->default('0');
			$table->boolean('is_best')->nullable()->default('0');
			$table->boolean('has_options')->nullable()->default('0');
			$table->date('start_sale')->nullable();
			$table->date('end_sale')->nullable();
			$table->integer('quantity')->nullable()->default('0');
			$table->integer('ratings')->default('0');
			$table->integer('likes_count')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('products');
	}
}
