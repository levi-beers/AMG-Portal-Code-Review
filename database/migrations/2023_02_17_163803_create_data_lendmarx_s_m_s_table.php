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
        Schema::create('datalendmarxsms', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip', 255)->nullable();
            $table->string('email', 255)->unique();
            $table->string('dob', 255)->nullable();
            $table->string('ip_address', 255)->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('age', 255)->nullable();
            $table->string('income', 255)->nullable();
            $table->string('jornaya_lead_id', 255)->nullable();
            $table->string('conditions', 255)->nullable();
            $table->string('trustedform_cert_url', 255)->nullable();
            $table->string('trustedform_token', 255)->nullable();
            $table->string('tcpa_agent', 255)->nullable();
            $table->string('insurance_amount', 255)->nullable();
            $table->string('landing_page', 255)->nullable();
            $table->string('lead_generated_date', 255)->nullable();
            $table->string('lead_id', 255)->nullable();
            $table->string('subid', 255)->nullable();
            $table->string('subid2', 255)->nullable();
            $table->string('subid3', 255)->nullable();
            $table->string('subid4', 255)->nullable();
            $table->string('subid5', 255)->nullable();
            $table->string('stat', 10)->nullable();
            $table->string('newflag', 10)->nullable();
            $table->string('cleaned', 10)->nullable();
            $table->string('esp_api', 10)->nullable();
            $table->string('esp_str', 255)->nullable();
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
        Schema::dropIfExists('datalendmarxsms');
    }
};
