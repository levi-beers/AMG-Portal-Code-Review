<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentSiteDeliverySettings extends Model
{
    use HasFactory;

    protected $table = 'content_site_delivery_settings';

    protected $fillable = [
        'content_site_id', 'delivery_domain', 'datasource', 'esp_settings_id', 'throttle', 'time_value', 'historic_throttle', 'historic_time_value'
    ];

    public function contentsite()
    {
        return $this->hasOne(ContentSite::class, 'id', 'content_site_id');
    }

    public function datasource()
    {
        return $this->hasOne(DataSource::class, 'id', 'datasource');
    }

    public function espinfo()
    {
        return $this->hasOne(ESPSettings::class, 'id', 'esp_settings_id');
    }

}
