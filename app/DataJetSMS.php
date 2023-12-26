<?php

// Test comment

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJetSMS extends Model
{
    use HasFactory;
    protected $table = 'datajetsms';

    protected $fillable = [
        'phone_mobile', 'first_name', 'last_name', 'mailing_address', 'city', 'region', 'zip', 'dob', 'gender', 'sms_optin', 'sms_signup_ip', 'sms_signup_url', 'sms_signup_tstamp', 'homeowner_status', 'employment_status', 'marital_status', 'education_level'
    ];
}
