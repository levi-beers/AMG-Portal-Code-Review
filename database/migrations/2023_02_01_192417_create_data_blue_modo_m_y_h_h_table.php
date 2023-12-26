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
        Schema::create('databluemodomyhh', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->unique();
            $table->string('firstname', 255)->nullable();
            $table->string('lastname', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('zip', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('dob', 255)->nullable();
            $table->string('timestamp', 255)->nullable();
            $table->string('ip', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('stat', 255)->nullable();
            $table->string('newflag', 255)->nullable();
            $table->string('cleaned', 255)->nullable();
            $table->string('esp_api', 255)->nullable();
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
        Schema::dropIfExists('databluemodomyhh');
    }
};
