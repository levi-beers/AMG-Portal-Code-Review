<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJetS2Email extends Model
{
    use HasFactory;
    protected $table = 'datajets2email';

    protected $fillable = [
        'subscriber_id', 'email', 'first_name', 'last_name', 'dob', 'mailing_address', 'city', 'region', 'zip', 'phone_mobile', 'member_id', 'email_signup_ip', 'email_signup_url', 'email_signup_tstamp', 'gender', 'homeowner_status', 'employment_status', 'marital_status', 'education_level', 'utm_campaign', 'utm_content', 'utm_medium', 'utm_term', 'utm_group', 'utm_source'
    ];
}