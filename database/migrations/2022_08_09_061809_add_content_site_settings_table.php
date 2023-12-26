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
        Schema::create('content_site_delivery_settings', function (Blueprint $table) {
            $table->integer('content_site_id')->unsigned();
            $table->string('delivery_domain', 191);
            $table->string('throttle');
            $table->string('time_value');
            $table->integer('historic_throttle');
            $table->string('historic_time_value', 191);
            $table->timestamps();

            $table->foreign('content_site_id')
                  ->references('id')
                  ->on('content_sites')
                  ->onDelete('cascade');

                  $table->unique([
                    'content_site_id',
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
        Schema::dropIfExists('content_site_delivery_settings');
    }
};
