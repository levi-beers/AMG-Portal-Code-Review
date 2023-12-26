<?php

namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataAttribitsSubscriber;
use AMGPortal\Http\Resources\DataAttribitsResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataAttribits;

class DataAttribitsController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewDataFlexSubscriber $request
     * @return UserResource
     */
    public function store(CreateNewDataAttribitsSubscriber $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'email', 'first_name', 'last_name', 'address', 'city', 'state', 'zip', 'source_ip', 'source_url', 'source_dt', 'subid', 'year_born', 'gender', 'phone_number', 'credit_score', 'homeowner', 'veteran_flag', 'estimated_income', 'mariage_status', 'political_affiliation', 'presence_of_credit_card'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataAttribits::create($data);

        return new DataAttribitsResource($user);
    }
}
