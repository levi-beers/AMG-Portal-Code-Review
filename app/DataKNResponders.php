<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKNResponders extends Model
{
    use HasFactory;
    protected $table = 'dataknresponders';

    protected $fillable = [
        'email', 'first_name', 'last_name', 'address', 'city', 'state', 'zip', 'source_ip', 'source_url', 'source_dt', 'subid', 'year_born', 'gender', 'phone_number'
    ];
}
