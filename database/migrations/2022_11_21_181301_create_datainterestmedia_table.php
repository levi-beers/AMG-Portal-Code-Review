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
        Schema::create('datainterestmedia', function (Blueprint $table) {
            $table->id();
            $table->string('created_on', 255)->nullable();
            $table->string('user_email_address', 255)->unique();
            $table->string('user_mobile', 255)->nullable();
            $table->string('user_first_name', 255)->nullable();
            $table->string('user_last_name', 255)->nullable();
            $table->string('user_address', 255)->nullable();
            $table->string('user_city_name', 255)->nullable();
            $table->string('user_state_code', 255)->nullable();
            $table->string('user_zip_code', 255)->nullable();
            $table->string('user_dob', 255)->nullable();
            $table->string('user_gender', 255)->nullable();
            $table->string('user_age', 255)->nullable();
            $table->string('is_optin', 255)->nullable();
            $table->string('ip_address', 255)->nullable();
            $table->string('trusterd_form_cert_url', 255)->nullable();
            $table->string('domain_name', 255)->nullable();
            $table->string('stat', 10)->nullable();
            $table->string('newflag', 10)->nullable();
            $table->string('cleaned', 10)->nullable();
            $table->string('esp_api', 10)->nullable();
            $table->string('esp_str', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datainterestmedia');
    }
};
