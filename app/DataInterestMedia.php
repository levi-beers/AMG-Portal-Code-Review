<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataInterestMedia extends Model
{
    use HasFactory;
    protected $table = 'datainterestmedia';


    protected $fillable = [
            'created_on', 'user_email_address', 'user_mobile', 'user_first_name', 'user_last_name', 'user_address', 'user_city_name', 'user_state_code', 'user_zip_code', 'user_dob', 'user_gender', 'user_age', 'is_optin', 'ip_address', 'trusterd_form_cert_url', 'domain_name'

    ];
    //'created_on', 'user_email_address', 'user_mobile', 'user_first_name', 'user_last_name', 'user_address', 'user_city_name', 'user_state_code', 'user_zip_code', 'user_dob', 'user_gender', 'user_age', 'is_optin', 'ip_address', 'trusterd_form_cert_url', 'domain_name', 'stat', 'newflag', 'cleaned', 'esp_api', 'esp_str'
}
