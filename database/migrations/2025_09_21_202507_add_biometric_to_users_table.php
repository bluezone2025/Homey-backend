<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBiometricToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('device_id')->nullable()->index();
            $table->text('public_key')->nullable(); // PEM or base64 public key
            $table->timestamp('last_biometric_login_at')->nullable();
        });

        // table لتخزين ال challenges مؤقتًا (اختياري لكن مفيد)
        Schema::create('biometric_challenges', function (Blueprint $table) {
            $table->id();
            $table->string('device_id');
            $table->string('nonce'); // نصية
            $table->timestamp('expires_at');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['device_id','public_key','last_biometric_login_at']);
        });

        Schema::dropIfExists('biometric_challenges');
    }
}
