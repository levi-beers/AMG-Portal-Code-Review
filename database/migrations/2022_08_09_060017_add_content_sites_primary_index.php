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
            $table->unique([
                'domain',
                'delivery_domain'
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
        Schema::table('content_sites', function (Blueprint $table) {
            $table->dropUnique('PrimaryDomainKey');
        });
        
    }
};
