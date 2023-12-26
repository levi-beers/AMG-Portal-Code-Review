<?php

// working on
namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataTurtleLeadsSubscriber;
use AMGPortal\Http\Resources\DataTurtleLeadsResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataTurtleLeads;


class DataTurtleLeadsController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewDataTurtleLeadsSubscriber $request
     * @return UserResource
     */
    public function store(CreateNewDataTurtleLeadsSubscriber $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'email', 'fname', 'lname', 'dob', 'address', 'city', 'state', 'zip', 'phone', 'url', 'ip', 'datestamp', 'leadid', 'stat', 'newflag', 'cleaned', 'esp_api', 'esp_str'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataTurtleLeads::create($data);

        return new DataTurtleLeadsResource($user);

    }
}
