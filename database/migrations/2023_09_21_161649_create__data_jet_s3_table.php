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
        Schema::create('datajets3', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->unique();
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('dob', 255)->nullable();
            $table->string('mailing_address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('region', 255)->nullable();
            $table->string('zip', 255)->nullable();
            $table->string('phone_mobile', 255)->nullable();
            $table->string('member_id', 255)->nullable();
            $table->string('email_signup_ip', 255)->nullable();
            $table->text('email_signup_url')->nullable();
            $table->string('email_signup_tstamp', 255)->nullable();
            $table->string('sms_signup_ip', 255)->nullable();
            $table->string('sms_signup_url', 255)->nullable();
            $table->text('sms_signup_tstamp')->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('homeowner_status', 255)->nullable();
            $table->string('employment_status', 255)->nullable();
            $table->string('marital_status', 255)->nullable();
            $table->string('education_level', 255)->nullable();
            $table->string('utm_campaign', 255)->nullable();
            $table->string('utm_content', 255)->nullable();
            $table->string('utm_medium', 255)->nullable();
            $table->string('utm_term', 255)->nullable();
            $table->string('utm_group', 255)->nullable();
            $table->string('utm_source', 255)->nullable();
            $table->string('stat', 10)->nullable();
            $table->string('newflag', 10)->nullable();
            $table->string('cleaned', 10)->nullable();
            $table->string('esp_api', 10)->nullable();
            $table->string('esp_str', 255)->nullable();
            $table->timestamps();

            $table->index('created_at', 'idx_created_at');
            $table->index('esp_str', 'idx_esp_str');
            $table->index('cleaned', 'idx_cleaned');
            $table->fullText('email', 'idx_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datajets3');
    }
};
