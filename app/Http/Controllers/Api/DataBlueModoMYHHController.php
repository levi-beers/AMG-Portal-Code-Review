<?php

namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataBlueModoMYHHSubscriber;
use AMGPortal\Http\Resources\DataBlueModoMYHHResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataBlueModoMYHH;

class DataBlueModoMYHHController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewDataFlexSubscriber $request
     * @return UserResource
     */
    public function store(CreateNewDataBlueModoMYHHSubscriber $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'email', 'firstname', 'lastname', 'address', 'zip', 'city', 'state', 'phone', 'dob', 'timestamp', 'ip', 'url', 'stat', 'newflag', 'cleaned', 'esp_api', 'esp_str'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataBlueModoMYHH::create($data);

        return new DataBlueModoMYHHResource($user);

    }
}
