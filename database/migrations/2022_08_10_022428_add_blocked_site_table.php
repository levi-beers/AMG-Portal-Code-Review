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
        Schema::create('blocked_domains', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_site_id')->unsigned();
            $table->string('domain', 255);
            $table->timestamps();

            $table->foreign('content_site_id')
                  ->references('id')
                  ->on('content_sites')
                  ->onDelete('cascade');

                  $table->unique([
                    'domain'
                ], 'PrimaryDomain');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocked_domains');
    }
};
