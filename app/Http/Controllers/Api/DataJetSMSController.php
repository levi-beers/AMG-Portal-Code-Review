<?php

// working on
namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataJetSMSSubscriber;
use AMGPortal\Http\Resources\DataJetSMSResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataJetSMS;


class DataJetSMSController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Create new user record.
     * @param CreateNewDataJetSMSSubscriber $request
     * @return UserResource
     */
    public function store(CreateNewDataJetSMSSubscriber $request)
    {
        //print "testtesttest";
        $data = $request->only([
            'phone_mobile', 'first_name', 'last_name', 'mailing_address', 'city', 'region', 'zip', 'dob', 'gender', 'sms_optin', 'sms_signup_ip', 'sms_signup_url', 'sms_signup_tstamp', 'homeowner_status', 'employment_status', 'marital_status', 'education_level', 'stat', 'newflag', 'cleaned', 'esp_api', 'esp_str'
        ]);

//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataJetSMS::create($data);

        return new DataJetSMSResource($user);

    }
}
