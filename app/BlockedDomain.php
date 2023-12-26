<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedDomain extends Model
{
    use HasFactory;

    protected $table = 'blocked_domains';

    protected $fillable = [
        'content_site_id', 'delivery_id', 'domain'
    ];

    public function contentsite()
    {
        return $this->hasOne(ContentSite::class, 'id', 'content_site_id');
    }

    public function contentsitedeliverysetting()
    {
        return $this->hasOne(ContentSiteDeliverySettings::class, 'id', 'delivery_id');
    }

}
