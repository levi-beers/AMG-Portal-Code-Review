<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubscriberIdToDataJets2smsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datajets2sms', function (Blueprint $table) {
            if (!Schema::hasColumn('datajets2sms', 'subscriber_id')) {
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
        Schema::table('datajets2sms', function (Blueprint $table) {
            if (Schema::hasColumn('datajets2sms', 'subscriber_id')) {
                $table->dropColumn('subscriber_id');
            }
        });
    }
}
