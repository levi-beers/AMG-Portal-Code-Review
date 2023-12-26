<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('contentsite', 255)->nullable();
            $table->string('email', 255)->unique();
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->date('dob')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('region', 255)->nullable();
            $table->string('zip', 5)->nullable();
            $table->string('phone_mobile', 255)->nullable();
            $table->string('email_signup_ip', 255)->nullable();
            $table->string('email_signup_url', 255)->nullable();
            $table->string('gender', 1)->nullable();
            $table->timestamp('timestamp')->nullable();
            $table->date('insertdate')->nullable();
            $table->string('inserthour', 2)->nullable();
            $table->string('insertminute', 2)->nullable();
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
        Schema::dropIfExists('leads');
    }
};
