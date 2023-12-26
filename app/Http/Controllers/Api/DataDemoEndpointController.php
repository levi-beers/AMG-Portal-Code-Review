<?php

namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\Http\Requests\Data\CreateNewDataDemoEndpointRequest;
use AMGPortal\Http\Resources\DataDemoEndpointResource;
use AMGPortal\DataDemoEndpoint;

class DataDemoEndpointController extends Controller
{
    public function __construct()
    {
        // Initialization, if needed
    }

    /**
     * Create new record for DataDemoEndpoint.
     * @param CreateNewDataDemoEndpointRequest $request
     * @return DataDemoEndpointResource
     */
    public function store(CreateNewDataDemoEndpointRequest $request)
    {
        $data = $request->only([
            'email', 'firstname', 'lastname', 'address', 'zip', 'city', 'state', 'phone', 'dob', 'timestamp', 'ip', 'url', 'stat', 'newflag', 'cleaned', 'esp_api', 'esp_str'
        ]);

        // Additional data handling or processing can be done here

        $record = DataDemoEndpoint::create($data);

        return new DataDemoEndpointResource($record);
    }
}
