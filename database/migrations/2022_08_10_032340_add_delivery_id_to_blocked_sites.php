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
        Schema::table('blocked_domains', function (Blueprint $table) {
                $table->integer('delivery_id')->unsigned()->after('content_site_id');
                $table->foreign('delivery_id')
                ->references('id')
                ->on('content_site_delivery_settings')
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
        Schema::table('blocked_domains', function (Blueprint $table) {
            $table->dropColumn('delivery_id');
        });
    }
};
