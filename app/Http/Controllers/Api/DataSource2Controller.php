<?php

// working on  
namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewSubscriber;
use AMGPortal\Http\Resources\DataResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataSource2;


class DataSource2Controller extends Controller
{
    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewSubscriber $request
     * @return UserResource
     */
    public function store(CreateNewSubscriber $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'email', 'first_name', 'last_name', 'dob', 'address', 'city', 'region', 'zip', 'phone_mobile', 'email_signup_ip', 'email_signup_url', 'gender', 'timestamp'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataSource2::create($data);

        return new DataResource($user);
    }
}
