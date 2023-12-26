<?php

// Test comment

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBulldogsFeed1 extends Model
{
    use HasFactory;
    protected $table = 'databulldogs_feed1'; // Ensure the table name matches your database schema

    protected $fillable = [
        'email', 'firstname', 'lastname', 'address', 'zip', 'city', 'state', 'phone', 'dob', 'timestamp', 'ip', 'url'
        // Include any additional fields specific to the DataBulldogsFeed1 if necessary
    ];
}
