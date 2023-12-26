<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IOReport extends Model
{
    use HasFactory;

    protected $table = 'ioreport';

    protected $fillable = [
        'report_date', 'datasource_id', 'datacnt', 'reportType', 'alert_status', 'alert_sent', 'esp_api', 'esp_str'
    ];

    public function dataSource()
    {
        return $this->belongsTo(DataSource::class, 'datasource_id', 'id');
    }
}
