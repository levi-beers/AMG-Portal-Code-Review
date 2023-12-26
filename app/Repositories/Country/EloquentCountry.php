<?php

namespace AMGPortal\Repositories\Country;

use AMGPortal\Country;

class EloquentCountry implements CountryRepository
{
    /**
     * {@inheritdoc}
     */
    public function lists($column = 'name', $key = 'id')
    {
        return Country::orderBy('name')->pluck($column, $key);
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Country::all();
    }
}
