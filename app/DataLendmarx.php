<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLendmarx extends Model
{
    use HasFactory;
    protected $table = 'datalendmarx';


    protected $fillable = [
        'first_name', 'last_name', 'phone', 'address', 'city', 'state', 'zip', 'email', 'dob', 'ip_address', 'gender', 'age', 'income', 'jornaya_lead_id', 'conditions', 'trustedform_cert_url', 'trustedform_token', 'tcpa_agent', 'insurance_amount', 'landing_page', 'lead_generated_date', 'lead_id', 'subid', 'subid2', 'subid3', 'subid4', 'subid5'

    ];
    //'created_on', 'user_email_address', 'user_mobile', 'user_first_name', 'user_last_name', 'user_address', 'user_city_name', 'user_state_code', 'user_zip_code', 'user_dob', 'user_gender', 'user_age', 'is_optin', 'ip_address', 'trusterd_form_cert_url', 'domain_name', 'stat', 'newflag', 'cleaned', 'esp_api', 'esp_str'
}
