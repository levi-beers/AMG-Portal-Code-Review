<?php

namespace AMGPortal\Http\Controllers\Api;

use AMGPortal\Http\Resources\CountryResource;
use AMGPortal\Repositories\Country\CountryRepository;

/**
 * @package AMGPortal\Http\Controllers\Api
 */
class CountriesController extends ApiController
{
    /**
     * @var CountryRepository
     */
    private $countries;

    public function __construct(CountryRepository $countries)
    {
        $this->countries = $countries;
    }

    /**
     * Get list of all available countries.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CountryResource::collection($this->countries->all());
    }
}
