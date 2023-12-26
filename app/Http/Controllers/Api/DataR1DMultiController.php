<?php

// working on
namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataR1DMultiSubscriber;
use AMGPortal\Http\Resources\DataR1DMultiResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataR1DMulti;


class DataR1DMultiController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewDataR1DMultiSubscriber $request
     * @return UserResource
     */
    public function store(CreateNewDataR1DMultiSubscriber $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'email', 'fname', 'lname', 'dob', 'address', 'city', 'state', 'zip', 'phone', 'url', 'ip', 'datestamp', 'leadid', 'stat', 'newflag', 'cleaned', 'esp_api', 'esp_str'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataR1DMulti::create($data);

        return new DataR1DMultiResource($user);

    }
}
