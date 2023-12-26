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
        Schema::create('esp_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('esp_name', 255);
            $table->string('esp_description')->nullable();
            $table->string('list_name', 255);
            $table->string('list_id', 255);
            $table->string('esp_str_value', 2);
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
        Schema::dropIfExists('esp_info');
    }
};
