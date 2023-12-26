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
        Schema::create('content_sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name', 255);
            $table->string('domain');
            $table->string('throttle');
            $table->string('time_value');
            $table->string('app_password', 255);
            $table->unsignedInteger('vertical_id')->nullable();
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
        Schema::dropIfExists('content_sites');
    }
};
