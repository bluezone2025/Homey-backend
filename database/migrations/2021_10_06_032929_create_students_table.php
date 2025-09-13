<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 50);
            $table->string('email' , 100)->unique();
            $table->string('phone' , 20);
            $table->string('date' , 50);
            $table->string('university' , 100);
            $table->string('university_id', 50)->nullable();
            $table->string('major' , 50);
            $table->boolean('is_active')->default(0);
            $table->string('img' , 50)->default('img_default.jpg');
            $table->string('cover' , 50)->default('cover_default.jpg');
            $table->integer('limit_products')->default(50);
            $table->integer('points')->default(0);
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('students');
    }
}
