<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->longText('logo')->nullable();
            $table->longText('facebook')->nullable();
            $table->longText('site_name_ar')->nullable();
            $table->longText('site_name_en')->nullable();
            $table->longText('site_des_ar')->nullable();
            $table->longText('site_des_en')->nullable();
            $table->longText('email')->nullable();
            $table->longText('twitter')->nullable();
            $table->longText('google_plus')->nullable();
            $table->longText('youtube')->nullable();
            $table->longText('whatsapp')->nullable();
            $table->longText('ios_link')->nullable();
            $table->longText('android_link')->nullable();
            $table->longText('instagram')->nullable();
            $table->longText('telegram')->nullable();
            $table->longText('phone')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
