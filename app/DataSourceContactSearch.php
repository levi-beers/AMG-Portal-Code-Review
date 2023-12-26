<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSourceContactSearch extends Model
{
    use HasFactory;

    protected $table = 'datasource_contact_search';

    protected $fillable = [
        'datasource_id',
        'name',
        'status',
        'count',
        'date_from',
        'date_to',
        'selected_combine',
        'selected_criteria',
        'selected_fields'
     ];

     public function dataSource()
    {
        return $this->belongsTo(DataSource::class, 'datasource_id', 'id');
    }
}
