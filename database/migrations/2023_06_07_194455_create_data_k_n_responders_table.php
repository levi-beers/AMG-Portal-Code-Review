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
        Schema::create('dataknresponders', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->unique();
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip', 255)->nullable();
            $table->string('source_ip', 255)->nullable();
            $table->string('source_url', 255)->nullable();
            $table->string('source_dt', 255)->nullable();
            $table->string('year_born', 255)->nullable();
            $table->string('subid', 255)->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('phone_number', 255)->nullable();
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
        Schema::dropIfExists('dataknresponders');
    }
};
