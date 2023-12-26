<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataiMessage extends Model
{
    use HasFactory;
    protected $table = 'dataimessage';

    protected $fillable = [
        'email', 'firstname', 'lastname', 'address', 'zip', 'city', 'state', 'phone', 'dob', 'providerId', 'timestamp', 'ip', 'url'
    ];
}
