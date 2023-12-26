<?php

// working on
namespace AMGPortal\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use AMGPortal\Http\Controllers\Api\ApiController;
use AMGPortal\Http\Requests\Data\CreateNewDataInterestMediaSubscriber;
use AMGPortal\Http\Resources\DataInterestMediaResource;
use AMGPortal\Http\Controllers\Controller;
use AMGPortal\DataInterestMedia;


class DataInterestMediaController extends Controller
{
    public function __construct()
    {
        var_dump('test');
    }

    /**
     * Create new user record.
     * @param CreateNewDataInterestMediaSubscriber $request
     * @return UserResource
     */

    public function store(CreateNewDataInterestMediaSubscriber $request)
    {
        //print "testtesttest";
        //var_dump('test goes here');
        $data = $request->only([
            'created_on', 'user_email_address', 'user_mobile', 'user_first_name', 'user_last_name', 'user_address', 'user_city_name', 'user_state_code', 'user_zip_code', 'user_dob', 'user_gender', 'user_age', 'is_optin', 'ip_address', 'trusterd_form_cert_url', 'domain_name', 'stat', 'newflag', 'cleaned', 'esp_api', 'esp_str'
        ]);


//        $data += [
//            'status' => UserStatus::ACTIVE,
//            'email_verified_at' => $request->verified ? now() : null
//        ];

        $user = DataInterestMedia::create($data);
        //error_log('Some message here.');
        //error_log(var_dump($user));

        return new DataInterestMediaResource($user);

    }
}
