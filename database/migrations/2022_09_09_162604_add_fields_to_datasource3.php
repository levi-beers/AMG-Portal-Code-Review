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
        Schema::table('datasource3', function (Blueprint $table) {
            $table->string('stat', 10)->nullable();
            $table->string('newflag', 10)->nullable();
            $table->string('cleaned', 10)->nullable();
            $table->string('esp_api', 10)->nullable();
            $table->string('esp_str', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datasource3', function (Blueprint $table) {
            $table->dropColumn('stat');
            $table->dropColumn('newflag');
            $table->dropColumn('cleaned');
            $table->dropColumn('esp_api');
            $table->dropColumn('esp_str');
        });
    }
};
