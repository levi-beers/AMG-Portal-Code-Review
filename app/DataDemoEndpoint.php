<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDemoEndpoint extends Model
{
    use HasFactory;

    // Assuming the table name follows the Laravel naming convention
    // If your table has a different name, replace 'datademoendpoints' accordingly
    protected $table = 'datademoendpoints';

    protected $fillable = [
        'email', 'firstname', 'lastname', 'address', 'zip', 'city', 'state', 'phone', 'dob', 'timestamp', 'ip', 'url'
    ];
}
