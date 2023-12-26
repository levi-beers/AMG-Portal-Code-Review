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
        Schema::create('datar1dmulti', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->unique();
            $table->string('fname', 255)->nullable();
            $table->string('lname', 255)->nullable();
            $table->string('dob', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('ip', 255)->nullable();
            $table->string('datestamp', 255)->nullable();
            $table->string('leadid', 255)->nullable();
            $table->string('stat', 10)->nullable();
            $table->string('newflag', 10)->nullable();
            $table->string('cleaned', 10)->nullable();
            $table->string('esp_api', 10)->nullable();
            $table->string('esp_str', 255)->nullable();
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
        Schema::dropIfExists('datar1dmulti');
    }
};
