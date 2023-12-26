<?php

namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataBlueModoLoansSubscriber;
use AMGPortal\Http\Resources\DataBlueModoLoansResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataBlueModoLoans;

class DataBlueModoLoansController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewDataFlexSubscriber $request
     * @return UserResource
     */
    public function store(CreateNewDataBlueModoLoansSubscriber $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'email', 'firstname', 'lastname', 'address', 'zip', 'city', 'state', 'phone', 'dob', 'timestamp', 'ip', 'url', 'stat', 'newflag', 'cleaned', 'esp_api', 'esp_str'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataBlueModoLoans::create($data);

        return new DataBlueModoLoansResource($user);

    }
}
