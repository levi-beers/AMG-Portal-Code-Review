<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSourceUrlToTextInMailingResponders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mailing_responders', function (Blueprint $table) {
            $table->text('source_url')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mailing_responders', function (Blueprint $table) {
            $table->string('source_url', 255)->change();  // Assuming it was VARCHAR(255) before
        });
    }
}
