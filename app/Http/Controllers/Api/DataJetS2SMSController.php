<?php

// working on
namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataJetS2SMSSubscriber;
use AMGPortal\Http\Resources\DataJetS2SMSResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataJetS2SMS;


class DataJetS2SMSController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewDataJetS2SMSSubscriber $request
     * @return UserResource
     */
    public function store(CreateNewDataJetS2SMSSubscriber $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'subscriber_id', 'phone_mobile', 'first_name', 'last_name', 'dob', 'mailing_address', 'city', 'region', 'zip', 'member_id', 'sms_optin', 'sms_signup_ip', 'sms_signup_url', 'gender', 'homeowner_status', 'employment_status', 'marital_status', 'education_level', 'utm_campaign', 'utm_content', 'utm_medium', 'utm_term', 'utm_group', 'utm_source'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataJetS2SMS::create($data);

        return new DataJetS2SMSResource($user);

    }
}
