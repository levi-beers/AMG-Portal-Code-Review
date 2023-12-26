<?php

namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataKNRespondersSubscriber;
use AMGPortal\Http\Resources\DataKNRespondersResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataKNResponders;

class DataKNRespondersController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewDataFlexSubscriber $request
     * @return UserResource
     */
    public function store(CreateNewDataKNRespondersSubscriber $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'email', 'first_name', 'last_name', 'address', 'city', 'state', 'zip', 'source_ip', 'source_url', 'source_dt', 'subid', 'year_born', 'gender', 'phone_number'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataKNResponders::create($data);

        return new DataKNRespondersResource($user);
    }
}
