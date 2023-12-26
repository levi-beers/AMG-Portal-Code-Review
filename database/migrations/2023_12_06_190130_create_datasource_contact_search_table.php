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
        Schema::create('datasource_contact_search', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('datasource_id')->nullable();
            $table->text('name')->nullable();
            $table->integer('status')->nullable();
            $table->bigInteger('count')->nullable();
            $table->dateTime('date_from')->nullable();
            $table->dateTime('date_to')->nullable();
            $table->string('selected_combine')->nullable();
            $table->json('selected_criteria')->nullable();
            $table->json('selected_fields')->nullable();
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
        Schema::dropIfExists('datasource_contact_search');
    }
};
