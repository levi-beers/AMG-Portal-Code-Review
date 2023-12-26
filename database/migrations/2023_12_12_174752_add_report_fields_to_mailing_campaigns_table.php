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
        Schema::table('mailing_campaigns', function (Blueprint $table) {
            $table->string('report_generated')->nullable();
            $table->string('report_processed')->nullable();
            $table->string('report_deleted')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mailing_campaigns', function (Blueprint $table) {
            $table->dropColumn(['report_generated', 'report_processed', 'report_deleted']);
        });
    }

};
