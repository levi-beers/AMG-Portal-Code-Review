<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnsubcribeUser extends Model
{
    use HasFactory;

    protected $connection = 'other_database';

    protected $table = 'DNML';

    protected $fillable = [
        'email', 'domain', 'osrc'
    ];
}
