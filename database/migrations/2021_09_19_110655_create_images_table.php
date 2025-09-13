<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	public function up()
	{
		Schema::create('images', function(Blueprint $table) {
			$table->id();
			$table->string('src', 100);
		});
	}

	public function down()
	{
		Schema::drop('images');
	}
}
