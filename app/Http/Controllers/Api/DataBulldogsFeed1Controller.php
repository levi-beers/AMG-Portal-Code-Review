<?php

namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataBulldogsFeed1;
use AMGPortal\Http\Requests\Data\CreateNewDataBulldogsFeed1Request;
use AMGPortal\Http\Resources\DataBulldogsFeed1Resource;

class DataBulldogsFeed1Controller extends Controller
{
    public function __construct()
    {
        // Initialize controller
    }

    /**
     * Create new feed record.
     * @param CreateNewDataBulldogsFeed1Request $request
     * @return DataBulldogsFeed1Resource
     */
    public function store(CreateNewDataBulldogsFeed1Request $request)
    {
        $data = $request->only([
            'email', 'firstname', 'lastname', 'address', 'zip', 'city', 'state', 'phone', 'dob', 'timestamp', 'ip', 'url', 'stat', 'newflag', 'cleaned', 'esp_api', 'esp_str'
        ]);

        // Add additional data processing if needed

        $feedEntry = DataBulldogsFeed1::create($data);

        return new DataBulldogsFeed1Resource($feedEntry);
    }
}
