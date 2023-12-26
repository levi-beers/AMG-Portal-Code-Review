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
        Schema::table('content_sites', function (Blueprint $table) {
            $table->string('site_name', 255);
            $table->integer('vertical_id');
            $table->string('app_password', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_sites', function (Blueprint $table) {
            $table->dropColumn('site_name');
            $table->dropColumn('vertical_id');
            $table->dropColumn('app_password');
        });
    }
};
