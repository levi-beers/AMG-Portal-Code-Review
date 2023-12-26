<?php

// Test comment

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFlex extends Model
{
    use HasFactory;
    protected $table = 'dataflex';

    protected $fillable = [
        'email', 'firstname', 'lastname', 'address', 'zip', 'city', 'state', 'phone', 'dob', 'timestamp', 'ip', 'url'
    ];
}
