<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLendmarxSMS extends Model
{
    use HasFactory;
    protected $table = 'datalendmarxsms';


    protected $fillable = [
        'first_name', 'last_name', 'phone', 'address', 'city', 'state', 'zip', 'email', 'dob', 'ip_address', 'gender', 'age', 'income', 'jornaya_lead_id', 'conditions', 'trustedform_cert_url', 'trustedform_token', 'tcpa_agent', 'insurance_amount', 'landing_page', 'lead_generated_date', 'lead_id', 'subid', 'subid2', 'subid3', 'subid4', 'subid5'

    ];
}
