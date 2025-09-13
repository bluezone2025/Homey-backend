<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->id();
			$table->string('name_en', 50);
			$table->string('name_ar', 50);
			$table->string('slug', 50);
			$table->integer('sort')->nullable()->default('0');
			$table->integer('parent_id')->default('0');
			$table->integer('img')->default('default.svg');
            $table->softDeletes();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('categories');
	}
}
