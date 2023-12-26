<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadsCount extends Model
{
    use HasFactory;

    protected $table = 'lead_counts';

    protected $fillable = [
        'date','esp_id','datasource_id','datasource','description','esp_name','esp_description','lead_count'
    ];
}
