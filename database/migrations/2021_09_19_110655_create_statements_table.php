<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatementsTable extends Migration {

	public function up()
	{
		Schema::create('statements', function(Blueprint $table) {
			$table->id();
			$table->string('name_ar', 50);
			$table->string('name_en', 50);
			$table->text('value_en');
			$table->text('value_ar');
            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('statements');
	}
}
