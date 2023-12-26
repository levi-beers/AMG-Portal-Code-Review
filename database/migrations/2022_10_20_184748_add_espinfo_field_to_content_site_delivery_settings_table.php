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
        Schema::table('content_site_delivery_settings', function (Blueprint $table) {
            $table->integer('esp_settings_id')->unsigned()->after('datasource');
            $table->foreign('esp_settings_id')
            ->references('id')
            ->on('esp_info')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_site_delivery_settings', function (Blueprint $table) {
            $table->dropColumn('esp_settings_id');
            $table->dropForeign('esp_settings_id');
        });
    }
};
