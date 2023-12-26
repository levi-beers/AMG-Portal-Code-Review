<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OngageStats extends Model
{
    use HasFactory;

    protected $table = 'stats_ongage';

    protected $fillable = [
        'day', 'mailing_id', 'mailing_name', 'mailing_domain', 'gsr', 'sent', 'success', 'failed', 'opens', 'unsubscribes', 'complaints', 'clicks', 'opens_percent', 'clicks_percent', 'unsubscribes_percent'
    ];
}
