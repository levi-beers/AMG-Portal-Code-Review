<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubscriberIdToJets2emailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datajets2email', function (Blueprint $table) {
            if (!Schema::hasColumn('datajets2email', 'subscriber_id')) {
                $table->string('subscriber_id')->nullable()->first();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datajets2email', function (Blueprint $table) {
            if (Schema::hasColumn('datajets2email', 'subscriber_id')) {
                $table->dropColumn('subscriber_id');
            }
        });
    }
}
