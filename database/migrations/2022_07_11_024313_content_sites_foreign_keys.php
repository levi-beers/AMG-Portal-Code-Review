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
            $table->foreign('vertical_id')
                ->references('id')
                ->on('content_verticals')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (DB::getDriverName() != 'sqlite') {
            Schema::table('content_sites', function (Blueprint $table) {
                $table->dropForeign('content_sites_vertical_id_foreign');
            });
        }
    }
};
