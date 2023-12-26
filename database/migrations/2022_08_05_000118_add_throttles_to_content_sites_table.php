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
            $table->integer('historic_throttle')->after('time_value');
            $table->string('historic_time_value', 191)->after('historic_throttle');
            $table->string('delivery_domain', 191)->after('domain');
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
            $table->dropColumn('historic_throttle');
            $table->dropColumn('historic_time_value');
            $table->dropColumn('delivery_domain');
        });
    }
};
