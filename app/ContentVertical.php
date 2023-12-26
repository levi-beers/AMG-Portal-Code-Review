<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentVertical extends Model
{
    use HasFactory;

    protected $table = 'content_verticals';

    protected $fillable = [
        'vertical_name', 'vertical_description'
    ];

    public function contentsite()
    {
        //return $this->belongsToMany(ContentSite::class, 'vertical_id')->withPivot('id');
        return $this->hasMany(ContentSite::class, 'vertical_id', 'id');
    }
}
