<?php

namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataJetS3Subscriber;
use AMGPortal\Http\Resources\DataJetS3Resource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataJetS3;

class DataJetS3Controller extends Controller
{
    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewDataJetS3Subscriber $request
     * @return UserResource
     */
    public function store(CreateNewDataJetS3Subscriber $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'email', 'first_name', 'last_name', 'dob', 'mailing_address', 'city', 'region', 'zip', 'phone_mobile', 'member_id', 'email_signup_ip', 'email_signup_url', 'email_signup_tstamp', 'sms_signup_ip', 'sms_signup_url', 'sms_signup_tstamp', 'gender', 'homeowner_status', 'employment_status', 'marital_status', 'education_level', 'utm_campaign', 'utm_content', 'utm_medium', 'utm_term', 'utm_group', 'utm_source'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataJetS3::create($data);

        return new DataJetS3Resource($user);

    }
}
