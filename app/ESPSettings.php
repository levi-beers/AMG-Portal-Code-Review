<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ESPSettings extends Model
{
    use HasFactory;

    protected $table = 'esp_info';

    protected $fillable = [
        'esp_name', 'esp_description', 'list_name', 'list_id', 'api_url', 'api_key', 'esp_str_value'
    ];

}
