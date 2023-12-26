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
        Schema::create('ioreport', function (Blueprint $table) {
            $table->id();
            $table->date('report_date')->nullable();
            $table->integer('datasource_id')->unsigned();
            $table->foreign('datasource_id')
                ->references('id')
                ->on('datasource')
                ->onDelete('cascade');
            $table->unsignedBigInteger('datacnt');
            $table->string('reportType', 255)->nullable();
            $table->tinyInteger('alert_status')->unsigned()->default(0);
            $table->tinyInteger('alert_sent')->unsigned()->default(0);
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
        Schema::dropIfExists('ioreport');
    }
};
