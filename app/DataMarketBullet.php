<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMarketBullet extends Model
{
    use HasFactory;
    protected $table = 'datamarketbullet';

    protected $fillable = [
        'email', 'firstname', 'lastname', 'address', 'zip', 'city', 'state', 'phone', 'dob', 'timestamp', 'ip', 'url'
    ];
}
