<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('user_id')->unique();
            $table->string('mobile_phone')->unique();
            $table->string('type')->nullable();
            $table->string('account')->nullable();
            $table->string('country_code')->nullable();
            $table->string('dailing_code')->nullable();
            $table->string('currency');
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('web_token')->nullable();
            $table->text('fcm_token')->nullable();
            $table->integer('status')->default('0');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
