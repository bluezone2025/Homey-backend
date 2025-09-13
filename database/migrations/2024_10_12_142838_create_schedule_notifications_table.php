<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en')->nullable();
            $table->string('details_ar');
            $table->string('details_en')->nullable();
            $table->string('image')->nullable();
            $table->string('type')->nullable();
            $table->string('reference_id')->nullable();
            $table->boolean('sent')->default(false);  // Tracks if the notification was sent
            $table->timestamp('send_at')->nullable();  // For one-time notifications
            $table->boolean('is_recurring')->default(false);  // For daily notifications
            $table->time('recurring_time')->nullable();  // Time to send recurring daily
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
        Schema::dropIfExists('schedule_notifications');
    }
}
