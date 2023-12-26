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
        Schema::connection('suppression')->create('suppression_lists', function (Blueprint $table) {
            $table->id();
            $table->string('advertiser', 255)->nullable();
            $table->text('offer_name')->nullable(); // Changed to text to allow more than 255 characters
            $table->unsignedBigInteger('total_records')->nullable(); // Changed to unsignedBigInteger for numbers
            $table->string('status')->nullable(); // Added status column with default value
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
        Schema::dropIfExists('suppression_lists');
    }
};
