<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJetS2SMS extends Model
{
    use HasFactory;
    protected $table = 'datajets2sms';

    protected $fillable = [
        'subscriber_id', 'phone_mobile', 'first_name', 'last_name', 'dob', 'mailing_address', 'city', 'region', 'zip', 'member_id', 'sms_optin', 'sms_signup_ip', 'sms_signup_url', 'gender', 'homeowner_status', 'employment_status', 'marital_status', 'education_level', 'utm_campaign', 'utm_content', 'utm_medium', 'utm_term', 'utm_group', 'utm_source'
    ];
}
