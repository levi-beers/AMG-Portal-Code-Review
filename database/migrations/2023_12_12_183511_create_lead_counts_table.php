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
        Schema::create('lead_counts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('esp_id');
            $table->unsignedBigInteger('datasource_id');
            $table->string('datasource');
            $table->string('description');
            $table->string('esp_name');
            $table->string('esp_description');
            $table->integer('lead_count');
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
        Schema::dropIfExists('lead_counts');
    }
};
