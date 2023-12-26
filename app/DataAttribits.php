<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAttribits extends Model
{
    use HasFactory;
    protected $table = 'data_attribits';

    protected $fillable = [
        'email', 'first_name', 'last_name', 'address', 'city', 'state', 'zip', 'source_ip', 'source_url', 'source_dt', 'subid', 'year_born', 'gender', 'phone_number', 'credit_score', 'homeowner', 'veteran_flag', 'estimated_income', 'mariage_status', 'political_affiliation', 'presence_of_credit_card'
    ];
}
