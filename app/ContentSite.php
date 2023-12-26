<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentSite extends Model
{
    use HasFactory;

    protected $table = 'content_sites';

    protected $fillable = [
        'site_name', 'domain', 'vertical_id', 'app_password'
    ];

    public function contentvertical()
    {
        //return $this->belongsToMany(ContentVertical::class);
        return $this->hasOne(ContentVertical::class, 'id', 'vertical_id');
    }

}
