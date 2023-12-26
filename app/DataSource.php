<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSource extends Model
{
    use HasFactory;

    protected $table = 'datasource';

    protected $fillable = [
        'datasource_table', 'datasource_description', 'datasource_acquired'
    ];

    public function IOReport()
    {
        return $this->hasOne(IOReport::class);
    }
}
