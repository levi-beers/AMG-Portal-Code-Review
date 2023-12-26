<?php

// working on
namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataJetS2EmailSubscriber;
use AMGPortal\Http\Resources\DataJetS2EmailResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataJetS2Email;


class DataJetS2EmailController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewDataJetS2EmailSubscriber $request
     * @return UserResource
     */
    public function store(CreateNewDataJetS2EmailSubscriber $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'subscriber_id', 'email', 'first_name', 'last_name', 'dob', 'mailing_address', 'city', 'region', 'zip', 'phone_mobile', 'member_id', 'email_signup_ip', 'email_signup_url', 'email_signup_tstamp', 'gender', 'homeowner_status', 'employment_status', 'marital_status', 'education_level', 'utm_campaign', 'utm_content', 'utm_medium', 'utm_term', 'utm_group', 'utm_source'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataJetS2Email::create($data);

        return new DataJetS2EmailResource($user);

    }
}
