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
            $table->dropUnique('PrimaryDomain');
            $table->unique([
                'content_site_id',
                'domain'
            ], 'PrimaryDomainKey');
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
            $table->dropUnique('PrimaryDomainKey');
            $table->unique([
                'domain'
            ], 'PrimaryDomain');
         });
    }
};
