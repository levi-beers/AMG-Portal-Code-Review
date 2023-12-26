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
        Schema::create('stats_ongage', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->integer('mailing_id')->unique();
            $table->string('mailing_name', 255)->nullable();
            $table->string('mailing_domain', 32)->required();
            $table->decimal('gsr', 5, 2)->nullable();
            $table->integer('sent')->nullable();
            $table->integer('success')->nullable();
            $table->integer('failed')->nullable();
            $table->integer('opens')->nullable();
            $table->integer('unsubscribes')->nullable();
            $table->integer('complaints')->nullable();
            $table->integer('clicks')->nullable();
            $table->decimal('opens_percent', 5, 2)->nullable();
            $table->decimal('clicks_percent', 5, 2)->nullable();
            $table->decimal('unsubscribes_percent', 10, 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats_ongage');
    }
};
