<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSource2 extends Model
{
    use HasFactory;
    protected $table = 'datasource2';

    protected $fillable = [
        'email', 'first_name', 'last_name', 'dob', 'address', 'city', 'region', 'zip', 'phone_mobile', 'email_signup_ip', 'email_signup_url', 'gender', 'timestamp'
    ];
}
