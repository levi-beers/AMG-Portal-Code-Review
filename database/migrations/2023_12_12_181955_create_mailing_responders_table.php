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
        Schema::create('mailing_responders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('datasource_id')->nullable();
            $table->string('datasource_email_id')->nullable();
            $table->string('email')->unique();
            $table->date('join_date');
            $table->string('list_status');
            $table->integer('sent');
            $table->integer('opens')->nullable();
            $table->integer('clicks')->nullable();
            $table->integer('avg_open_time')->nullable();
            $table->dateTime('last_open_date')->nullable();
            $table->integer('avg_click_time')->nullable();
            $table->dateTime('last_click_date')->nullable();
            $table->unsignedBigInteger('segment_id')->nullable();
            $table->string('source_ip')->nullable();
            $table->string('source_url')->nullable();
            $table->json('mailing_ids')->nullable();
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
        Schema::dropIfExists('mailing_responders');
    }
};
