<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardData extends Model
{
    use HasFactory;

    protected $table = 'dashboard_datacount';

    protected $fillable = [
        'total_datasource', 'total_data_connection', 'total_outbound_delta', 'total_inbound_delta', 'total_inbound_yesterday', 'total_inbound_before_yesterday', 'total_outbound_yesterday', 'total_outbound_before_yesterday'
    ];

}
