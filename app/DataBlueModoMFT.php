<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBlueModoMFT extends Model
{
    use HasFactory;
    protected $table = 'databluemodomft';

    protected $fillable = [
        'email', 'firstname', 'lastname', 'address', 'zip', 'city', 'state', 'phone', 'dob', 'timestamp', 'ip', 'url'
    ];
}
