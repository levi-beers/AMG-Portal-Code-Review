<?php

// Test comment

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataR1DMulti extends Model
{
    use HasFactory;
    protected $table = 'datar1dmulti';

    protected $fillable = [
        'email', 'fname', 'lname', 'dob', 'address', 'city', 'state', 'zip', 'phone', 'url', 'ip', 'datestamp', 'leadid'
    ];
}
