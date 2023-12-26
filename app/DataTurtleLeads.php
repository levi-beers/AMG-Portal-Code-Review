<?php

// Test comment

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTurtleLeads extends Model
{
    use HasFactory;
    protected $table = 'dataturtleleads';

    protected $fillable = [
        'email', 'fname', 'lname', 'dob', 'address', 'city', 'state', 'zip', 'phone', 'url', 'ip', 'datestamp', 'leadid'
    ];
}
