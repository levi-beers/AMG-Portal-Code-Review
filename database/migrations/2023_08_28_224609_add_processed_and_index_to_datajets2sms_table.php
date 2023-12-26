<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProcessedAndIndexToDatajets2smsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datajets2sms', function (Blueprint $table) {
            // Add 'processed' column with default value 0
            $table->integer('processed')->default(0);

            // Add composite index
            $table->index(['processed', 'subscriber_id'], 'idx_processed_subscriber_sms');
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
            // Drop composite index first
            $table->dropIndex('idx_processed_subscriber_sms');

            // Then drop the 'processed' column
            $table->dropColumn('processed');
        });
    }
}
