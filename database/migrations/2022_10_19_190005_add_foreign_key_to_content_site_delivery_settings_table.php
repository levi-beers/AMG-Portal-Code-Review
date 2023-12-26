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
            $table->foreign('datasource')
                  ->references('id')
                  ->on('datasource')
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
            $table->dropForeign('datasource');
        });
    }
};
