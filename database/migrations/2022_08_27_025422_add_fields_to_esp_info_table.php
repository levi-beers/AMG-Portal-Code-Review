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
        Schema::table('esp_info', function (Blueprint $table) {
            $table->string('api_url', 255)->after('list_id');
            $table->string('api_key', 255)->before('esp_str_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('esp_info', function (Blueprint $table) {
            $table->dropColumn('api_url');
            $table->dropColumn('api_key');
        });
    }
};
